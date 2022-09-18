<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $movies = Movie::paginate(15)->toArray();
        return response()->json([
            "success" => true,
            "message" => "Movie berhasil didapatkan",
            "data" => $movies['data'],
            "pagination" => [
                'total' => $movies['total'],
                'per_page' => $movies['per_page'],
                'current_page' => $movies["current_page"],
                'next_page_link' => $movies["next_page_url"],
                'previous_page_link' => $movies["prev_page_url"]
            ]
        ]);
    }
}
