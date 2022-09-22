<?php

namespace App\Console\Commands;

use App\Exceptions\ThirdPartyException;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use App\Services\MovieService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchOngoingMovie extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch ongoing movie from TMDB to local database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing?api_key=" . env("TMDB_API_KEY"));

        if (!$response->ok()) {
            Log::error("response from TMDB is NOT ok");
            throw new ThirdPartyException("failed get ongoing movies on TMDB");
        }

        $result = $this->mapResponseResults($response->json("results"));
        DB::table("movies")->insertOrIgnore($result);
        
        echo "Fetched ongoing movie from TMDB => ".date("Y-m-d H:i:s")."\n" ;
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
