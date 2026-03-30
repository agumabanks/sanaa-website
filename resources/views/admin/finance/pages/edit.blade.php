@extends('layouts.dashboard', ['title' => 'Edit Finance Page'])
@section('content')
<div class="p-6 max-w-3xl">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Edit: {{ $page->title }}</h1>
        <a href="{{ route('finance.show', ['page' => $page->slug]) }}" class="text-sm text-emerald-700 hover:underline" target="_blank">View</a>
    </div>
    <form action="{{ route('admin.finance.pages.update', $page) }}" method="post" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.finance.pages.partials.form', ['page' => $page])
        <div class="pt-2">
            <button class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">Update</button>
            <a href="{{ route('admin.finance.pages.index') }}" class="ml-2 text-gray-700">Back</a>
        </div>
    </form>
</div>
@endsection
