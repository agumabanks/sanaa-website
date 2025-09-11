<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinancePricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
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
        $plans = FinancePricingPlan::orderBy('sort_order')->paginate(15);

        return view('admin.finance.pricing-plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.pricing-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'monthly_price' => 'nullable|numeric|min:0',
            'annual_price' => 'nullable|numeric|min:0',
            'features' => 'required|array',
            'limits' => 'nullable|array',
            'cta_link' => 'nullable|url',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        FinancePricingPlan::create($validated);

        return redirect()->route('admin.finance.pricing-plans.index')
            ->with('success', 'Pricing plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancePricingPlan $pricingPlan)
    {
        return view('admin.finance.pricing-plans.show', compact('pricingPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancePricingPlan $pricingPlan)
    {
        return view('admin.finance.pricing-plans.edit', compact('pricingPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancePricingPlan $pricingPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'monthly_price' => 'nullable|numeric|min:0',
            'annual_price' => 'nullable|numeric|min:0',
            'features' => 'required|array',
            'limits' => 'nullable|array',
            'cta_link' => 'nullable|url',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $pricingPlan->update($validated);

        return redirect()->route('admin.finance.pricing-plans.index')
            ->with('success', 'Pricing plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancePricingPlan $pricingPlan)
    {
        $pricingPlan->delete();

        return redirect()->route('admin.finance.pricing-plans.index')
            ->with('success', 'Pricing plan deleted successfully.');
    }
}
