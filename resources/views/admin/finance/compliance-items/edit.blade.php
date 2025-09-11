@extends('layouts.dashboard', ['title' => 'Edit Compliance Item'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Compliance Item</h1>
    <form action="{{ route('admin.finance.compliance-items.update', $complianceItem) }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.finance.compliance-items.partials.form', ['item' => $complianceItem])
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Update</button>
    </form>
</div>
@endsection

