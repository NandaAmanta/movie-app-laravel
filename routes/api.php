<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackOfficeController;
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
Route::get("/movies", [MovieController::class, "index"]);
Route::post("/auth/login", [AuthController::class, "login"]);
Route::post("/auth/signup", [AuthController::class, "signup"]);


// Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    // 
});

// Protected and Admin Only
Route::group(['middleware' => ['auth:sanctum', "checkRole"]], function () {
    Route::get("/backoffice/tags", [BackOfficeController::class, "getTagList"]);
});
