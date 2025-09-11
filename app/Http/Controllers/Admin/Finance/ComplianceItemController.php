<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceComplianceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplianceItemController extends Controller
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
        $items = FinanceComplianceItem::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.finance.compliance-items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.compliance-items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'standard' => 'required|string|max:255',
            'status' => 'required|in:pending,in-progress,achieved',
            'evidence_file' => 'nullable|file|mimes:pdf|max:5120',
            'evidence_link' => 'nullable|url',
            'last_updated' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('evidence_file')) {
            $validated['evidence_file'] = $request->file('evidence_file')->store('finance/compliance', 'public');
        }

        FinanceComplianceItem::create($validated);

        return redirect()->route('admin.finance.compliance-items.index')
            ->with('success', 'Compliance item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceComplianceItem $complianceItem)
    {
        return view('admin.finance.compliance-items.show', compact('complianceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceComplianceItem $complianceItem)
    {
        return view('admin.finance.compliance-items.edit', compact('complianceItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinanceComplianceItem $complianceItem)
    {
        $validated = $request->validate([
            'standard' => 'required|string|max:255',
            'status' => 'required|in:pending,in-progress,achieved',
            'evidence_file' => 'nullable|file|mimes:pdf|max:5120',
            'evidence_link' => 'nullable|url',
            'last_updated' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('evidence_file')) {
            // Delete old file if exists
            if ($complianceItem->evidence_file) {
                Storage::disk('public')->delete($complianceItem->evidence_file);
            }
            $validated['evidence_file'] = $request->file('evidence_file')->store('finance/compliance', 'public');
        }

        $complianceItem->update($validated);

        return redirect()->route('admin.finance.compliance-items.index')
            ->with('success', 'Compliance item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceComplianceItem $complianceItem)
    {
        // Delete associated file if exists
        if ($complianceItem->evidence_file) {
            Storage::disk('public')->delete($complianceItem->evidence_file);
        }

        $complianceItem->delete();

        return redirect()->route('admin.finance.compliance-items.index')
            ->with('success', 'Compliance item deleted successfully.');
    }
}
