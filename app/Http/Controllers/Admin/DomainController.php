<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomainSetting;
use App\Services\DomainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    /**
     * Display the domain settings page
     */
    public function index()
    {
        $domains = DomainSetting::with('updater')->orderBy('key')->get();
        return view('admin.domains.index', compact('domains'));
    }

    /**
     * Show the form for editing a domain setting
     */
    public function edit(DomainSetting $domain)
    {
        return view('admin.domains.edit', compact('domain'));
    }

    /**
     * Update the specified domain setting
     */
    public function update(Request $request, DomainSetting $domain)
    {
        $validator = Validator::make($request->all(), [
            'domain' => 'required|string|max:255|regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $oldDomain = $domain->domain;
        $domain->update([
            'domain' => $request->domain,
            'is_active' => $request->has('is_active'),
            'last_updated_by' => Auth::id(),
        ]);

        // Clear cache
        Cache::forget("domain_{$domain->key}");
        Cache::forget('all_domains');

        Log::info('Domain updated', [
            'key' => $domain->key,
            'old_domain' => $oldDomain,
            'new_domain' => $request->domain,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard.domains.index')
            ->with('success', 'Domain setting updated successfully');
    }

    /**
     * Bulk update domain settings
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domains' => 'required|array',
            'domains.*.key' => 'required|string',
            'domains.*.domain' => 'required|string|max:255|regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'domains.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updatedCount = 0;
        foreach ($request->domains as $domainData) {
            $domain = DomainSetting::where('key', $domainData['key'])->first();
            if ($domain) {
                $domain->update([
                    'domain' => $domainData['domain'],
                    'is_active' => $domainData['is_active'] ?? false,
                    'last_updated_by' => Auth::id(),
                ]);
                $updatedCount++;
            }
        }

        // Clear all domain caches
        Cache::forget('all_domains');
        $allKeys = DomainSetting::pluck('key')->toArray();
        foreach ($allKeys as $key) {
            Cache::forget("domain_{$key}");
        }

        Log::info('Bulk domain update completed', [
            'updated_count' => $updatedCount,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard.domains.index')
            ->with('success', "{$updatedCount} domain settings updated successfully");
    }

    /**
     * Get current domain configuration for API
     */
    public function config()
    {
        return response()->json([
            'domains' => DomainService::getAllDomains(),
            'current_soko_domain' => DomainService::getSokoDomain(),
        ]);
    }
}
