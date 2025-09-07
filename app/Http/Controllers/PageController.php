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
        $sokoProducts = [];
        try {
            $response = Http::timeout(5)->get('https://soko.sanaa.co/api/v2/products');
            $json = $response->json();
            if (is_array($json) && isset($json['data']) && is_array($json['data']) && count($json['data']) > 0) {
                $sokoProducts = $json;
            } else {
                $sokoProducts = $this->fallbackSokoProducts();
            }
        } catch (\Throwable $e) {
            $sokoProducts = $this->fallbackSokoProducts();
        }
        $teamMembers = \App\Models\TeamMember::all();
        return view('pages.home', [
            'sokoProducts' => $sokoProducts,
            'teamMembers' => $teamMembers,
        ]);
    }

    private function fallbackSokoProducts(): array
    {
        // Minimal featured set to keep the UI populated when API is down
        return [
            'data' => [
                [
                    'id' => 'demo-1',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Merch Tee',
                    'has_discount' => false,
                    'discount' => null,
                    'main_price' => 'UGX 65,000',
                    'stroked_price' => null,
                ],
                [
                    'id' => 'demo-2',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Hoodie',
                    'has_discount' => true,
                    'discount' => '-20%',
                    'main_price' => 'UGX 120,000',
                    'stroked_price' => 'UGX 150,000',
                ],
                [
                    'id' => 'demo-3',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Mug',
                    'has_discount' => false,
                    'discount' => null,
                    'main_price' => 'UGX 25,000',
                    'stroked_price' => null,
                ],
                [
                    'id' => 'demo-4',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Cap',
                    'has_discount' => true,
                    'discount' => '-10%',
                    'main_price' => 'UGX 45,000',
                    'stroked_price' => 'UGX 50,000',
                ],
                [
                    'id' => 'demo-5',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Tote Bag',
                    'has_discount' => false,
                    'discount' => null,
                    'main_price' => 'UGX 30,000',
                    'stroked_price' => null,
                ],
                [
                    'id' => 'demo-6',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Notebook',
                    'has_discount' => false,
                    'discount' => null,
                    'main_price' => 'UGX 18,000',
                    'stroked_price' => null,
                ],
                [
                    'id' => 'demo-7',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Water Bottle',
                    'has_discount' => true,
                    'discount' => '-15%',
                    'main_price' => 'UGX 42,000',
                    'stroked_price' => 'UGX 49,500',
                ],
                [
                    'id' => 'demo-8',
                    'thumbnail_image' => asset('storage/images/sanaa.png'),
                    'name' => 'Sanaa Sticker Pack',
                    'has_discount' => false,
                    'discount' => null,
                    'main_price' => 'UGX 8,000',
                    'stroked_price' => null,
                ],
            ],
        ];
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
