<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class PageController extends Controller
{
    /**
     * Display the Home page.
     */
    public function home()
    {
        $sokoProducts = Http::get('https://soko.sanaa.co/api/v2/products')->json();
        $teamMembers = \App\Models\TeamMember::all();
        return view('pages.home', [
            'sokoProducts' => $sokoProducts,
            'teamMembers' => $teamMembers,
        ]);
    }

    /**
     * Get product details from Soko API
    */
    public function getProductDetails($productId)
    {
        // Try to get from cache first to improve performance
        $cacheKey = 'soko_product_' . $productId;
        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }
        
        try {
            // Make the API request from the server side
            $response = Http::get('https://soko.sanaa.co/api/v2/products/' . $productId);
            
            if ($response->successful()) {
                $productData = $response->json();
                
                // Cache the result for 1 hour (or whatever duration makes sense)
                Cache::put($cacheKey, $productData, 3600);
                
                return response()->json($productData);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch product details: ' . $response->status()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the Policy page.
     */
    public function policy()
    {
        return view('pages.policy');
    }

    /**
     * Display the Company page.
     */
    public function company()
    {
        return view('pages.company');
    }


    /**
     * Display the Support page.
     */
    public function support()
    {
        return view('pages.support');
    }

    /**
     * Display the Products page.
     */
    public function products()
    {
        return view('pages.products');
    }

    /**
     * Display the Services page.
     */
    public function services()
    {
        return view('pages.services');
    }

    /**
     * Display the Bulk SMS page.
     */
    public function bulkSms()
    {
        return view('pages.bulk-sms');
    }

    /**
     * Display the Prices page.
     */
    public function prices()
    {
        return view('pages.prices');
    }

    /**
     * Display the Why Sanaa marketing page.
     */
    public function whySanaa()
    {
        $content = include resource_path('content/why-sanaa.php');
        return view('pages.why-sanaa', ['c' => $content]);
    }
}
