<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use ApiResponser;

    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request)
    {
        $movies = $this->movieService->getAll();
        return $this->successResponseListData($movies, "success get movies data");
    }
}
