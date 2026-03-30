@extends('layouts.dashboard', ['title' => 'Finance Pages'])
@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Finance Pages</h1>
        <a href="{{ route('admin.finance.pages.create') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">New</a>
    </div>
    <div class="bg-white border rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Slug</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Indexed</th>
                    <th class="px-4 py-2">Updated</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
            @forelse($pages as $page)
                <tr class="border-t">
                    <td class="px-4 py-2"><a class="text-emerald-700 hover:underline" href="{{ route('admin.finance.pages.edit', $page) }}">{{ $page->title }}</a></td>
                    <td class="px-4 py-2 text-gray-600">{{ $page->slug }}</td>
                    <td class="px-4 py-2">{{ ucfirst($page->status) }}</td>
                    <td class="px-4 py-2">{{ $page->is_indexed ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $page->updated_at->diffForHumans() }}</td>
                    <td class="px-4 py-2 text-right">
                        <a class="text-emerald-700 mr-3" href="{{ route('admin.finance.pages.edit', $page) }}">Edit</a>
                        <form action="{{ route('admin.finance.pages.destroy', $page) }}" method="post" class="inline" onsubmit="return confirm('Delete this page?')">
                            @csrf @method('DELETE')
                            <button class="text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td class="px-4 py-6 text-center text-gray-600" colspan="6">No pages yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pages->links() }}</div>
    <div class="mt-6 text-sm text-gray-600">Tip: Public URL for a page is <code>/finance/p/{slug}</code>. Some slugs (e.g., "overview") override dedicated views.</div>
    </div>
@endsection
