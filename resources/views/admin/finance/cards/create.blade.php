@extends('layouts.dashboard', ['title' => 'New Card'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">New Card</h1>
    <form action="{{ route('admin.finance.cards.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @include('admin.finance.cards.partials.form')
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Save</button>
    </form>
</div>
@endsection

