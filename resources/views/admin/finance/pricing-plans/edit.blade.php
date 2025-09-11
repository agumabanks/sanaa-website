@extends('layouts.dashboard', ['title' => 'Edit Pricing Plan'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Pricing Plan</h1>
    <form action="{{ route('admin.finance.pricing-plans.update', $pricingPlan) }}" method="post" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.finance.pricing-plans.partials.form', ['plan' => $pricingPlan])
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Update</button>
    </form>
</div>
@endsection

