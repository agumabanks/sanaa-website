<x-admin-dashboard-layout title="Create Component">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-gray-400">Content /</span>
            <span>New Component</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto pb-20">
        <div class="content-card overflow-hidden">
            <div class="p-8 bg-gray-50/50 border-b border-gray-100">
                <h1 class="text-xl font-bold text-gray-900">Add Structural Layer</h1>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-semibold">Define the purpose and type of this new interface element.</p>
            </div>

            <form action="{{ route('admin.landing-sections.store') }}" method="POST">
                @csrf

                <div class="p-8 space-y-8">
                    <div class="space-y-6">
                        <div class="relative">
                            <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase tracking-tighter">Internal Identifier</span>
                            <input type="text" name="name" class="form-input pt-4" placeholder="e.g. Hero Section, Our Mission" required>
                        </div>

                        <div class="relative">
                            <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase tracking-tighter">Component Template</span>
                            <select name="section_type" class="form-input pt-4 appearance-none" required>
                                <option value="">Select a template...</option>
                                <option value="hero">Aspirational Hero (Video + Dual CTA)</option>
                                <option value="mission">Mission Statement (Minimalist Narratvie)</option>
                                <option value="offerings">Solutions Grid (Categorized Services)</option>
                                <option value="team">Executive Team (High-res Portraits)</option>
                                <option value="products">Digital Products (Soko Integration)</option>
                                <option value="industries">Industry Solutions (Vertical Specifics)</option>
                                <option value="capabilities">Platform Capabilities (Technical Specs)</option>
                                <option value="pricing">Tiered Pricing (Subscription Plans)</option>
                                <option value="blog">Editorial Layer (Latest Insights)</option>
                                <option value="join">Conversion Closer (High-Impact CTA)</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400 pt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="relative">
                                <span class="absolute -top-2 left-3 bg-white px-2 text-[9px] font-bold text-gray-400 z-10 uppercase tracking-tighter">Initial Sequence</span>
                                <input type="number" name="sort_order" value="100" class="form-input pt-4">
                            </div>
                            <div class="flex items-center pt-2">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                                        <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 transition-colors"></div>
                                        <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors">Active on Spawn</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-8 border-t border-gray-100">
                        <a href="{{ route('admin.landing-sections.index') }}" class="btn-secondary">Cancel</a>
                        <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-black transition-all transform active:scale-[0.98]">
                            Initialize Component
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
        }
    </style>
</x-admin-dashboard-layout>
