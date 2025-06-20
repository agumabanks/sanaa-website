<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Policies
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Edit Terms &amp; Conditions</h3>
                <form method="POST" action="{{ route('dashboard.policy.update', ['key' => 'terms']) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea id="terms-content" name="content" class="w-full rounded" rows="5">{{ $terms->content ?? '' }}</textarea>
                    </div>
                    <x-button>Save</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Edit Seller Policies</h3>
                <form method="POST" action="{{ route('dashboard.policy.update', ['key' => 'seller-policies']) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea id="seller-content" name="content" class="w-full rounded" rows="5">{{ $seller->content ?? '' }}</textarea>
                    </div>
                    <x-button>Save</x-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
