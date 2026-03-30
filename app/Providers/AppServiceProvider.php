<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SeoComposer;
use App\Http\View\Composers\MenuComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', SeoComposer::class);
        
        // Share menu data with header and navigation views
        View::composer([
            'components.header',
            'components.footer',
            'components.navbar',
            'layouts.*',
        ], MenuComposer::class);
    }
}
