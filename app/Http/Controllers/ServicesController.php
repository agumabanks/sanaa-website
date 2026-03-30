<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicesPageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of active services for public.
     */
    public function index()
    {
        $services = Service::where('active', true)->get();
        $settings = ServicesPageSetting::getAllSettings();
        return view('pages.services', compact('services', 'settings'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the services page settings editor.
     */
    public function editPage()
    {
        $settings = ServicesPageSetting::getAllSettings();
        return view('dashboard.services.page-settings', compact('settings'));
    }

    /**
     * Update the services page settings.
     */
    public function updatePage(Request $request)
    {
        $fields = [
            // Hero
            'hero_eyebrow', 'hero_title', 'hero_subtitle', 'hero_cta_primary_text', 'hero_cta_secondary_text',
            // Stats
            'stat_1_value', 'stat_1_label', 'stat_2_value', 'stat_2_label',
            'stat_3_value', 'stat_3_label', 'stat_4_value', 'stat_4_label',
            // Services Section
            'services_eyebrow', 'services_title', 'services_subtitle',
            // Why Sanaa
            'why_eyebrow', 'why_title', 'why_subtitle',
            // Sectors
            'sectors_eyebrow', 'sectors_title',
            // CTA
            'cta_eyebrow', 'cta_title', 'cta_subtitle', 'cta_primary_text', 
            'cta_secondary_text', 'cta_secondary_link', 'cta_footer',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $type = in_array($field, ['hero_subtitle', 'services_subtitle', 'why_subtitle', 'cta_subtitle']) ? 'textarea' : 'text';
                ServicesPageSetting::set($field, $request->input($field), $type);
            }
        }

        // Handle JSON fields (why_features, sectors)
        if ($request->has('why_features')) {
            ServicesPageSetting::set('why_features', $request->input('why_features'), 'json');
        }
        if ($request->has('sectors')) {
            ServicesPageSetting::set('sectors', $request->input('sectors'), 'json');
        }

        ServicesPageSetting::clearCache();

        return redirect()->route('dashboard.services.page')->with('success', 'Services page updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Service::create($request->all());

        return redirect()->route('dashboard.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $service->update($request->all());

        return redirect()->route('dashboard.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('dashboard.services.index')->with('success', 'Service deleted successfully.');
    }
}
