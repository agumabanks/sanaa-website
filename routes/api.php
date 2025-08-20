<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
Route::post('/blogs/{blog}/like', [BlogController::class, 'like']);
Route::post('/blogs/{blog}/share', [BlogController::class, 'share']);
Route::post('/blogs/{blog}/save', [BlogController::class, 'save']);
