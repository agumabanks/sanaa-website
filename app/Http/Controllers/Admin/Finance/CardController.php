<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('finance');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = FinanceCard::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.finance.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fees' => 'nullable|array',
            'features' => 'nullable|array',
            'eligibility' => 'nullable|string',
            'faq' => 'nullable|array',
            'tnc_file' => 'nullable|file|mimes:pdf|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('finance/cards', 'public');
        }

        if ($request->hasFile('tnc_file')) {
            $validated['tnc_file'] = $request->file('tnc_file')->store('finance/tnc', 'public');
        }

        FinanceCard::create($validated);

        return redirect()->route('admin.finance.cards.index')
            ->with('success', 'Card created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceCard $card)
    {
        return view('admin.finance.cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceCard $card)
    {
        return view('admin.finance.cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinanceCard $card)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fees' => 'nullable|array',
            'features' => 'nullable|array',
            'eligibility' => 'nullable|string',
            'faq' => 'nullable|array',
            'tnc_file' => 'nullable|file|mimes:pdf|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($card->image) {
                Storage::disk('public')->delete($card->image);
            }
            $validated['image'] = $request->file('image')->store('finance/cards', 'public');
        }

        if ($request->hasFile('tnc_file')) {
            // Delete old T&C file if exists
            if ($card->tnc_file) {
                Storage::disk('public')->delete($card->tnc_file);
            }
            $validated['tnc_file'] = $request->file('tnc_file')->store('finance/tnc', 'public');
        }

        $card->update($validated);

        return redirect()->route('admin.finance.cards.index')
            ->with('success', 'Card updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceCard $card)
    {
        // Delete associated files
        if ($card->image) {
            Storage::disk('public')->delete($card->image);
        }
        if ($card->tnc_file) {
            Storage::disk('public')->delete($card->tnc_file);
        }

        $card->delete();

        return redirect()->route('admin.finance.cards.index')
            ->with('success', 'Card deleted successfully.');
    }
}
