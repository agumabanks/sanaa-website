@extends('layouts.dashboard', ['title' => 'Edit Community'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Community</h1>
    <form action="{{ route('admin.finance.communities.update', $community) }}" method="post" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.finance.communities.partials.form', ['community' => $community])
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Update</button>
    </form>
</div>
@endsection

