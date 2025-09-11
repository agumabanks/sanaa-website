@extends('layouts.dashboard', ['title' => 'Admin → Finance'])
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Finance Admin</h1>
    <ul class="list-disc pl-6 text-sm">
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.pricing-plans.index') }}">Pricing Plans</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.cards.index') }}">Cards</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.technologies.index') }}">Technologies</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.team-members.index') }}">Team</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.communities.index') }}">Communities</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.compliance-items.index') }}">Compliance</a></li>
        <li><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.analytics') }}">Analytics</a></li>
    </ul>
</div>
@endsection

