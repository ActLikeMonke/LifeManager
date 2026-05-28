<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

// for now we'll just put all our API routes here. In the future we will add authorization and then
// we can move these
// Food routes
Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{food}', [FoodController::class, 'show']);
Route::post('/foods', [FoodController::class, 'store']);
Route::put('/foods/{food}', [FoodController::class, 'update']);
Route::delete('/foods/{food}', [FoodController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    // Future protected routes will go here
});