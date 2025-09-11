<?php

namespace App\Http\Controllers;

use App\Models\FinanceCard;
use App\Models\FinanceCommunity;
use App\Models\FinancePage;
use App\Models\FinancePricingPlan;
use App\Models\FinanceTeamMember;
use App\Models\FinanceTechnology;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    // Landing
    public function index()
    {
        return view('finance.index', [
            'pricingPlans' => FinancePricingPlan::active()->get(),
            'cards' => FinanceCard::published()->get(),
            'technologies' => FinanceTechnology::active()->get(),
            'team' => FinanceTeamMember::active()->get(),
            'communities' => FinanceCommunity::active()->get(),
            'pages' => FinancePage::published()->latest()->limit(6)->get(),
        ]);
    }

    // IA pages (render dedicated templates; fallback to CMS page if exists)
    public function overview() { return $this->renderCmsOr('overview'); }
    public function pricing() { return view('finance.pricing', ['plans' => FinancePricingPlan::active()->get()]); }
    public function cards() { return view('finance.cards', ['cards' => FinanceCard::published()->get()]); }
    public function technologies() { return view('finance.technologies', ['items' => FinanceTechnology::active()->get()]); }
    public function team() { return view('finance.team', ['members' => FinanceTeamMember::active()->get()]); }
    public function communities() { return view('finance.communities', ['items' => FinanceCommunity::active()->get()]); }
    public function compliance() { return view('finance.compliance'); }
    public function testimonials() { return view('finance.testimonials'); }
    public function solutions() { return view('finance.solutions'); }
    public function benchmarking() { return view('finance.benchmarking'); }
    public function resources() { return view('finance.resources'); }
    public function promise() { return view('finance.promise'); }
    public function clients() { return view('finance.clients'); }
    public function betterBanking() { return view('finance.better-banking'); }
    public function contactSales() { return view('finance.contact-sales'); }
    public function contactSalesSuccess() { return view('finance.contact-sales-success'); }
    public function aiDriven() { return view('finance.ai-driven'); }
    public function automationAccounting() { return view('finance.automation-accounting'); }
    public function stats() { return view('finance.stats'); }
    public function founderMessage() { return view('finance.founder-message'); }
    public function cloudAlerts() { return view('finance.cloud-alerts'); }
    public function newsInsights() { return view('finance.news-insights'); }

    // Section search
    public function search(Request $request)
    {
        $q = trim((string) $request->string('q'));
        $pages = FinancePage::published()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhereJsonContains('content->blocks', $q);
            })
            ->latest()
            ->paginate(10)
            ->appends(['q' => $q]);

        return view('finance.search', compact('q', 'pages'));
    }

    // CMS page by slug (only published unless creator)
    public function show(FinancePage $page)
    {
        if ($page->status !== 'published') {
            if (!auth()->check() || auth()->id() !== $page->created_by) {
                abort(404);
            }
        }

        return view('finance.pages.show', ['page' => $page]);
    }

    // Helpers
    private function renderCmsOr(string $slug)
    {
        $page = FinancePage::published()->where('slug', $slug)->first();
        if ($page) {
            return view('finance.pages.show', ['page' => $page]);
        }
        return view("finance.$slug");
    }
}
