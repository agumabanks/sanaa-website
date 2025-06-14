@extends('layouts.landing')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold">Contact Us</h1>
                <p class="mt-2 text-gray-600">Questions or feedback? Send us a message and we'll get back to you.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">Get in touch</h2>
                    <p>Reach out any time at <a href="mailto:info@sanaa.co" class="text-green-600 underline">info@sanaa.co</a>.</p>
                    <ul class="space-y-2 text-gray-700">
                        <li><span class="font-semibold">Customer Support:</span> 0706 27-2481</li>
                        <li><span class="font-semibold">Sales:</span> 0200 90-3222</li>
                        <li><span class="font-semibold">Address:</span> Kampala, Uganda</li>
                    </ul>
                </div>

                <div>
                    @if(session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Send</button>
                        </div>
                    </form>
                </div>
            </div>

            @auth
                @if($items->count())
                    <div class="pt-8">
                        <h2 class="text-xl font-semibold mb-4">Recent Messages</h2>
                        <ul class="space-y-2">
                            @foreach($items as $msg)
                                <li class="border-b pb-2">
                                    <p class="font-semibold">{{ $msg->name }} ({{ $msg->email }})</p>
                                    <p class="text-gray-600">{{ $msg->message }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endauth
        </div>
    </section>
@endsection
