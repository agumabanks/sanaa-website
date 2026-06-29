<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Append TrackPageView to web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\TrackPageView::class,
            \App\Http\Middleware\CacheControl::class,
        ]);
        
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminOnly::class,
            'finance' => \App\Http\Middleware\FinanceMiddleware::class,
            'track.pageview' => \App\Http\Middleware\TrackPageView::class,
            'cache.control' => \App\Http\Middleware\CacheControl::class,
        ]);
    })
    ->withSchedule(function (\Illuminate\Console\Scheduling\Schedule $schedule) {
        $schedule->command('blog:backfill-seo --published-only')->dailyAt('03:15');
        $schedule->command('sitemap:sanaa')->weekly();
        $schedule->command('sitemap:generate')->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
