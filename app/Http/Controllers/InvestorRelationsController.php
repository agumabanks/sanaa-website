<?php

namespace App\Http\Controllers;

use App\Models\InvestorRelationsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class InvestorRelationsController extends Controller
{
    public function edit()
    {
        $page = InvestorRelationsPage::first();

        return view('dashboard.investor-relations-edit', compact('page'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $page = InvestorRelationsPage::first();
        if (!$page) {
            $page = new InvestorRelationsPage();
        }

        $page->fill(array_merge([
            'title' => $page->title ?? 'Investor Relations',
            'status' => $page->status ?? true,
        ], $validated));
        $page->last_updated_by = Auth::id();
        $page->save();

        Cache::forget('investor_relations_page');

        return redirect()->route('dashboard.investor-relations.edit')->with('success', 'Investor Relations page updated.');
    }
}

