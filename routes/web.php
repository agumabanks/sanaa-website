<?php

use Illuminate\Support\Facades\Route;


// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusinessCategoryController;

// Landing Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/policy', [PageController::class, 'policy'])->name('policy');
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/prices', [PageController::class, 'prices'])->name('prices');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');


Route::get('/api/product/{productId}', [PageController::class, 'getProductDetails']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/dashboard/blog', [BlogController::class, 'store'])->name('dashboard.blog.store');
    Route::post('/dashboard/category', [\App\Http\Controllers\BusinessCategoryController::class, 'store'])->name('dashboard.category.store');
});
