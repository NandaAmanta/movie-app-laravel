<?php

namespace App\Repositories;

use App\Models\Movie;


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
}
