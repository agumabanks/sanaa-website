<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Domain Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-medium text-gray-900 dark:text-white">
                                Manage Domain Configurations
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Configure external domain URLs used throughout the application.
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" onclick="bulkUpdateDomains()"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Bulk Update
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form id="bulk-update-form" method="POST" action="{{ route('dashboard.domains.bulk-update') }}" class="hidden">
                        @csrf
                        <div id="bulk-domains-data"></div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Key
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Domain
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Last Updated
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($domains as $domain)
                                    <tr class="domain-row" data-key="{{ $domain->key }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $domain->key }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            <input type="text"
                                                   value="{{ $domain->domain }}"
                                                   class="domain-input w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                                   data-original="{{ $domain->domain }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                       {{ $domain->is_active ? 'checked' : '' }}
                                                       class="active-checkbox rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700">
                                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                                    {{ $domain->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $domain->updated_at->format('M j, Y g:i A') }}
                                            @if($domain->last_updated_by)
                                                <br>
                                                <span class="text-xs text-gray-400">
                                                    by {{ $domain->updater->name ?? 'Unknown' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('dashboard.domains.edit', $domain) }}"
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Domain Configuration Info</h4>
                        <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                            <li><strong>soko_domain:</strong> Used for Soko e-commerce API calls and product links</li>
                            <li><strong>media_domain:</strong> Used for media assets and file hosting</li>
                            <li><strong>status_domain:</strong> Used for system status page links</li>
                            <li><strong>finance_domain:</strong> Used for Sanaa Finance related links</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bulkUpdateDomains() {
            const rows = document.querySelectorAll('.domain-row');
            const domainsData = [];

            rows.forEach(row => {
                const key = row.dataset.key;
                const domainInput = row.querySelector('.domain-input');
                const activeCheckbox = row.querySelector('.active-checkbox');

                domainsData.push({
                    key: key,
                    domain: domainInput.value,
                    is_active: activeCheckbox.checked
                });
            });

            // Populate hidden form
            const form = document.getElementById('bulk-update-form');
            const dataDiv = document.getElementById('bulk-domains-data');

            dataDiv.innerHTML = '';
            domainsData.forEach(domain => {
                dataDiv.innerHTML += `
                    <input type="hidden" name="domains[${domain.key}][key]" value="${domain.key}">
                    <input type="hidden" name="domains[${domain.key}][domain]" value="${domain.domain}">
                    <input type="hidden" name="domains[${domain.key}][is_active]" value="${domain.is_active ? '1' : '0'}">
                `;
            });

            if (confirm('Are you sure you want to update all domain settings? This will affect live functionality.')) {
                form.submit();
            }
        }

        // Auto-update status text when checkbox changes
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.active-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const span = this.parentElement.querySelector('span');
                    span.textContent = this.checked ? 'Active' : 'Inactive';
                });
            });
        });
    </script>
</x-app-layout>