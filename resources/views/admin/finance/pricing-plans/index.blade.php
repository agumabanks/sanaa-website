@extends('layouts.dashboard', ['title' => 'Pricing Plans'])
@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Pricing Plans</h1>
        <a href="{{ route('admin.finance.pricing-plans.create') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">New</a>
    </div>
    <div class="overflow-x-auto bg-white border rounded">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600">
                <tr><th class="py-2 px-3">Name</th><th class="py-2 px-3">Active</th><th class="py-2 px-3"></th></tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                    <tr class="border-t">
                        <td class="py-2 px-3">{{ $plan->name }}</td>
                        <td class="py-2 px-3">{{ $plan->is_active ? 'Yes' : 'No' }}</td>
                        <td class="py-2 px-3 text-right">
                            <a class="text-emerald-700 mr-3" href="{{ route('admin.finance.pricing-plans.edit', $plan) }}">Edit</a>
                            <form action="{{ route('admin.finance.pricing-plans.destroy', $plan) }}" method="post" class="inline" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $plans->links() }}</div>
    @if(session('success'))<div class="mt-4 text-emerald-700">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="mt-2 text-red-700">{{ $errors->first() }}</div>@endif
    </div>
@endsection

