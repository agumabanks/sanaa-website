@extends('layouts.landing')

@section('title', 'Investor Relations | ' . config('app.name'))

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Investor Relations</h1>

        <p class="mb-6 text-lg text-gray-700">Sanaa integrates media, payments and commerce into a single platform that empowers African businesses. By combining content creation tools, seamless digital payments and an e‑commerce marketplace, we enable entrepreneurs to reach customers, accept payments and fulfil orders across the continent.</p>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Key Metrics</h2>
            <ul class="list-disc ml-6 space-y-2 text-gray-700">
                <li><strong>50k+</strong> active users across our platform</li>
                <li><strong>US$4.2m</strong> annual transaction volume</li>
                <li><strong>150%+</strong> year-over-year revenue growth</li>
            </ul>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Fundraising</h2>
            <p class="text-gray-700">We are raising capital to scale our payment and commerce infrastructure across East Africa. Investors can reach us at <a href="mailto:invest@sanaa.co" class="text-green-600 underline">invest@sanaa.co</a>.</p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Testimonials</h2>
            <blockquote class="border-l-4 border-green-600 pl-4 italic text-gray-800 mb-4">
                "Sanaa’s tools allowed us to launch an online store and start accepting payments in less than a week." – A satisfied merchant
            </blockquote>
            <blockquote class="border-l-4 border-green-600 pl-4 italic text-gray-800">
                "Partnering with Sanaa has streamlined our media distribution and boosted sales across the region." – Media partner
            </blockquote>
        </div>
    </div>
</section>
@endsection

