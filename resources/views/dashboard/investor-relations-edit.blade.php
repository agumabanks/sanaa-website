@extends('layouts.dashboard')

@section('title', 'Investor Relations Page')

@section('content')
<div class="py-12">
  <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
      <div class="mb-6 flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Investor Relations Page</h1>
          <p class="text-gray-600">Edit the public Investor Relations content.</p>
        </div>
        @if(session('success'))
          <span class="text-green-700 bg-green-100 px-3 py-1 rounded">{{ session('success') }}</span>
        @endif
      </div>

      <form action="{{ route('dashboard.investor-relations.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input type="text" id="title" name="title" value="{{ old('title', $page->title ?? 'Investor Relations') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
          @error('title')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="content" class="block text-sm font-medium text-gray-700">Content (HTML allowed)</label>
          <textarea id="content" name="content" rows="18" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('content', $page->content ?? '') }}</textarea>
          @error('content')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
          </div>
          <div>
            <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
            <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $page->meta_description ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
          </div>
          <div>
            <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <input type="hidden" name="status" value="0" />
            <input type="checkbox" id="status" name="status" value="1" {{ old('status', ($page->status ?? true)) ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500" />
            <label for="status" class="text-sm text-gray-700">Published</label>
          </div>

          <div class="space-x-2">
            <a href="{{ route('investor-relations') }}" target="_blank" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">Preview</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
