<x-admin-dashboard-layout title="Edit Component: {{ $section->name }}">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-gray-400">Content /</span>
            <span>{{ $section->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto pb-20" x-data="editor('{{ $section->section_type }}')">
        <form action="{{ route('admin.landing-sections.update', $section) }}" method="POST" id="edit-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Master Controls -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="content-card p-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6 underline decoration-emerald-500/30 decoration-2 underline-offset-4">Identity & Logic</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">Administrative Name</label>
                                <input type="text" name="name" value="{{ old('name', $section->name) }}" class="form-input" required>
                            </div>
                            
                            <div>
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">Structural Type</label>
                                <div class="bg-gray-50 border border-gray-100 rounded-lg px-3 py-2 text-sm text-gray-600 font-mono">
                                    {{ $section->section_type }}
                                </div>
                                <input type="hidden" name="section_type" value="{{ $section->section_type }}">
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 transition-colors"></div>
                                        <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors">Visible to Public</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="content-card p-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">Workflow</h3>
                        <div class="space-y-3">
                            <button type="submit" class="w-full bg-gray-900 text-white rounded-xl py-3 font-bold text-sm hover:bg-black transition-all transform active:scale-[0.98]">
                                Commit Changes
                            </button>
                            <a href="{{ route('admin.landing-sections.index') }}" class="w-full block text-center py-3 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
                                Discard & Exit
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Multilingual Content Layer -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="content-card min-h-[400px]">
                        <div class="flex border-b border-gray-100">
                            <button type="button" @click="tab = 'en'" :class="tab === 'en' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-400 hover:text-gray-600'" class="px-8 py-5 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">English</button>
                            <button type="button" @click="tab = 'fr'" :class="tab === 'fr' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-400 hover:text-gray-600'" class="px-8 py-5 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">French</button>
                            <button type="button" @click="tab = 'sw'" :class="tab === 'sw' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-400 hover:text-gray-600'" class="px-8 py-5 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">Swahili</button>
                        </div>

                        <div class="p-8">
                            @foreach(['en', 'fr', 'sw'] as $locale)
                                <div x-show="tab === '{{ $locale }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                                    @php $content = data_get($section->content, $locale, []); @endphp

                                    @if($section->section_type === 'hero')
                                        <div class="field-group">
                                            <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] block mb-3">Impact Message (Hero)</label>
                                            <div class="space-y-6">
                                                <div class="relative">
                                                    <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10">EYEBROW</span>
                                                    <input type="text" name="content[{{ $locale }}][eyebrow]" value="{{ data_get($content, 'eyebrow') }}" class="form-input pt-4 pb-3">
                                                </div>
                                                <div class="relative">
                                                    <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10">HEADLINE (HTML ALLOWED)</span>
                                                    <textarea name="content[{{ $locale }}][title]" class="form-input pt-4 pb-3 font-mono text-sm" rows="3">{{ data_get($content, 'title') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="field-group">
                                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] block mb-3">Action Buttons</label>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 space-y-3">
                                                    <p class="text-[9px] font-bold text-emerald-600">PRIMARY CTA</p>
                                                    <input type="text" name="content[{{ $locale }}][buttons][0][text]" placeholder="Label" value="{{ data_get($content, 'buttons.0.text') }}" class="form-input bg-white text-xs">
                                                    <input type="text" name="content[{{ $locale }}][buttons][0][link]" placeholder="URL / #Anchor" value="{{ data_get($content, 'buttons.0.link') }}" class="form-input bg-white text-xs">
                                                    <input type="hidden" name="content[{{ $locale }}][buttons][0][class]" value="btn-cta">
                                                </div>
                                                <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 space-y-3">
                                                    <p class="text-[9px] font-bold text-gray-500">SECONDARY CTA</p>
                                                    <input type="text" name="content[{{ $locale }}][buttons][1][text]" placeholder="Label" value="{{ data_get($content, 'buttons.1.text') }}" class="form-input bg-white text-xs">
                                                    <input type="text" name="content[{{ $locale }}][buttons][1][link]" placeholder="URL / #Anchor" value="{{ data_get($content, 'buttons.1.link') }}" class="form-input bg-white text-xs">
                                                    <input type="hidden" name="content[{{ $locale }}][buttons][1][class]" value="btn-cta-outline">
                                                </div>
                                            </div>
                                        </div>

                                    @elseif($section->section_type === 'mission')
                                        <div class="field-group space-y-6">
                                            <div class="relative">
                                                <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Narrative Subtitle</span>
                                                <textarea name="content[{{ $locale }}][subtitle]" class="form-input pt-4 pb-3" rows="3">{{ data_get($content, 'subtitle') }}</textarea>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="relative">
                                                    <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Insight Badge</span>
                                                    <input type="text" name="content[{{ $locale }}][insight_eyebrow]" value="{{ data_get($content, 'insight_eyebrow') }}" class="form-input pt-4">
                                                </div>
                                                <div class="relative">
                                                    <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Insight Content</span>
                                                    <input type="text" name="content[{{ $locale }}][insight_content]" value="{{ data_get($content, 'insight_content') }}" class="form-input pt-4">
                                                </div>
                                            </div>
                                        </div>

                                    @else
                                        <!-- Fallback Dynamic Editor -->
                                        <div class="bg-emerald-50/30 border border-emerald-100/50 p-6 rounded-2xl mb-6">
                                            <p class="text-xs text-emerald-700 font-medium">Standard structural fields for <span class="uppercase font-bold">{{ $section->section_type }}</span></p>
                                        </div>

                                        <div class="space-y-6">
                                            <div class="relative">
                                                <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Section Title</span>
                                                <input type="text" name="content[{{ $locale }}][title]" value="{{ data_get($content, 'title') }}" class="form-input pt-4">
                                            </div>
                                            <div class="relative">
                                                <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Secondary Narrative / Subtitle</span>
                                                <textarea name="content[{{ $locale }}][eyebrow]" class="form-input pt-4" rows="2">{{ data_get($content, 'eyebrow') ?? data_get($content, 'subtitle') }}</textarea>
                                            </div>
                                            
                                            @if($section->section_type === 'offerings')
                                                <div class="relative">
                                                    <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase">Navigation Label (View All)</span>
                                                    <input type="text" name="content[{{ $locale }}][view_all_text]" value="{{ data_get($content, 'view_all_text') }}" class="form-input pt-4">
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between px-4">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Autosave is active in memory</p>
                        <div class="flex gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[10px] items-center flex font-bold text-gray-500 uppercase">System Ready</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function editor(type) {
            return {
                tab: 'en',
                type: type,
                
                init() {
                    console.log('Premium Editor Initialized for:', this.type);
                }
            }
        }
    </script>
    <style>
        .form-input {
            width: 100%;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px;
            font-size: 14px;
            color: #1d1d1f;
            padding: 0.75rem 1rem;
            outline: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            background: #fff;
        }
        .field-group {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.04);
            padding: 1.5rem;
            border-radius: 20px;
        }
    </style>
    @endpush
</x-admin-dashboard-layout>
