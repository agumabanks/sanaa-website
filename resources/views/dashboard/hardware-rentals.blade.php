<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hardware Rentals
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Add Hardware Rental</h3>
                <form method="POST" action="{{ route('dashboard.hardware-rental.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="hardware-name" value="Name" />
                        <x-input id="hardware-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="hardware-description" value="Description" />
                        <textarea id="hardware-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
