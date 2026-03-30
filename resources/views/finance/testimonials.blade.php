@extends('layouts.finance', [
    'title' => 'Testimonials — Sanaa Finance',
    'metaDescription' => 'See how Ugandan businesses are growing with Sanaa Finance. Real stories from SMEs, SACCOs, schools, and Soko24 sellers.',
    'breadcrumbs' => [['name'=>'Testimonials']]
])
@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-emerald-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Trusted by Ugandan Businesses</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Real stories from SMEs, SACCOs, schools, and entrepreneurs who have transformed their finances with Sanaa.</p>
    </div>
</section>

{{-- Testimonials Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        {{-- SACCO Testimonial --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "Sanaa Finance has changed how we manage our SACCO. Member contributions via Mobile Money are automatic, loan recovery is easier to track, and the URBRA reports remove a large amount of manual work every quarter."
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">JN</div>
                <div>
                    <p class="font-semibold text-gray-900">Joseph Nakamya</p>
                    <p class="text-sm text-gray-500">Manager, Kampala Teachers SACCO</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">SACCO</span>
                </div>
            </div>
        </div>

        {{-- Soko24 Seller --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "As a Soko24 seller, faster payouts mean I can restock quickly. The working capital facility helped me expand my product range and keep moving without long delays."
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-emerald-600 flex items-center justify-center text-white font-semibold">SA</div>
                <div>
                    <p class="font-semibold text-gray-900">Sarah Auma</p>
                    <p class="text-sm text-gray-500">Owner, Auma Electronics</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">Soko24 Seller</span>
                </div>
            </div>
        </div>

        {{-- School --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "School fee collection used to be a nightmare with long queues and cash handling. Now parents pay via MTN MoMo and Airtel Money directly. Automatic SMS receipts, no queues - parents love it!"
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-orange-600 flex items-center justify-center text-white font-semibold">PO</div>
                <div>
                    <p class="font-semibold text-gray-900">Peter Okello</p>
                    <p class="text-sm text-gray-500">Bursar, St. Mary's Secondary School, Jinja</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">School</span>
                </div>
            </div>
        </div>

        {{-- SME Retail --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "Managing cash from my hardware shop was always stressful. With Sanaa Finance, customers pay directly to my account via Mobile Money. I can see my real-time balance and pay suppliers instantly."
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-purple-600 flex items-center justify-center text-white font-semibold">MK</div>
                <div>
                    <p class="font-semibold text-gray-900">Moses Kato</p>
                    <p class="text-sm text-gray-500">Owner, Kato Hardware, Mbarara</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">SME</span>
                </div>
            </div>
        </div>

        {{-- Investment Club --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "Our investment club struggled with contribution tracking and fair profit distribution. Sanaa Finance automated the process. Now we vote on investments through the app and dividends are calculated automatically."
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-teal-600 flex items-center justify-center text-white font-semibold">GN</div>
                <div>
                    <p class="font-semibold text-gray-900">Grace Namubiru</p>
                    <p class="text-sm text-gray-500">Chairperson, Entebbe Women Investors</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-teal-100 text-teal-700 px-2 py-0.5 rounded-full">Investment Club</span>
                </div>
            </div>
        </div>

        {{-- Solo Entrepreneur --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-1 mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <blockquote class="text-gray-700 mb-6">
                "As a freelance graphic designer, I needed a professional way to invoice clients and separate business from personal. The free Sanaa account and invoice generator are exactly what I needed. I even qualified for a small loan to buy a new laptop!"
            </blockquote>
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-pink-600 flex items-center justify-center text-white font-semibold">RO</div>
                <div>
                    <p class="font-semibold text-gray-900">Ronald Opio</p>
                    <p class="text-sm text-gray-500">Freelance Designer, Kampala</p>
                    <span class="inline-flex items-center mt-1 text-xs bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full">Solo Entrepreneur</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Stats --}}
<section class="bg-emerald-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-2xl font-bold text-white">SACCO operations</p>
                <p class="mt-1 text-emerald-100">Member records, loans, and reporting in one place</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-white">Seller visibility</p>
                <p class="mt-1 text-emerald-100">Collections, payouts, and financing history tracked clearly</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-white">School collections</p>
                <p class="mt-1 text-emerald-100">Fee payments and receipts reconciled without manual chasing</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-white">Business groups</p>
                <p class="mt-1 text-emerald-100">Savings, lending, and contribution workflows kept in one system</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to join them?</h2>
        <p class="text-lg text-gray-600 mb-8">Start your success story with Sanaa Finance today.</p>
        <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 text-white px-8 py-3 text-base font-semibold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
            Get Started Free
        </a>
    </div>
</section>
@endsection
