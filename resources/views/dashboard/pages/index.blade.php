@extends('layouts.dashboard')

@section('title', 'Pages')

@section('content')
<div class="py-10">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Pages</h1>
        <p class="text-gray-600">Manage public pages shown on the website.</p>
      </div>
      <a href="{{ route('dashboard.pages.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add New Page</a>
    </div>

    @if (session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
      <table class="min-w-full">
        <thead>
          <tr class="bg-gray-50 text-left text-gray-700">
            <th class="px-4 py-3">Title</th>
            <th class="px-4 py-3">Slug</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Updated</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($pages as $page)
            <tr>
              <td class="px-4 py-3 font-medium text-gray-900">{{ $page->title }}</td>
              <td class="px-4 py-3 text-gray-700">/{{ $page->slug }}</td>
              <td class="px-4 py-3">
                @if($page->status)
                  <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Published</span>
                @else
                  <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Draft</span>
                @endif
              </td>
              <td class="px-4 py-3 text-gray-600">{{ $page->updated_at->diffForHumans() }}</td>
              <td class="px-4 py-3 text-right space-x-2">
                <a href="/{{ $page->slug }}" target="_blank" class="px-3 py-1 text-sm bg-gray-100 rounded hover:bg-gray-200">View</a>
                <a href="{{ route('dashboard.pages.edit', $page) }}" class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                <form action="{{ route('dashboard.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Delete this page?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td class="px-4 py-6 text-gray-500" colspan="5">No pages yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">{{ $pages->links() }}</div>
  </div>
</div>
@endsection

