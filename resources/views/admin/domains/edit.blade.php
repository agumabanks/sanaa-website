<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Domain Setting') }}
            </h2>
            <a href="{{ route('dashboard.domains.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to Domains
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('dashboard.domains.update', $domain) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Domain Configuration: {{ $domain->key }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Configure the domain URL for {{ $domain->key }}.
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Domain Key (Read-only) -->
                        <div class="mb-4">
                            <x-input-label for="key" :value="__('Domain Key')" />
                            <x-text-input id="key"
                                          name="key"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="$domain->key"
                                          readonly
                                          style="background-color: #f3f4f6; cursor: not-allowed;" />
                            <p class="mt-1 text-sm text-gray-500">
                                This key cannot be changed as it identifies the domain type.
                            </p>
                        </div>

                        <!-- Domain URL -->
                        <div class="mb-4">
                            <x-input-label for="domain" :value="__('Domain URL')" />
                            <x-text-input id="domain"
                                          name="domain"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('domain', $domain->domain)"
                                          placeholder="e.g., soko.sanaa.ug"
                                          required />
                            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500">
                                Enter the full domain name (e.g., example.com). Do not include http:// or https://.
                            </p>
                        </div>

                        <!-- Active Status -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <x-checkbox id="is_active"
                                           name="is_active"
                                           :checked="old('is_active', $domain->is_active)" />
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Active') }}
                                </span>
                            </label>
                            <p class="mt-1 text-sm text-gray-500">
                                When inactive, the system will use fallback values or default domains.
                            </p>
                        </div>

                        <!-- Domain Info -->
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">
                                Domain Information
                            </h4>
                            <div class="text-sm text-blue-700 dark:text-blue-300">
                                @switch($domain->key)
                                    @case('soko_domain')
                                        <p><strong>Soko Domain:</strong> Used for e-commerce API calls, product links, and shopping functionality.</p>
                                        @break
                                    @case('media_domain')
                                        <p><strong>Media Domain:</strong> Used for hosting images, videos, and other media assets.</p>
                                        @break
                                    @case('status_domain')
                                        <p><strong>Status Domain:</strong> Used for system status pages and monitoring links.</p>
                                        @break
                                    @case('finance_domain')
                                        <p><strong>Finance Domain:</strong> Used for Sanaa Finance related links and services.</p>
                                        @break
                                    @default
                                        <p><strong>Custom Domain:</strong> Configurable domain for specific application features.</p>
                                @endswitch
                            </div>
                        </div>

                        <!-- Last Updated Info -->
                        @if($domain->last_updated_by)
                            <div class="mb-6 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <strong>Last Updated:</strong> {{ $domain->updated_at->format('M j, Y \a\t g:i A') }}
                                    @if($domain->updater)
                                        by {{ $domain->updater->name }}
                                    @endif
                                </p>
                            </div>
                        @endif

                        <div class="flex items-center justify-end">
                            <a href="{{ route('dashboard.domains.index') }}"
                               class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>

                            <x-primary-button>
                                {{ __('Update Domain') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
