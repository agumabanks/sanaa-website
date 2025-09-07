<x-dashboard-layout title="My Purchases">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">My Purchases</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Purchase History</h3>
                <p class="text-gray-600">Your purchase history and order details will be displayed here.</p>
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">No purchases found. Your order history will appear here once you make a purchase.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>