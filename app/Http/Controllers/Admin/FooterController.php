<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FooterController extends Controller
{
    public function edit()
    {
        $setting = FooterSetting::latest('updated_at')->first();
        $content = $setting?->content ?: self::defaultContent();

        return view('dashboard.footer.edit', [
            'content' => $content,
            'contentJson' => json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            'pages' => SitePage::orderBy('title')->get(['id','title','slug','status']),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $decoded = json_decode($validated['content'], true);
        if (!is_array($decoded)) {
            return back()->withErrors(['content' => 'Invalid JSON structure'])->withInput();
        }

        $setting = FooterSetting::latest('updated_at')->first();
        if (!$setting) {
            $setting = new FooterSetting();
        }
        $setting->content = $decoded;
        $setting->status = true;
        $setting->last_updated_by = Auth::id();
        $setting->save();

        Cache::forget('footer_settings_cached');

        return redirect()->route('dashboard.footer.edit')->with('success', 'Footer updated');
    }

    public function addCustomLink(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|in:products,business_types,resources,sanaa,legal',
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:url,route',
            'value' => 'required|string|max:255',
        ]);

        $content = ($current = FooterSetting::latest('updated_at')->first())?->content ?: self::defaultContent();

        $link = ['label' => $validated['label']];
        if ($validated['type'] === 'route') {
            $link['route'] = $validated['value'];
        } else {
            $link['url'] = $validated['value'];
        }

        $group = $validated['group'];
        $content[$group] = array_values(array_merge($content[$group] ?? [], [$link]));

        $setting = $current ?: new FooterSetting();
        $setting->content = $content;
        $setting->status = true;
        $setting->last_updated_by = Auth::id();
        $setting->save();

        Cache::forget('footer_settings_cached');

        return redirect()->route('dashboard.footer.edit')->with('success', 'Link added');
    }

    public function addPageLink(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|in:products,business_types,resources,sanaa,legal',
            'page_id' => 'required|exists:site_pages,id',
            'label' => 'nullable|string|max:255',
        ]);

        $page = SitePage::findOrFail($validated['page_id']);
        $label = $validated['label'] ?: $page->title;
        $url = url('/' . $page->slug);

        $content = ($current = FooterSetting::latest('updated_at')->first())?->content ?: self::defaultContent();

        $group = $validated['group'];
        $content[$group] = array_values(array_merge($content[$group] ?? [], [[
            'label' => $label,
            'url' => $url,
        ]]));

        $setting = $current ?: new FooterSetting();
        $setting->content = $content;
        $setting->status = true;
        $setting->last_updated_by = Auth::id();
        $setting->save();

        Cache::forget('footer_settings_cached');

        return redirect()->route('dashboard.footer.edit')->with('success', 'Page link added');
    }

    public function deleteLink(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|in:products,business_types,resources,sanaa,legal',
            'index' => 'required|integer|min:0',
        ]);

        $content = ($current = FooterSetting::latest('updated_at')->first())?->content ?: self::defaultContent();
        $group = $validated['group'];

        if (!isset($content[$group]) || !is_array($content[$group]) || !array_key_exists($validated['index'], $content[$group])) {
            return redirect()->route('dashboard.footer.edit')->with('success', 'Nothing to delete');
        }

        unset($content[$group][$validated['index']]);
        $content[$group] = array_values($content[$group]);

        $setting = $current ?: new FooterSetting();
        $setting->content = $content;
        $setting->status = true;
        $setting->last_updated_by = Auth::id();
        $setting->save();

        Cache::forget('footer_settings_cached');

        return redirect()->route('dashboard.footer.edit')->with('success', 'Link removed');
    }

    public static function defaultContent(): array
    {
        $sokoUrl = soko_domain_url();
        $sokoSellersUrl = soko_domain_url('sellers');

        return [
            'language_label' => 'United States (English)',
            'products' => [
                ['label' => 'Commerce', 'url' => $sokoUrl],
                ['label' => 'Point of Sale', 'url' => '#'],
                ['label' => 'Payments', 'url' => '#'],
                ['label' => 'Online', 'url' => '#'],
                ['label' => 'Kiosk', 'url' => '#'],
                ['label' => 'Invoices', 'url' => '#'],
                ['label' => 'Customers', 'url' => '#'],
                ['label' => 'Marketing', 'url' => '#'],
                ['label' => 'Loyalty', 'url' => '#'],
                ['label' => 'Customer Directory', 'url' => '#'],
                ['label' => 'Banking', 'url' => '#'],
                ['label' => 'Staff', 'url' => '#'],
                ['label' => 'Payroll', 'url' => '#'],
                ['label' => 'Advanced Access', 'url' => '#'],
                ['label' => 'Buy Now, Pay Later', 'url' => '#'],
                ['label' => 'Sanaa Media', 'url' => 'https://media.sanaa.co/'],
            ],
            'business_types' => [
                ['label' => 'Food & Beverage', 'url' => '#'],
                ['label' => 'Quick Service', 'url' => '#'],
                ['label' => 'Full Service', 'url' => '#'],
                ['label' => 'Bars & Breweries', 'url' => '#'],
                ['label' => 'Retail', 'url' => '#'],
                ['label' => 'Beauty Salon', 'url' => '#'],
                ['label' => 'Barbershop', 'url' => '#'],
                ['label' => 'Hair & Nail Salon', 'url' => '#'],
                ['label' => 'Tattoo & Piercing', 'url' => '#'],
                ['label' => 'Med spa', 'url' => '#'],
                ['label' => 'Fitness', 'url' => '#'],
                ['label' => 'Professional Services', 'url' => '#'],
                ['label' => 'Home & Repair', 'url' => '#'],
                ['label' => 'Large Businesses', 'url' => '#'],
                ['label' => 'Franchises', 'url' => '#'],
                ['label' => 'Schools', 'url' => '#'],
            ],
            'resources' => [
                ['label' => 'Pricing', 'route' => 'prices'],
                ['label' => 'Why Sanaa?', 'route' => 'why-sanaa'],
                ['label' => 'Testimonials', 'url' => '#'],
                ['label' => 'The Bottom Line', 'url' => '#'],
                ['label' => 'Sales', 'url' => '#'],
                ['label' => 'Support', 'route' => 'support'],
                ['label' => 'Seller Community', 'url' => $sokoSellersUrl],
                ['label' => 'Developer Platform', 'route' => 'developer-platforms'],
                ['label' => 'Merchant Services', 'url' => '#'],
                ['label' => 'Rent Hardware', 'route' => 'rent-hardware'],
                ['label' => 'Services', 'route' => 'services'],
                ['label' => 'Contact', 'route' => 'contact'],
            ],
            'contact' => [
                'support' => '0706 27-2481',
                'sales' => '0200 90-3222',
            ],
            'sanaa' => [
                ['label' => 'Press & Media', 'url' => '#'],
                ['label' => 'Careers', 'route' => 'careers'],
                ['label' => 'Referrals', 'url' => '#'],
                ['label' => 'Partners', 'route' => 'partners'],
                ['label' => 'Investor Relations', 'route' => 'investor-relations'],
                ['label' => 'My Sanaa', 'url' => 'https://os.sanaa.co/'],
            ],
            'social' => [
                'twitter' => '#',
                'facebook' => '#',
                'instagram' => '#',
            ],
            'legal' => [
                ['label' => 'Privacy Notice', 'route' => 'policies.privacy-notice'],
                ['label' => 'Security', 'route' => 'policies.security'],
                ['label' => 'Terms & Conditions', 'route' => 'terms'],
                ['label' => 'Seller Policies', 'route' => 'seller-policies'],
                ['label' => 'Government', 'route' => 'policies.government-licenses'],
                ['label' => 'Licenses', 'route' => 'policies.sanaa-brands-licenses'],
                ['label' => 'Sanaa Brands Licenses', 'route' => 'policies.sanaa-brands-licenses'],
                ['label' => 'Sanaa finance Licenses', 'url' => '#'],
                ['label' => 'Consumer Health Privacy', 'url' => '#'],
                ['label' => 'Hardware Compliance Certifications', 'url' => '#'],
                ['label' => 'Open Corporates.', 'url' => 'https://opencorporates.com/companies/ug/80020002748293'],
            ],
        ];
    }
}
