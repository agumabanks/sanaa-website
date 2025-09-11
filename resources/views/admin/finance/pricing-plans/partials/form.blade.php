@php($plan = $plan ?? null)
<div class="grid gap-4 sm:grid-cols-2">
    <label class="block text-sm">Name
        <input required name="name" value="{{ old('name', $plan->name ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Badge
        <input name="badge" value="{{ old('badge', $plan->badge ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
</div>
<label class="block text-sm">Summary
    <textarea name="summary" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('summary', $plan->summary ?? '') }}</textarea>
</label>
<div class="grid gap-4 sm:grid-cols-2">
    <label class="block text-sm">Monthly Price
        <input type="number" step="0.01" name="monthly_price" value="{{ old('monthly_price', $plan->monthly_price ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Annual Price
        <input type="number" step="0.01" name="annual_price" value="{{ old('annual_price', $plan->annual_price ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
</div>
<label class="block text-sm">Features (one per line)
    <textarea name="features" class="mt-1 w-full rounded border-gray-300" rows="4">{{ old('features', isset($plan->features) ? implode("\n", (array)$plan->features) : '') }}</textarea>
</label>
<label class="block text-sm">Limits (one per line)
    <textarea name="limits" class="mt-1 w-full rounded border-gray-300" rows="3">{{ old('limits', isset($plan->limits) ? implode("\n", (array)$plan->limits) : '') }}</textarea>
</label>
<div class="grid gap-4 sm:grid-cols-3">
    <label class="block text-sm">CTA Link
        <input name="cta_link" value="{{ old('cta_link', $plan->cta_link ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Sort Order
        <input type="number" name="sort_order" value="{{ old('sort_order', $plan->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="inline-flex items-center gap-2 text-sm mt-6">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $plan->is_active ?? true)) class="rounded border-gray-300 text-emerald-600"> Active
    </label>
</div>
@push('scripts')
<script>
// Turn textarea lines into features[]/limits[] before submit
(function(){
  const form = document.currentScript.closest('form');
  form.addEventListener('submit', function(){
    const featuresTA = this.querySelector('textarea[name="features"]');
    const limitsTA = this.querySelector('textarea[name="limits"]');
    if (featuresTA) {
      const lines = featuresTA.value.split('\n').map(s=>s.trim()).filter(Boolean);
      lines.forEach(val => { const i=document.createElement('input'); i.type='hidden'; i.name='features[]'; i.value=val; form.appendChild(i); });
    }
    if (limitsTA) {
      const lines = limitsTA.value.split('\n').map(s=>s.trim()).filter(Boolean);
      lines.forEach(val => { const i=document.createElement('input'); i.type='hidden'; i.name='limits[]'; i.value=val; form.appendChild(i); });
    }
  });
})();
</script>
@endpush
