@extends('layouts.dashboard')

@section('title', 'Edit Page')

@section('content')
<div class="py-10">
  <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded p-6">
      <h1 class="text-2xl font-bold mb-6">Edit Page</h1>
      <form action="{{ route('dashboard.pages.update', $page) }}" method="POST" class="space-y-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
          <label class="block text-sm font-medium text-gray-700">Title</label>
          <input name="title" value="{{ old('title', $page->title) }}" class="mt-1 block w-full rounded border-gray-300" required />
          @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Slug</label>
          <input name="slug" value="{{ old('slug', $page->slug) }}" class="mt-1 block w-full rounded border-gray-300" required />
          @error('slug')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Excerpt</label>
          <input name="excerpt" value="{{ old('excerpt', $page->excerpt) }}" class="mt-1 block w-full rounded border-gray-300" />
          @error('excerpt')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Content (HTML allowed)</label>
          <textarea name="content" rows="16" class="mt-1 block w-full rounded border-gray-300">{{ old('content', $page->content) }}</textarea>
          @error('content')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="mt-1 block w-full rounded border-gray-300" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Meta Keywords</label>
            <input name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="mt-1 block w-full rounded border-gray-300" />
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Meta Description</label>
          <input name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="mt-1 block w-full rounded border-gray-300" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Meta Image (og:image)</label>
          @if($page->meta_image)
            <div class="mb-2">
              <img src="{{ $page->meta_image }}" alt="Current Meta Image" class="h-32 w-auto object-cover rounded border border-gray-200" />
            </div>
          @endif
          <input type="file" name="meta_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
        </div>
        <div class="flex items-center justify-between">
          <label class="inline-flex items-center">
            <input type="hidden" name="status" value="0" />
            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-green-600" {{ old('status', $page->status) ? 'checked' : '' }}>
            <span class="ml-2 text-sm text-gray-700">Published</span>
          </label>
          <div class="space-x-2">
            <a href="{{ route('dashboard.pages.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            <button class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
