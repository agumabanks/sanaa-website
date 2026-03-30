<x-admin-dashboard-layout title="Landing Page Builder">
    <x-slot name="header">Landing Page Builder</x-slot>

    <div class="space-y-6 max-w-5xl mx-auto" x-data="sectionManager()">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Interface Architecture</h1>
                <p class="text-sm text-gray-500">Design and sequence the structural layers of your brand experience.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/') }}" target="_blank" class="btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Preview Site
                </a>
                <a href="{{ route('admin.landing-sections.create') }}" class="btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Component
                </a>
            </div>
        </div>

        <!-- Strategic Lead Advisory (Premium Square-style note) -->
        <div class="bg-gray-900 rounded-2xl p-6 text-white overflow-hidden relative group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 blur-[100px] -mr-32 -mt-32 transition-all group-hover:bg-emerald-500/20"></div>
            <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start md:items-center">
                <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center shrink-0 shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-500 mb-1">Lead Strategy Update</h2>
                    <p class="text-gray-300 text-sm leading-relaxed max-w-2xl">
                        I've refactored the platform navigation to mirror <strong>Square's</strong> multi-channel hierarchy. Focus sections on <strong>Software</strong>, <strong>Hardware</strong>, and <strong>Banking</strong> to maximize trust and conversion. Ensure the <strong>Join/CTA</strong> section is always at the base to close the deal.
                    </p>
                </div>
                <div class="flex gap-2">
                    <div class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-[10px] font-bold text-gray-400">v4.0.2</div>
                    <div class="px-3 py-1 bg-emerald-500 text-black rounded-full text-[10px] font-bold">STABLE</div>
                </div>
            </div>
        </div>

        <div class="content-card overflow-hidden">
            <div class="divide-y divide-gray-100 bg-white" id="sections-list">
                @foreach($sections as $section)
                    <div class="group flex items-center p-4 hover:bg-gray-50 transition-all duration-200 section-item" 
                         data-id="{{ $section->id }}"
                         :class="{ 'opacity-50 grayscale': !{{ $section->is_active ? 'true' : 'false' }} }">
                        
                        <div class="drag-handle cursor-grab active:cursor-grabbing p-2 text-gray-300 hover:text-gray-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 12h16M4 16h16"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1 px-4">
                            <div class="flex items-center gap-3">
                                <span class="font-medium text-gray-900">{{ $section->name }}</span>
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 border border-gray-200 px-1.5 py-0.5 rounded uppercase leading-none">{{ $section->section_type }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">Order: {{ $section->sort_order }}</p>
                        </div>

                        <div class="flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="toggleStatus({{ $section->id }})" 
                                    class="p-2 rounded-lg hover:bg-white hover:shadow-sm text-gray-400 hover:text-gray-600 transition-all"
                                    :title="{{ $section->is_active ? "'Deactivate'" : "'Activate'" }}">
                                <template x-if="{{ $section->is_active ? 'true' : 'false' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </template>
                                <template x-if="!{{ $section->is_active ? 'true' : 'false' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </template>
                            </button>

                            <a href="{{ route('admin.landing-sections.edit', $section) }}" 
                               class="p-2 rounded-lg hover:bg-white hover:shadow-sm text-gray-400 hover:text-blue-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>

                            <button @click="deleteSection({{ $section->id }})"
                                    class="p-2 rounded-lg hover:bg-white hover:shadow-sm text-gray-400 hover:text-red-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Feedback Toast -->
        <div x-show="toast.show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-5 py-3 rounded-full shadow-2xl flex items-center gap-3 z-50 text-sm font-medium"
             style="display: none;">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span x-text="toast.message"></span>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        function sectionManager() {
            return {
                toast: { show: false, message: '' },
                
                init() {
                    this.initSortable();
                },

                showToast(message) {
                    this.toast.message = message;
                    this.toast.show = true;
                    setTimeout(() => { this.toast.show = false; }, 3000);
                },

                initSortable() {
                    const el = document.getElementById('sections-list');
                    if (!el) return;

                    Sortable.create(el, {
                        handle: '.drag-handle',
                        animation: 250,
                        ghostClass: 'bg-blue-50',
                        onEnd: async () => {
                            const order = Array.from(el.querySelectorAll('.section-item')).map(item => item.dataset.id);
                            
                            try {
                                const response = await fetch('{{ route("admin.landing-sections.reorder") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ order : order })
                                });
                                
                                if (response.ok) {
                                    this.showToast('Sequence updated successfully');
                                }
                            } catch (e) {
                                console.error('Reorder failed', e);
                            }
                        }
                    });
                },

                async toggleStatus(id) {
                    try {
                        const response = await fetch(`/dashboard/landing-sections/${id}/toggle`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            this.showToast(data.message);
                            // Refresh page to sync Alpine state (or manually update state if more complex)
                            setTimeout(() => window.location.reload(), 500);
                        }
                    } catch (e) {
                        console.error('Toggle failed', e);
                    }
                },

                async deleteSection(id) {
                    if (!confirm('Are you sure? This cannot be undone.')) return;

                    try {
                        const response = await fetch(`/dashboard/landing-sections/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        if (response.ok) {
                            this.showToast('Section purged');
                            setTimeout(() => window.location.reload(), 500);
                        }
                    } catch (e) {
                        console.error('Delete failed', e);
                    }
                }
            }
        }
    </script>
    <style>
        .drag-handle { touch-action: none; }
        .section-item.sortable-ghost { opacity: 0.1; background: #3b82f6 !important; }
        .transition-colors { transition-property: background-color, border-color, color, fill, stroke; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
    </style>
    @endpush
</x-admin-dashboard-layout>
