@php($technology = $technology ?? null)
<label class="block text-sm">Name
    <input name="name" value="{{ old('name', $technology->name ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Logo
    <input type="file" name="logo" accept="image/*" class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Description
    <textarea name="description" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('description', $technology->description ?? '') }}</textarea>
</label>
<div class="grid gap-4 sm:grid-cols-3">
    <label class="block text-sm">Link
        <input name="link" value="{{ old('link', $technology->link ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Sort Order
        <input type="number" name="sort_order" value="{{ old('sort_order', $technology->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="inline-flex items-center gap-2 text-sm mt-6">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $technology->is_active ?? true)) class="rounded border-gray-300 text-emerald-600"> Active
    </label>
</div>

