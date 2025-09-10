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
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SitemapController;
use App\Models\Policy; 
 

// Landing Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/policy', [PageController::class, 'policy'])->name('policy');
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::post('/support', [SupportController::class, 'send'])->name('support.send');
Route::get('/products', [OfferingController::class, 'index'])->defaults('type', 'product')->name('products');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/bulk-sms', [PageController::class, 'bulkSms'])->name('bulk-sms');
Route::get('/prices', [PageController::class, 'prices'])->name('prices');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
Route::get('/why-sanaa', [PageController::class, 'whySanaa'])->name('why-sanaa');
Route::get('/investor-relations', [PageController::class, 'investorRelations'])->name('investor-relations');
Route::get('/terms', [PolicyController::class, 'show'])->defaults('key', 'terms')->name('terms');
Route::get('/seller-policies', [PolicyController::class, 'show'])->defaults('key', 'seller-policies')->name('seller-policies');

// Policy Pages
Route::prefix('policies')->name('policies.')->group(function () {
    Route::get('/', [PolicyController::class, 'index'])->name('index');
    Route::get('/privacy-notice', [PolicyController::class, 'show'])->defaults('key', 'privacy-notice')->name('privacy-notice');
    Route::get('/security', [PolicyController::class, 'show'])->defaults('key', 'security')->name('security');
    Route::get('/terms-conditions', [PolicyController::class, 'show'])->defaults('key', 'terms')->name('terms-conditions');
    Route::get('/seller-policies', [PolicyController::class, 'show'])->defaults('key', 'seller-policies')->name('seller-policies');
    Route::get('/government-licenses', [PolicyController::class, 'show'])->defaults('key', 'government-licenses')->name('government-licenses');
    Route::get('/sanaa-brands-licenses', [PolicyController::class, 'show'])->defaults('key', 'sanaa-brands-licenses')->name('sanaa-brands-licenses');
    Route::get('/sanaa-finance-licenses', [PolicyController::class, 'show'])->defaults('key', 'sanaa-finance-licenses')->name('sanaa-finance-licenses');
    Route::get('/consumer-health-privacy', [PolicyController::class, 'show'])->defaults('key', 'consumer-health-privacy')->name('consumer-health-privacy');
    Route::get('/hardware-compliance-certifications', [PolicyController::class, 'show'])->defaults('key', 'hardware-compliance-certifications')->name('hardware-compliance-certifications');
    Route::get('/open-corporates', [PolicyController::class, 'show'])->defaults('key', 'open-corporates')->name('open-corporates');
    Route::get('/{key}', [PolicyController::class, 'show'])->name('show');
});
Route::get('/developer-platforms', [DeveloperPlatformController::class, 'index'])->name('developer-platforms');
Route::get('/rent-hardware', [HardwareRentalController::class, 'index'])->name('rent-hardware');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/for-you', [BlogController::class, 'forYou'])->middleware('auth')->name('for-you');
    // Category and tag routes
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog}/comment', [BlogController::class, 'comment'])->name('comment');
    Route::post('/{blog}/like', [BlogController::class, 'like'])->name('like');
    Route::post('/{blog}/bookmark', [BlogController::class, 'bookmark'])->name('bookmark');
    Route::post('/{blog}/share', [BlogController::class, 'share'])->name('share');
});

// User-specific dashboard routes
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Compose (write)
    Route::get('/write', function () {
        $categories = \App\Models\BlogCategory::orderBy('name')->get();
        return view('dashboard.write', compact('categories'));
    })->name('write');
    Route::post('/posts', [BlogController::class, 'store'])->name('posts.store');

    // Library (saved stories)
    Route::get('/library', function () {
        $posts = auth()->user()->savedBlogs()->with(['author','category'])->orderByDesc('blog_user_saves.created_at')->paginate(10);
        return view('dashboard.library', compact('posts'));
    })->name('library');

    // Followers / Following lists
    Route::get('/followers', function () {
        $followers = auth()->user()->followers()->orderBy('name')->paginate(20);
        return view('dashboard.followers', compact('followers'));
    })->name('followers');
    Route::get('/following', function () {
        $following = auth()->user()->following()->orderBy('name')->paginate(20);
        return view('dashboard.following', compact('following'));
    })->name('following');
    Route::post('/follow/{user}', function (\App\Models\User $user) {
        if ($user->id !== auth()->id()) {
            auth()->user()->following()->syncWithoutDetaching([$user->id]);
        }
        return back();
    })->name('follow');
    Route::post('/unfollow/{user}', function (\App\Models\User $user) {
        if ($user->id !== auth()->id()) {
            auth()->user()->following()->detach($user->id);
        }
        return back();
    })->name('unfollow');

    // Follow/unfollow categories (publications)
    Route::post('/follow/category/{category}', function (\App\Models\BlogCategory $category) {
        auth()->user()->followedCategories()->syncWithoutDetaching([$category->id]);
        return back();
    })->name('follow.category');
    Route::post('/unfollow/category/{category}', function (\App\Models\BlogCategory $category) {
        auth()->user()->followedCategories()->detach($category->id);
        return back();
    })->name('unfollow.category');

    // Follow/unfollow tags (topics)
    Route::post('/follow/tag/{tag}', function (\App\Models\BlogTag $tag) {
        auth()->user()->followedTags()->syncWithoutDetaching([$tag->id]);
        return back();
    })->name('follow.tag');
    Route::post('/unfollow/tag/{tag}', function (\App\Models\BlogTag $tag) {
        auth()->user()->followedTags()->detach($tag->id);
        return back();
    })->name('unfollow.tag');

    // Suggestions and notifications
    Route::get('/suggestions', function () {
        $trending = app(\App\Http\Controllers\BlogController::class)->getTrendingPosts();
        $popular = \App\Models\Blog::popular()->with(['author','category'])->limit(8)->get();
        return view('dashboard.suggestions', compact('trending','popular'));
    })->name('suggestions');
    Route::get('/notifications', function () {
        // Placeholder: could be populated from analytics or app notifications
        $notifications = collect();
        return view('dashboard.notifications', compact('notifications'));
    })->name('notifications');

    // Search
    Route::get('/search', function (\Illuminate\Http\Request $request) {
        $q = $request->input('q');
        $results = collect();
        if ($q) {
            $results = \App\Models\Blog::published()
                ->where(function($query) use ($q) {
                    $query->where('title', 'like', "%$q%")
                          ->orWhere('excerpt', 'like', "%$q%")
                          ->orWhere('body', 'like', "%$q%");
                })
                ->with(['author','category'])
                ->orderByDesc('created_at')
                ->paginate(10)
                ->appends(['q' => $q]);
        }
        return view('dashboard.search', compact('q','results'));
    })->name('search');
    Route::get('/stats', function () {
        return view('dashboard.stats');
    })->name('stats');

    Route::get('/purchases', function () {
        return view('dashboard.purchases');
    })->name('purchases');

    Route::get('/products', function () {
        return view('dashboard.products');
    })->name('products');

    Route::get('/wallet', function () {
        return view('dashboard.wallet');
    })->name('wallet');

    // Author: My Posts (non-admin users)
    Route::get('/my-posts', function () {
        $posts = \App\Models\Blog::with(['category'])
            ->where('author_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('dashboard.my-posts', compact('posts'));
    })->name('my-posts');
});

// API routes for AJAX functionality
Route::prefix('api')->name('api.')->middleware('throttle:60,1')->group(function () {
    Route::post('analytics/track', [BlogController::class, 'trackAnalytics'])->name('analytics.track');
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('blogs/{blog}/like', [BlogController::class, 'like'])->name('blogs.like');
    Route::post('blogs/{blog}/bookmark', [BlogController::class, 'bookmark'])->name('blogs.bookmark');
    Route::post('blogs/{blog}/share', [BlogController::class, 'share'])->name('blogs.share');
});

// Newsletter subscription
Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe'])->middleware('throttle:10,1')->name('newsletter.subscribe');

// Admin blog management routes (if needed)
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('blogs', AdminBlogController::class);
//     Route::get('analytics', [AdminBlogController::class, 'analytics'])->name('analytics');
// });

// Author pages
// Route::get('author/{author:slug}', [AuthorController::class, 'show'])->name('author.show');

// RSS Feed
// Route::get('blog/feed', [BlogController::class, 'feed'])->name('blog.feed');

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('sitemap/blogs.xml', [SitemapController::class, 'blogs'])->name('sitemap.blogs');

// Search
// Route::get('search', [SearchController::class, 'index'])->name('search');
// Route::post('search', [SearchController::class, 'search'])->name('search.post');

// Category and tag routes (moved into blog group above)

// Archive routes
// Route::get('archive/{year}', [BlogController::class, 'archive'])->name('blog.archive.year');
// Route::get('archive/{year}/{month}', [BlogController::class, 'archive'])->name('blog.archive.month');


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

    // Admin-only dashboard routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/blog', function () {
            return redirect()->route('dashboard.blog.manage');
        })->name('dashboard.blog');

        Route::get('/dashboard/blog/compose', function () {
            $categories = \App\Models\BlogCategory::orderBy('name')->get();
            return view('dashboard.blog-compose', compact('categories'));
        })->name('dashboard.blog.compose');

        Route::get('/dashboard/blog/manage', function () {
            $posts = \App\Models\Blog::with(['author', 'category'])->orderByDesc('created_at')->paginate(10);
            return view('dashboard.blog-manage', compact('posts'));
        })->name('dashboard.blog.manage');

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

        // Policy Management
        Route::get('/dashboard/policies', [PolicyController::class, 'adminIndex'])->name('dashboard.policies');
        Route::get('/dashboard/policies/create', [PolicyController::class, 'adminCreate'])->name('dashboard.policies.create');
        Route::post('/dashboard/policies', [PolicyController::class, 'adminStore'])->name('dashboard.policies.store');
        Route::get('/dashboard/policies/{policy}/edit', [PolicyController::class, 'adminEdit'])->name('dashboard.policies.edit');
        Route::put('/dashboard/policies/{policy}', [PolicyController::class, 'adminUpdate'])->name('dashboard.policies.update');
        Route::delete('/dashboard/policies/{policy}', [PolicyController::class, 'adminDestroy'])->name('dashboard.policies.destroy');
        Route::post('/dashboard/policies/bulk-update', [PolicyController::class, 'adminBulkUpdate'])->name('dashboard.policies.bulk-update');

        // Legacy policy update route
        Route::post('/dashboard/policy/{key}', [PolicyController::class, 'update'])->name('dashboard.policy.update');

        Route::post('/dashboard/blog', [BlogController::class, 'store'])->name('dashboard.blog.store');
        Route::put('/dashboard/blog/{blog}', [BlogController::class, 'update'])->name('dashboard.blog.update');
        Route::delete('/dashboard/blog/{blog}', [BlogController::class, 'destroy'])->name('dashboard.blog.destroy');
        Route::patch('/dashboard/blog/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('dashboard.blog.toggle-status');
        Route::post('/dashboard/category', [BusinessCategoryController::class, 'store'])->name('dashboard.category.store');
        Route::post('/dashboard/team', [TeamController::class, 'store'])->name('dashboard.team.store');
        Route::put('/dashboard/team/{member}', [TeamController::class, 'update'])->name('dashboard.team.update');
        Route::delete('/dashboard/team/{member}', [TeamController::class, 'destroy'])->name('dashboard.team.destroy');
        Route::post('/dashboard/career', [CareerController::class, 'store'])->name('dashboard.career.store');
        Route::post('/dashboard/partner', [PartnerController::class, 'store'])->name('dashboard.partner.store');
        Route::post('/dashboard/developer-platform', [DeveloperPlatformController::class, 'store'])->name('dashboard.developer-platform.store');
        Route::post('/dashboard/hardware-rental', [HardwareRentalController::class, 'store'])->name('dashboard.hardware-rental.store');
        Route::post('/dashboard/price', [PriceController::class, 'store'])->name('dashboard.price.store');

        Route::post('/dashboard/offering', [OfferingController::class, 'store'])->name('dashboard.offering.store');
        Route::put('/dashboard/offering/{offering}', [OfferingController::class, 'update'])->name('dashboard.offering.update');
        Route::delete('/dashboard/offering/{offering}', [OfferingController::class, 'destroy'])->name('dashboard.offering.destroy');

        // Services routes
        Route::get('/dashboard/services', [ServicesController::class, 'adminIndex'])->name('dashboard.services.index');
        Route::resource('dashboard/services', ServicesController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])->names('dashboard.services');

        // Users
        Route::get('/dashboard/users', function () {
            $users = \App\Models\User::orderBy('name')->get();
            return view('dashboard.users', compact('users'));
        })->name('dashboard.users');
        Route::post('/dashboard/users', [UserManagementController::class, 'store'])->name('dashboard.users.store');
        Route::put('/dashboard/users/{user}', [UserManagementController::class, 'update'])->name('dashboard.users.update');
        Route::delete('/dashboard/users/{user}', [UserManagementController::class, 'destroy'])->name('dashboard.users.destroy');
    });
});
