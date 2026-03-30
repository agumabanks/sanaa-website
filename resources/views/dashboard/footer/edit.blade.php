@extends('layouts.dashboard')

@section('title', 'Footer Settings')

@section('content')
<div class="py-10">
  <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded p-6">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold">Footer Settings</h1>
          <p class="text-gray-600">Edit footer links and content as structured JSON.</p>
        </div>
        @if (session('success'))
          <span class="px-3 py-1 rounded bg-green-100 text-green-700">{{ session('success') }}</span>
        @endif
      </div>

      <form method="POST" action="{{ route('dashboard.footer.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <label class="block text-sm font-medium text-gray-700">Content (JSON)</label>
        <textarea name="content" rows="26" class="w-full font-mono text-sm rounded border-gray-300 focus:ring-green-500 focus:border-green-500">{{ old('content', $contentJson) }}</textarea>
        @error('content')
          <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div class="flex items-center justify-end gap-2">
          <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded bg-gray-100">Preview Site</a>
          <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Save</button>
        </div>
      </form>

      <hr class="my-8">

      <h2 class="text-xl font-semibold mb-4">Add Page Link</h2>
      <form method="POST" action="{{ route('dashboard.footer.links.page') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700">Group</label>
          <select name="group" class="mt-1 w-full rounded border-gray-300" required>
            @foreach(['products'=>'Products','business_types'=>'Business Types','resources'=>'Resources','sanaa'=>'Sanaa','legal'=>'Legal'] as $k=>$v)
              <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
          </select>
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Page</label>
          <select name="page_id" class="mt-1 w-full rounded border-gray-300" required>
            @foreach($pages as $p)
              <option value="{{ $p->id }}">{{ $p->title }} (/{{ $p->slug }}) {{ $p->status ? '' : '— draft' }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Label (optional)</label>
          <input type="text" name="label" class="mt-1 w-full rounded border-gray-300" placeholder="Defaults to page title">
        </div>
        <div class="md:col-span-4 flex justify-end">
          <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Add Page Link</button>
        </div>
      </form>

      <hr class="my-8">

      <h2 class="text-xl font-semibold mb-4">Add Custom Link</h2>
      <form method="POST" action="{{ route('dashboard.footer.links.custom') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700">Group</label>
          <select name="group" class="mt-1 w-full rounded border-gray-300" required>
            @foreach(['products'=>'Products','business_types'=>'Business Types','resources'=>'Resources','sanaa'=>'Sanaa','legal'=>'Legal'] as $k=>$v)
              <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Label</label>
          <input type="text" name="label" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Type</label>
          <select name="type" class="mt-1 w-full rounded border-gray-300" required>
            <option value="url">URL</option>
            <option value="route">Route Name</option>
          </select>
        </div>
        <div class="md:col-span-3">
          <label class="block text-sm font-medium text-gray-700">Value</label>
          <input type="text" name="value" class="mt-1 w-full rounded border-gray-300" placeholder="https://... or route.name" required>
        </div>
        <div class="md:col-span-6 flex justify-end">
          <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Add Custom Link</button>
        </div>
      </form>

      <hr class="my-8">

      <h2 class="text-xl font-semibold mb-4">Current Links</h2>
      @php $groups = ['products'=>'Products','business_types'=>'Business Types','resources'=>'Resources','sanaa'=>'Sanaa','legal'=>'Legal']; @endphp
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($groups as $key => $label)
          <div>
            <h3 class="font-medium text-gray-800 mb-2">{{ $label }}</h3>
            <div class="bg-gray-50 border rounded">
              <ul class="divide-y">
                @forelse(($content[$key] ?? []) as $idx => $link)
                  <li class="flex items-center justify-between px-3 py-2 text-sm">
                    <span class="text-gray-800">{{ $link['label'] }} <span class="text-gray-500">→ {{ $link['route'] ?? $link['url'] ?? '#' }}</span></span>
                    <form method="POST" action="{{ route('dashboard.footer.links.delete') }}" onsubmit="return confirm('Remove this link?');">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="group" value="{{ $key }}">
                      <input type="hidden" name="index" value="{{ $idx }}">
                      <button class="text-red-600 hover:text-red-700">Remove</button>
                    </form>
                  </li>
                @empty
                  <li class="px-3 py-2 text-gray-500">No links</li>
                @endforelse
              </ul>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
