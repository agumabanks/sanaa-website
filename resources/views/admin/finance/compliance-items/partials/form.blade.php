@php($item = $item ?? null)
<label class="block text-sm">Standard
    <input name="standard" value="{{ old('standard', $item->standard ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
</label>
<div class="grid gap-4 sm:grid-cols-2">
    <label class="block text-sm">Status
        <select name="status" class="mt-1 w-full rounded border-gray-300">
            @foreach(['pending','in-progress','achieved'] as $s)
                <option value="{{ $s }}" @selected(old('status', $item->status ?? 'pending')==$s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </label>
    <label class="block text-sm">Last Updated
        <input type="date" name="last_updated" value="{{ old('last_updated', optional($item->last_updated ?? null)->format('Y-m-d')) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Evidence File (PDF)
        <input type="file" name="evidence_file" accept="application/pdf" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Evidence Link
        <input name="evidence_link" value="{{ old('evidence_link', $item->evidence_link ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="inline-flex items-center gap-2 text-sm mt-6">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true)) class="rounded border-gray-300 text-emerald-600"> Active
    </label>
</div>

