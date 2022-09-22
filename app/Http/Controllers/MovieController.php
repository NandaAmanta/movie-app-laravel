<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieScheduleService;
use App\Services\MovieService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    use ApiResponser;

    private  MovieService $movieService;
    private MovieScheduleService $movieScheduleService;

    public function __construct(MovieService $movieService, MovieScheduleService $movieScheduleService)
    {
        $this->movieService = $movieService;
        $this->movieScheduleService = $movieScheduleService;
    }

    public function index(Request $request)
    {
        $movies = $this->movieService->getAll();
        return $this->successResponseListData($movies, "success get movies data");
    }

    public function getAllMovieSchedule(Request $request)
    {
        $schedules = $this->movieScheduleService->getAll();
        return $this->successResponseListData($schedules, "Success get movie schedules");
    }
}
