<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use ApiResponser;

    public function index(Request $request)
    {
        $movies = Movie::paginate(15);
        return $this->successResponseListData($movies,"success get movies data");
    }
}
