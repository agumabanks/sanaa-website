<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\TeamMember;
use App\Models\LandingPageSetting;
use App\Models\IndustrySolution;
use App\Models\Capability;
use App\Models\LandingPricingPlan;
use App\Models\LandingStat;
use App\Models\Offering;

class PageController extends Controller
{
    public function home($locale = null)
    {
        $sokoProducts = [];

        $teamMembers = Cache::remember('team_members_all', now()->addDay(), function () {
            return TeamMember::all();
        });

        $landingData = Cache::remember('landing_page_data', 3600, function () {
            return [
                'settings' => LandingPageSetting::pluck('value', 'key')->toArray(),
                'industries' => IndustrySolution::active()->ordered()->get(),
                'capabilities' => Capability::active()->ordered()->get(),
                'pricingPlans' => LandingPricingPlan::active()->ordered()->get(),
                'stats' => LandingStat::active()->section('join')->ordered()->get(),
                'offerings' => Offering::latest()->take(6)->get(),
                'sections' => \App\Models\LandingSection::active()->ordered()->get(),
            ];
        });

        return view('pages.home', [
            'sokoProducts' => $sokoProducts,
            'teamMembers' => $teamMembers,
            'settings' => $landingData['settings'] ?? [],
            'industries' => $landingData['industries'] ?? collect(),
            'capabilities' => $landingData['capabilities'] ?? collect(),
            'pricingPlans' => $landingData['pricingPlans'] ?? collect(),
            'stats' => $landingData['stats'] ?? collect(),
            'offerings' => $landingData['offerings'] ?? collect(),
            'sections' => $landingData['sections'] ?? collect(),
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
        $cacheKey = 'soko_product_v2_' . $productId;

        try {
            $productData = Cache::remember($cacheKey, 3600, function () use ($productId) {
                $response = Http::timeout(2)->get('https://soko.sanaa.co/api/v2/products/' . $productId);

                if (!$response->successful()) {
                    throw new \RuntimeException('Remote API returned status ' . $response->status());
                }

                $payload = $response->json();
                $products = data_get($payload, 'data');

                if (!is_array($products) || empty($products)) {
                    throw new \RuntimeException('Remote API returned an empty dataset');
                }

                $product = collect($products)->first(function ($item) use ($productId) {
                    return (string) data_get($item, 'id') === (string) $productId;
                });

                if (!$product) {
                    throw new \RuntimeException('Requested product not found in remote payload');
                }

                return [
                    'success' => true,
                    'data' => [
                        'id' => data_get($product, 'id'),
                        'slug' => data_get($product, 'slug'),
                        'name' => data_get($product, 'name'),
                        'thumbnail_image' => data_get($product, 'thumbnail_image'),
                        'has_discount' => (bool) data_get($product, 'has_discount', false),
                        'discount' => data_get($product, 'discount'),
                        'main_price' => data_get($product, 'main_price'),
                        'stroked_price' => data_get($product, 'stroked_price'),
                        'links' => data_get($product, 'links', []),
                        'description' => data_get($product, 'description'),
                    ],
                ];
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
        $page = Cache::remember('investor_relations_page', 3600, function () {
            return \App\Models\InvestorRelationsPage::first();
        });

        return view('pages.investor-relations', compact('page'));
    }
}
