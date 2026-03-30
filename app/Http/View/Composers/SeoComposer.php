<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Request;
use App\Models\SitePage;
use Illuminate\Support\Str;

class SeoComposer
{
    public function compose(View $view)
    {
        // Try to match the current path to a SitePage slug
        $path = Request::path();
        
        // Handle home page case
        if ($path === '/') {
            $slug = 'home';
        } else {
            $slug = $path;
        }

        // Cache this lookup to avoid DB query on every view composer call if possible
        // But for View Composers that run on every request, simpler might be better initially.
        // Let's rely on standard Eloquent query, it's fast enough for a single row lookup.
        
        $page = SitePage::where('slug', $slug)->first();

        // If no direct match, try matching strictly content page content if applicable
        // But usually 'slug' should match the URL path segment.
        
        if ($page) {
            // Inject SEO data if the view doesn't already have it specifically set
            if ($page->meta_title) {
                $view->with('seo_title', $page->meta_title);
            }
            
            if ($page->meta_description) {
                $view->with('seo_description', $page->meta_description);
            }
            
            if ($page->meta_keywords) {
                $view->with('seo_keywords', $page->meta_keywords);
            }

            if ($page->meta_image) {
                $view->with('seo_image', asset($page->meta_image));
            }
        }
    }
}
