@extends('layouts.dashboard', ['title' => 'Technologies'])
@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Technologies</h1>
        <a href="{{ route('admin.finance.technologies.create') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">New</a>
    </div>
    <div class="overflow-x-auto bg-white border rounded">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600"><tr><th class="py-2 px-3">Name</th><th class="py-2 px-3">Active</th><th class="py-2 px-3"></th></tr></thead>
            <tbody>
                @foreach($technologies as $technology)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $technology->name }}</td>
                    <td class="py-2 px-3">{{ $technology->is_active ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-3 text-right">
                        <a class="text-emerald-700 mr-3" href="{{ route('admin.finance.technologies.edit', $technology) }}">Edit</a>
                        <form action="{{ route('admin.finance.technologies.destroy', $technology) }}" method="post" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $technologies->links() }}</div>
</div>
@endsection

