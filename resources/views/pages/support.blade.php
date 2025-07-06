@extends('layouts.landing')

@section('title', 'Support | ' . config('app.name'))

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <h1 class="text-2xl font-bold">Support</h1>
            <p class="text-gray-600">Need help? Send us a message below.</p>

            @if(session('status'))
                <div class="p-4 bg-green-100 text-green-700 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('support.send') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input id="phone" name="phone" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input id="address" name="address" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="product" class="block text-sm font-medium text-gray-700">Product</label>
                    <input id="product" name="product" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Send</button>
                </div>
            </form>
        </div>
    </section>
@endsection
