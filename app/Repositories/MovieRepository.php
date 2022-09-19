<?php

namespace App\Repositories;
use App\Models\Movie;


class MovieRepository{
    public function findAllAndPaginate(int $perPage = 15){
        $movies = Movie::paginate($perPage);
        return $movies;
    }
}