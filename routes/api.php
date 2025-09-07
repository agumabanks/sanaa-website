<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:60,1')->group(function () {
    // Blogs
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/trending', [BlogController::class, 'trending']);
    Route::get('/blogs/featured', [BlogController::class, 'featured']);
    Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
    Route::post('/blogs/{blog:slug}/like', [BlogController::class, 'like']);
    Route::post('/blogs/{blog:slug}/share', [BlogController::class, 'share']);
    Route::post('/blogs/{blog:slug}/save', [BlogController::class, 'save']);

    // Categories & Tags
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/tags', [TagController::class, 'index']);
});

// Versioned API (recommended for external consumers)
Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    // Blogs
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/trending', [BlogController::class, 'trending']);
    Route::get('/blogs/featured', [BlogController::class, 'featured']);
    Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
    Route::post('/blogs/{blog:slug}/like', [BlogController::class, 'like']);
    Route::post('/blogs/{blog:slug}/share', [BlogController::class, 'share']);
    Route::post('/blogs/{blog:slug}/save', [BlogController::class, 'save']);

    // Categories & Tags
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/tags', [TagController::class, 'index']);
});
