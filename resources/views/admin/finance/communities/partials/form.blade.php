@php($community = $community ?? null)
<label class="block text-sm">Segment Name
    <input name="segment_name" value="{{ old('segment_name', $community->segment_name ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Needs (one per line)
    <textarea name="needs" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('needs', isset($community->needs) ? implode("\n", (array)$community->needs) : '') }}</textarea>
</label>
<label class="block text-sm">Value Props (one per line)
    <textarea name="value_props" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('value_props', isset($community->value_props) ? implode("\n", (array)$community->value_props) : '') }}</textarea>
</label>
<label class="block text-sm">Case Links (one per line)
    <textarea name="case_links" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('case_links', isset($community->case_links) ? implode("\n", (array)$community->case_links) : '') }}</textarea>
</label>
<div class="grid gap-4 sm:grid-cols-2">
    <label class="block text-sm">Sort Order
        <input type="number" name="sort_order" value="{{ old('sort_order', $community->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="inline-flex items-center gap-2 text-sm mt-6">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $community->is_active ?? true)) class="rounded border-gray-300 text-emerald-600"> Active
    </label>
</div>
@push('scripts')
<script>
(function(){
  const form = document.currentScript.closest('form');
  form.addEventListener('submit', function(){
    [['needs','needs[]'],['value_props','value_props[]'],['case_links','case_links[]']].forEach(([taName, inputName])=>{
      const ta = form.querySelector(`textarea[name="${taName}"]`);
      if (!ta) return; ta.value.split('\n').map(s=>s.trim()).filter(Boolean).forEach(val=>{
        const i=document.createElement('input'); i.type='hidden'; i.name=inputName; i.value=val; form.appendChild(i);
      });
    });
  });
})();
</script>
@endpush

