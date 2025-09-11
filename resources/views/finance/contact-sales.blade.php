@extends('layouts.finance', [
    'title' => 'Contact Sales — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Contact Sales'] ],
])
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Let’s Discuss</h1>
    @if(session('success'))
        <div class="mb-4 rounded-md bg-emerald-50 text-emerald-800 p-3">{{ session('success') }}</div>
    @endif
    <form action="{{ route('finance.contact-sales.submit') }}" method="post" enctype="multipart/form-data" class="space-y-4" novalidate>
        @csrf
        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block text-sm">Full name
                <input required name="full_name" value="{{ old('full_name') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
            </label>
            <label class="block text-sm">Email
                <input required type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
            </label>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block text-sm">Phone (optional)
                <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
            </label>
            <label class="block text-sm">Organization
                <input required name="organization" value="{{ old('organization') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
            </label>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block text-sm">Country
                <input required name="country" value="{{ old('country') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
            </label>
            <label class="block text-sm">Segment
                <select required name="segment" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">
                    @foreach(['SACCO','Microfinance','MFI','Bank','Money Lender','SME','Gov/NGO','EdTech','Other'] as $s)
                        <option value="{{ $s }}" @selected(old('segment')===$s)>{{ $s }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block text-sm">Monthly Volume
                <input name="monthly_volume" value="{{ old('monthly_volume') }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600" placeholder="e.g. 5,000 txns / $100k">
            </label>
            <label class="block text-sm">RFP / PDF (optional)
                <input type="file" name="file_upload" accept="application/pdf" class="mt-1 w-full rounded-md border-gray-300 file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700">
            </label>
        </div>
        <label class="block text-sm">Message
            <textarea name="message" rows="5" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600">{{ old('message') }}</textarea>
        </label>
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" name="book_demo" value="1" @checked(old('book_demo')) class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-600"> Book a demo
        </label>
        <label class="inline-flex items-center gap-2 text-sm">
            <input required type="checkbox" name="consent" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-600"> I consent to be contacted.
        </label>
        <div>
            <button class="inline-flex rounded-md bg-emerald-600 text-white px-4 py-2 text-sm font-medium hover:bg-emerald-700">Send</button>
        </div>
        @if($errors->any())
            <div class="text-sm text-red-700">{{ $errors->first() }}</div>
        @endif
    </form>
</section>
@endsection

