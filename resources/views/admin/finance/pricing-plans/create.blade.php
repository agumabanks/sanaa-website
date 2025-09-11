@extends('layouts.dashboard', ['title' => 'New Pricing Plan'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">New Pricing Plan</h1>
    <form action="{{ route('admin.finance.pricing-plans.store') }}" method="post" class="space-y-4">
        @csrf
        @include('admin.finance.pricing-plans.partials.form')
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Save</button>
    </form>
</div>
@endsection

