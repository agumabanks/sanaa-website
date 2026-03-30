@extends('layouts.dashboard', ['title' => 'New Finance Page'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">New Finance Page</h1>
    <form action="{{ route('admin.finance.pages.store') }}" method="post" class="space-y-4">
        @csrf
        @include('admin.finance.pages.partials.form')
        <div class="pt-2">
            <button class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">Save</button>
            <a href="{{ route('admin.finance.pages.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </div>
    </form>
</div>
@endsection
