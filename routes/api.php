<?php

use App\Http\Controllers\API\BreastController;
use App\Http\Controllers\API\AuthController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Breast Data With Auth
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/breasts', [BreastController::class, 'index']);
    Route::get('/breasts/{id}', [BreastController::class, 'show']);
    Route::post('/breasts', [BreastController::class, 'store']);
    Route::put('/breasts/{id}', [BreastController::class, 'update']);
    Route::delete('/breasts/{id}', [BreastController::class, 'destroy']);
});
