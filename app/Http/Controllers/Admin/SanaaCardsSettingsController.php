<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanaaCardsPageSetting;
use Illuminate\Http\Request;

class SanaaCardsSettingsController extends Controller
{
    public function edit()
    {
        $settings = SanaaCardsPageSetting::getAllSettings();
        return view('admin.sanaa-cards.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        // Handle text fields
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                continue;
            }

            $setting = SanaaCardsPageSetting::where('key', $key)->first();
            $type = $setting ? $setting->type : 'text';

            SanaaCardsPageSetting::set($key, $value, $type);
        }

        // Handle file uploads
        foreach ($request->allFiles() as $key => $file) {
            $path = $file->store('sanaa-cards', 'public');
            $url = asset('storage/' . $path);

            $setting = SanaaCardsPageSetting::where('key', $key)->first();
            $type = $setting ? $setting->type : 'image';

            SanaaCardsPageSetting::set($key, $url, $type);
        }

        return redirect()->back()->with('success', 'Page settings updated successfully.');
    }
}
