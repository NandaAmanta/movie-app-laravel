<?php

namespace App\Services;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use GuzzleHttp\Psr7\Request;

class MovieService {

    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAll(){
        $movies = $this->movieRepository->findAllAndPaginate();
        return $movies;
    }

}