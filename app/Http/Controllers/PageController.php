<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\TeamMember;


class PageController extends Controller
{
    /**
     * Display the Home page.
     */
    public function home()
    {
        $sokoProducts = [];
        try {
            $sokoProducts = Cache::remember('soko_products', 3600, function () {
                $response = Http::timeout(2)->get('https://soko.sanaa.co/api/v2/products');

                if (!$response->successful()) {
                    throw new \RuntimeException('Remote API returned status ' . $response->status());
                }

                $json = $response->json();
                if (is_array($json) && isset($json['data']) && is_array($json['data']) && count($json['data']) > 0) {
                    return $json;
                }

                // Treat empty or malformed as an error to avoid caching bad data
                throw new \RuntimeException('Remote API returned empty or malformed payload');
            });
        } catch (\Throwable $e) {
            Log::warning('Failed to load Soko products; using fallback', [
                'error' => $e->getMessage(),
            ]);
            // Fallback is not cached to allow quick recovery once API is back
            $sokoProducts = $this->fallbackSokoProducts();
        }
        $cacheKey = 'team_members_all';
        if (Cache::has($cacheKey)) {
            Log::debug("Cache hit: {$cacheKey}");
        }

        $teamMembers = Cache::remember($cacheKey, now()->addDay(), function () use ($cacheKey) {
            Log::debug("Cache miss: {$cacheKey}");
            return TeamMember::all();
        });

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
        $cacheKey = 'soko_product_' . $productId;

        try {
            $productData = Cache::remember($cacheKey, 3600, function () use ($productId) {
                $response = Http::timeout(2)->get('https://soko.sanaa.co/api/v2/products/' . $productId);

                if (!$response->successful()) {
                    throw new \RuntimeException('Remote API returned status ' . $response->status());
                }

                return $response->json();
            });

            return response()->json($productData);
        } catch (\Throwable $e) {
            Log::warning('Failed to fetch product details', [
                'productId' => $productId,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'We couldn\'t load the product details right now. Please try again shortly.'
            ], 502);
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

    /**
     * Display the Investor Relations page.
     */
    public function investorRelations()
    {
        return view('pages.investor-relations');
    }
}
