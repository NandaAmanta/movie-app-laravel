<?php

namespace App\Services;

use App\Exceptions\ThirdPartyException;
use App\Http\Requests\UpdateMovieRequest;
use App\Jobs\GenerateMovieTagJob;
use App\Models\MovieTag;
use App\Repositories\MovieRepository;
use App\Repositories\MovieTagRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{

    private MovieRepository $movieRepository;
    private MovieTagRepository $movieTagRepository;
    private TagRepository $tagRepository;

    public function __construct(MovieRepository $movieRepository, MovieTagRepository $movieTagRepository, TagRepository $tagRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->movieTagRepository = $movieTagRepository;
        $this->tagRepository = $tagRepository;
    }

    public function getAll()
    {
        $movies = $this->movieRepository->findAllAndPaginate();
        return $movies;
    }

    public function update($id, UpdateMovieRequest $request)
    {
        $dataReq = $request->only(["title", "overview"]);
        $result = $this->movieRepository->update($id, $dataReq);
        return $result;
    }

    public function fetch()
    {
        Log::info("Fetching ongoing movie from TMDB");
        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing?api_key=" . env("TMDB_API_KEY"));

        if (!$response->ok()) {
            Log::error("response from TMDB is NOT ok");
            throw new ThirdPartyException("failed get ongoing movies on TMDB");
        }

        $result = mapResponseTmdbToMovie($response->json("results"));


        $this->movieRepository->save($result);

        for ($i = 0; $i < count($result); $i++) {
            dispatch(new GenerateMovieTagJob($this->movieTagRepository, $this->tagRepository, $result[$i]["title"], $result[$i]["id"]));
        }
    }
}
