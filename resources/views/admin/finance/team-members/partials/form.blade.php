@php($member = $member ?? null)
<label class="block text-sm">Name
    <input name="name" value="{{ old('name', $member->name ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Role
    <input name="role" value="{{ old('role', $member->role ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Headshot
    <input type="file" name="headshot" accept="image/*" class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Bio
    <textarea name="bio" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('bio', $member->bio ?? '') }}</textarea>
</label>
<label class="block text-sm">Socials (handle: url per line)
    <textarea name="socials" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('socials') }}</textarea>
</label>
<div class="grid gap-4 sm:grid-cols-2">
    <label class="block text-sm">Sort Order
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="inline-flex items-center gap-2 text-sm mt-6">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $member->is_active ?? true)) class="rounded border-gray-300 text-emerald-600"> Active
    </label>
</div>
@push('scripts')
<script>
(function(){
  const form = document.currentScript.closest('form');
  form.addEventListener('submit', function(){
    const ta = form.querySelector('textarea[name="socials"]');
    if (!ta) return;
    ta.value.split('\n').map(s=>s.trim()).filter(Boolean).forEach(line => {
      const [k, ...rest] = line.split(':'); if(!k) return; const v = rest.join(':').trim();
      const i = document.createElement('input'); i.type='hidden'; i.name=`socials[${k.trim()}]`; i.value=v; form.appendChild(i);
    });
  });
})();
</script>
@endpush
