<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
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
Route::get("/movies", [MovieController::class, "index"]);
Route::get("/movies/schedules", [MovieController::class, "getAllMovieSchedule"]);

Route::post("/auth/login", [AuthController::class, "login"]);
Route::post("/auth/signup", [AuthController::class, "signup"]);


// Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("/order", [OrderController::class, "create"]);
    Route::get("/order", [OrderController::class, "getMine"]);
});

// Protected and Admin Only
Route::group(['middleware' => ['auth:sanctum', "checkRole"]], function () {
    Route::get("/backoffice/tags", [BackOfficeController::class, "getTagList"]);
    Route::post("/backoffice/movies/schedules", [BackOfficeController::class, "createSchedule"]);
    Route::put("/backoffice/movies/{id}", [BackOfficeController::class, "updateMovie"]);
});
