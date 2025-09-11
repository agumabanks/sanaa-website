@extends('layouts.dashboard', ['title' => 'Edit Team Member'])
@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Team Member</h1>
    <form action="{{ route('admin.finance.team-members.update', $teamMember) }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.finance.team-members.partials.form', ['member' => $teamMember])
        <button class="inline-flex rounded bg-emerald-600 text-white px-4 py-2 text-sm">Update</button>
    </form>
</div>
@endsection

