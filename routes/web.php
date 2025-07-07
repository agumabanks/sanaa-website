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
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PolicyController;
use App\Models\Policy;
 

// Landing Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/policy', [PageController::class, 'policy'])->name('policy');
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::post('/support', [SupportController::class, 'send'])->name('support.send');
Route::get('/products', [\App\Http\Controllers\OfferingController::class, 'index'])->defaults('type', 'product')->name('products');
Route::get('/services', [\App\Http\Controllers\OfferingController::class, 'index'])->defaults('type', 'service')->name('services');
Route::get('/bulk-sms', [PageController::class, 'bulkSms'])->name('bulk-sms');
Route::get('/prices', [PageController::class, 'prices'])->name('prices');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
Route::get('/terms', [PolicyController::class, 'show'])->defaults('key', 'terms')->name('terms');
Route::get('/seller-policies', [PolicyController::class, 'show'])->defaults('key', 'seller-policies')->name('seller-policies');
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
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/blog', function () {
        return view('dashboard.blog');
    })->name('dashboard.blog');

    Route::get('/dashboard/categories', function () {
        return view('dashboard.categories');
    })->name('dashboard.categories');

    Route::get('/dashboard/team', function () {
        $teamMembers = \App\Models\TeamMember::all();
        return view('dashboard.team', compact('teamMembers'));
    })->name('dashboard.team');
    Route::get('/dashboard/team/{member}', [TeamController::class, 'edit'])->name('dashboard.team.edit');

    Route::get('/dashboard/careers', function () {
        return view('dashboard.careers');
    })->name('dashboard.careers');

    Route::get('/dashboard/partners', function () {
        return view('dashboard.partners');
    })->name('dashboard.partners');

    Route::get('/dashboard/developer-platforms', function () {
        return view('dashboard.developer-platforms');
    })->name('dashboard.developer-platforms');

    Route::get('/dashboard/hardware-rentals', function () {
        return view('dashboard.hardware-rentals');
    })->name('dashboard.hardware-rentals');

    Route::get('/dashboard/prices', function () {
        return view('dashboard.prices');
    })->name('dashboard.prices');

    Route::get('/dashboard/offerings', function () {
        $items = \App\Models\Offering::all();
        return view('dashboard.offerings', compact('items'));
    })->name('dashboard.offerings');

    Route::get('/dashboard/policies', function () {
        $terms = Policy::where('key', 'terms')->first();
        $seller = Policy::where('key', 'seller-policies')->first();
        return view('dashboard.policies', compact('terms', 'seller'));
    })->name('dashboard.policies');

    Route::post('/dashboard/blog', [BlogController::class, 'store'])->name('dashboard.blog.store');
    Route::put('/dashboard/blog/{blog}', [BlogController::class, 'update'])->name('dashboard.blog.update');
    Route::delete('/dashboard/blog/{blog}', [BlogController::class, 'destroy'])->name('dashboard.blog.destroy');
    Route::post('/dashboard/category', [\App\Http\Controllers\BusinessCategoryController::class, 'store'])->name('dashboard.category.store');
    Route::post('/dashboard/team', [TeamController::class, 'store'])->name('dashboard.team.store');
    Route::put('/dashboard/team/{member}', [TeamController::class, 'update'])->name('dashboard.team.update');
    Route::delete('/dashboard/team/{member}', [TeamController::class, 'destroy'])->name('dashboard.team.destroy');
    Route::post('/dashboard/career', [CareerController::class, 'store'])->name('dashboard.career.store');
    Route::post('/dashboard/partner', [PartnerController::class, 'store'])->name('dashboard.partner.store');
    Route::post('/dashboard/developer-platform', [DeveloperPlatformController::class, 'store'])->name('dashboard.developer-platform.store');
    Route::post('/dashboard/hardware-rental', [HardwareRentalController::class, 'store'])->name('dashboard.hardware-rental.store');
    Route::post('/dashboard/price', [PriceController::class, 'store'])->name('dashboard.price.store');
    Route::post('/dashboard/policy/{key}', [PolicyController::class, 'update'])->name('dashboard.policy.update');

    Route::post('/dashboard/offering', [\App\Http\Controllers\OfferingController::class, 'store'])->name('dashboard.offering.store');
    Route::put('/dashboard/offering/{offering}', [\App\Http\Controllers\OfferingController::class, 'update'])->name('dashboard.offering.update');
    Route::delete('/dashboard/offering/{offering}', [\App\Http\Controllers\OfferingController::class, 'destroy'])->name('dashboard.offering.destroy');
});
