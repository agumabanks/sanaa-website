@php($card = $card ?? null)
<label class="block text-sm">Name
    <input name="name" value="{{ old('name', $card->name ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
    @error('name')<div class="text-red-700 text-sm">{{ $message }}</div>@enderror
</label>
<label class="block text-sm">Image
    <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Fees (key: value per line)
    <textarea name="fees" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('fees', isset($card->fees) ? collect($card->fees)->map(fn($v,$k)=>"$k: $v")->implode("\n") : '') }}</textarea>
</label>
<label class="block text-sm">Features (one per line)
    <textarea name="features" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('features', isset($card->features) ? implode("\n", (array)$card->features) : '') }}</textarea>
</label>
<label class="block text-sm">Eligibility
    <textarea name="eligibility" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('eligibility', $card->eligibility ?? '') }}</textarea>
</label>
<label class="block text-sm">FAQ (Q: A per line)
    <textarea name="faq" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('faq') }}</textarea>
</label>
<label class="block text-sm">T&Cs (PDF)
    <input type="file" name="tnc_file" accept="application/pdf" class="mt-1 w-full rounded border-gray-300">
</label>
<label class="block text-sm">Status
    <select name="status" class="mt-1 w-full rounded border-gray-300">
        @foreach(['draft','published'] as $s)
            <option value="{{ $s }}" @selected(old('status', $card->status ?? 'draft')==$s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
</label>
@push('scripts')
<script>
(function(){
  const form = document.currentScript.closest('form');
  form.addEventListener('submit', function(){
    function linesToArray(selector, name){
      const ta = form.querySelector(selector); if(!ta) return;
      const lines = ta.value.split('\n').map(s=>s.trim()).filter(Boolean);
      lines.forEach(val => { const i=document.createElement('input'); i.type='hidden'; i.name=name; i.value=val; form.appendChild(i); });
    }
    // features[]
    linesToArray('textarea[name="features"]', 'features[]');
    // faq[] as objects not supported; keep textarea for now
    // fees: parse key: value into JSON pairs for server; use hidden inputs fees[key]
    const feesTA = form.querySelector('textarea[name="fees"]');
    if (feesTA) {
      feesTA.value.split('\n').map(s=>s.trim()).filter(Boolean).forEach(line => {
        const [k, ...rest] = line.split(':');
        if (!k) return; const v = rest.join(':').trim();
        const i = document.createElement('input'); i.type='hidden'; i.name=`fees[${k.trim()}]`; i.value=v; form.appendChild(i);
      });
    }
  });
})();
</script>
@endpush

