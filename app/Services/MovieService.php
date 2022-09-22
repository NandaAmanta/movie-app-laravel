<?php

namespace App\Services;

use App\Exceptions\ThirdPartyException;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{

    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAll()
    {
        $movies = $this->movieRepository->findAllAndPaginate();
        return $movies;
    }

    public function fetch()
    {
        Log::info("Fetching ongoing movie from TMDB");
        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing?api_key=" . env("TMDB_API_KEY"));

        if (!$response->ok()) {
            Log::error("response from TMDB is NOT ok");
            throw new ThirdPartyException("failed get ongoing movies on TMDB");
        }

        $result = $this->mapResponseResults($response->json("results"));
        $this->movieRepository->save($result);
    }

    private function mapResponseResults(array $data): array
    {
        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            $indexData = [
                "id" => $data[$i]["id"],
                "title" => $data[$i]["title"],
                "overview" => $data[$i]["overview"],
                "poster" => $data[$i]["poster_path"],
            ];
            array_push($result, $indexData);
        }

        return $result;
    }
}
