<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public
// Route::get("/movies", [MovieController::class, "index"]);

// Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/movies", [MovieController::class, "index"]);
});
