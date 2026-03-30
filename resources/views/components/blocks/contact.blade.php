@props(['data' => []])

@php
    $title = $data['title'] ?? 'Get in Touch';
    $description = $data['description'] ?? '';
@endphp

<section class="py-16 md:py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
            @if($description)
                <p class="text-lg text-gray-600">{{ $description }}</p>
            @endif
        </div>

        <form action="{{ route('contact.send') }}" method="POST" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            @csrf
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Your name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="your@email.com">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                <input type="text" name="subject" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="How can we help?">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" rows="5" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Your message..."></textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-emerald-500 text-white rounded-xl font-semibold hover:bg-emerald-600 transition-colors">
                Send Message
            </button>
        </form>
    </div>
</section>
