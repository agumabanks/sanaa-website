<x-dashboard-layout title="Categories">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Create Business Category</h3>
                <form method="POST" action="{{ route('dashboard.category.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="name" value="Name" />
                        <x-input id="name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="description" value="Description" />
                        <textarea id="description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
