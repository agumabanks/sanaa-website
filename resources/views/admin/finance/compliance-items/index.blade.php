@extends('layouts.dashboard', ['title' => 'Compliance'])
@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Compliance Items</h1>
        <a href="{{ route('admin.finance.compliance-items.create') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">New</a>
    </div>
    <div class="overflow-x-auto bg-white border rounded">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600"><tr><th class="py-2 px-3">Standard</th><th class="py-2 px-3">Status</th><th class="py-2 px-3">Last Updated</th><th class="py-2 px-3"></th></tr></thead>
            <tbody>
                @foreach($items as $item)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $item->standard }}</td>
                    <td class="py-2 px-3">{{ $item->status }}</td>
                    <td class="py-2 px-3">{{ optional($item->last_updated)->format('Y-m-d') }}</td>
                    <td class="py-2 px-3 text-right">
                        <a class="text-emerald-700 mr-3" href="{{ route('admin.finance.compliance-items.edit', $item) }}">Edit</a>
                        <form action="{{ route('admin.finance.compliance-items.destroy', $item) }}" method="post" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection

