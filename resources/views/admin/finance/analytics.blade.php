@extends('layouts.dashboard', ['title' => 'Finance Analytics'])
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Finance Analytics</h1>
    <p class="text-gray-600">Simple counters (stub):</p>
    <ul class="mt-3 text-sm list-disc pl-6">
        <li>Pricing Plans: {{ \App\Models\FinancePricingPlan::count() }}</li>
        <li>Cards: {{ \App\Models\FinanceCard::count() }}</li>
        <li>Technologies: {{ \App\Models\FinanceTechnology::count() }}</li>
        <li>Team Members: {{ \App\Models\FinanceTeamMember::count() }}</li>
        <li>Communities: {{ \App\Models\FinanceCommunity::count() }}</li>
        <li>Pages: {{ \App\Models\FinancePage::count() }}</li>
    </ul>
</div>
@endsection

