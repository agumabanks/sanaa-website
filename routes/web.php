<?php

use Illuminate\Support\Facades\Route;


// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DeveloperPlatformController;
use App\Http\Controllers\HardwareRentalController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AdminAuthController;
 

// Landing Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/policy', [PageController::class, 'policy'])->name('policy');
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/prices', [PageController::class, 'prices'])->name('prices');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
Route::get('/developer-platforms', [DeveloperPlatformController::class, 'index'])->name('developer-platforms');
Route::get('/rent-hardware', [HardwareRentalController::class, 'index'])->name('rent-hardware');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Team
Route::get('/team', [TeamController::class, 'index'])->name('team.index');


// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


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
    Route::post('/dashboard/team', [TeamController::class, 'store'])->name('dashboard.team.store');
    Route::post('/dashboard/career', [CareerController::class, 'store'])->name('dashboard.career.store');
    Route::post('/dashboard/partner', [PartnerController::class, 'store'])->name('dashboard.partner.store');
    Route::post('/dashboard/developer-platform', [DeveloperPlatformController::class, 'store'])->name('dashboard.developer-platform.store');
    Route::post('/dashboard/hardware-rental', [HardwareRentalController::class, 'store'])->name('dashboard.hardware-rental.store');
    Route::post('/dashboard/price', [PriceController::class, 'store'])->name('dashboard.price.store');
});
