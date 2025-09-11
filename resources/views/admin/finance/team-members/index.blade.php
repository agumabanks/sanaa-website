@extends('layouts.dashboard', ['title' => 'Team Members'])
@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Team Members</h1>
        <a href="{{ route('admin.finance.team-members.create') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">New</a>
    </div>
    <div class="overflow-x-auto bg-white border rounded">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600"><tr><th class="py-2 px-3">Name</th><th class="py-2 px-3">Role</th><th class="py-2 px-3"></th></tr></thead>
            <tbody>
                @foreach($members as $m)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $m->name }}</td>
                    <td class="py-2 px-3">{{ $m->role }}</td>
                    <td class="py-2 px-3 text-right">
                        <a class="text-emerald-700 mr-3" href="{{ route('admin.finance.team-members.edit', $m) }}">Edit</a>
                        <form action="{{ route('admin.finance.team-members.destroy', $m) }}" method="post" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $members->links() }}</div>
</div>
@endsection

