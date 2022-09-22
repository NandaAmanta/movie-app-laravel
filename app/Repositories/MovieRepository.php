<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieRepository
{

    private Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function findAllAndPaginate(int $perPage = 15)
    {
        $movies = $this->movie::paginate($perPage);
        return $movies;
    }

    public function findById(int $id){
        $movie = $this->movie::where("id",$id)->first();
        return $movie;
    }

    public function save(array $data){
        $movies = $this->movie->insertOrIgnore($data);
        return $movies;
    }
}
