<x-admin-dashboard-layout title="Page Builder - {{ $page->title }}">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.pages.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            Page Builder: {{ Str::limit($page->title, 30) }}
        </div>
    </x-slot>

    <div
        x-data="pageBuilder(@js($page->blocks ?? []), @js(array_keys($blockTypes)))"
        class="flex flex-col lg:flex-row gap-6 min-h-[calc(100vh-200px)]"
    >
        <!-- Left Sidebar - Block Palette -->
        <div class="w-full lg:w-64 flex-shrink-0">
            <div class="content-card p-4 sticky top-24">
                <h3 class="font-semibold text-gray-900 mb-4">Add Block</h3>
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-2">
                    @foreach($blockTypes as $type => $block)
                        <button
                            @click="addBlock('{{ $type }}')"
                            class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-emerald-500 hover:bg-emerald-50 transition-colors text-left group"
                        >
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                                <i data-lucide="{{ $block['icon'] }}" class="w-4 h-4 text-gray-500 group-hover:text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $block['name'] }}</p>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Canvas -->
        <div class="flex-1 min-w-0">
            <!-- Toolbar -->
            <div class="content-card p-4 mb-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">
                        <span x-text="blocks.length"></span> block(s)
                    </span>
                    <button
                        @click="saveBlocks"
                        :disabled="!hasChanges"
                        class="btn-primary text-sm"
                        :class="{ 'opacity-50 cursor-not-allowed': !hasChanges }"
                    >
                        <svg x-show="saving" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="saving ? 'Saving...' : 'Save Changes'"></span>
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    @if($page->status)
                        <a href="{{ route('page.show', $page) }}" target="_blank" class="btn-secondary text-sm">
                            View Page
                        </a>
                    @endif
                    <a href="{{ route('dashboard.pages.edit', $page) }}" class="btn-secondary text-sm">
                        Page Settings
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            <div x-show="successMessage" x-transition class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                <span x-text="successMessage"></span>
            </div>

            <!-- Blocks Canvas -->
            <div class="content-card min-h-[500px]">
                <template x-if="blocks.length === 0">
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No blocks yet</h3>
                        <p class="text-gray-500 mb-4">Add blocks from the palette on the left to build your page</p>
                    </div>
                </template>

                <div class="divide-y divide-gray-100">
                    <template x-for="(block, index) in blocks" :key="block.id">
                        <div
                            class="p-4 group relative hover:bg-gray-50 transition-colors"
                            :class="{ 'bg-emerald-50 border-l-4 border-emerald-500': editingBlockId === block.id }"
                        >
                            <!-- Block Header -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-medium text-gray-400 uppercase" x-text="block.type.replace('_', ' ')"></span>
                                    <span class="text-xs text-gray-300">#<span x-text="index + 1"></span></span>
                                </div>
                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="moveBlock(index, -1)" :disabled="index === 0" class="p-1.5 rounded hover:bg-gray-200 disabled:opacity-50" title="Move Up">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </button>
                                    <button @click="moveBlock(index, 1)" :disabled="index === blocks.length - 1" class="p-1.5 rounded hover:bg-gray-200 disabled:opacity-50" title="Move Down">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <button @click="editBlock(block)" class="p-1.5 rounded hover:bg-blue-100 hover:text-blue-600" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button @click="duplicateBlock(index)" class="p-1.5 rounded hover:bg-purple-100 hover:text-purple-600" title="Duplicate">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                    <button @click="deleteBlock(index)" class="p-1.5 rounded hover:bg-red-100 hover:text-red-600" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Block Preview -->
                            <div class="text-sm text-gray-600">
                                <template x-if="block.type === 'hero'">
                                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-4 rounded-lg">
                                        <p class="text-lg font-bold" x-text="block.data.title || 'Hero Title'"></p>
                                        <p class="text-sm opacity-75" x-text="block.data.subtitle || 'Subtitle text goes here'"></p>
                                    </div>
                                </template>
                                <template x-if="block.type === 'richtext'">
                                    <div class="prose prose-sm max-w-none" x-html="block.data.content || '<p>Rich text content...</p>'"></div>
                                </template>
                                <template x-if="block.type === 'cta'">
                                    <div class="bg-emerald-500 text-white p-4 rounded-lg text-center">
                                        <p class="font-semibold" x-text="block.data.title || 'Call to Action'"></p>
                                        <p class="text-sm opacity-75" x-text="block.data.description || 'Description'"></p>
                                    </div>
                                </template>
                                <template x-if="block.type === 'features'">
                                    <div class="grid grid-cols-3 gap-2">
                                        <template x-for="i in 3" :key="i">
                                            <div class="bg-gray-100 p-3 rounded-lg text-center">
                                                <div class="w-8 h-8 bg-gray-300 rounded-lg mx-auto mb-2"></div>
                                                <p class="text-xs">Feature</p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="block.type === 'image'">
                                    <div class="bg-gray-200 h-32 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </template>
                                <template x-if="block.type === 'gallery'">
                                    <div class="grid grid-cols-4 gap-2">
                                        <template x-for="i in 4" :key="i">
                                            <div class="bg-gray-200 h-16 rounded-lg"></div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="block.type === 'video'">
                                    <div class="bg-gray-900 h-32 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </template>
                                <template x-if="block.type === 'testimonials'">
                                    <div class="flex gap-2">
                                        <template x-for="i in 2" :key="i">
                                            <div class="flex-1 bg-gray-100 p-3 rounded-lg">
                                                <p class="text-xs italic">"Testimonial quote..."</p>
                                                <p class="text-xs font-semibold mt-2">- Name</p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="block.type === 'faq'">
                                    <div class="space-y-2">
                                        <template x-for="i in 2" :key="i">
                                            <div class="bg-gray-100 p-3 rounded-lg">
                                                <p class="text-xs font-semibold">Question?</p>
                                                <p class="text-xs text-gray-500">Answer...</p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="block.type === 'contact'">
                                    <div class="bg-gray-100 p-4 rounded-lg">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="h-8 bg-gray-200 rounded"></div>
                                            <div class="h-8 bg-gray-200 rounded"></div>
                                            <div class="col-span-2 h-16 bg-gray-200 rounded"></div>
                                            <div class="col-span-2 h-8 bg-emerald-500 rounded"></div>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="block.type === 'custom_html'">
                                    <div class="bg-gray-900 text-green-400 p-3 rounded-lg font-mono text-xs">
                                        <span x-text="block.data.html ? block.data.html.substring(0, 100) + '...' : '&lt;!-- Custom HTML --&gt;'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Right Sidebar - Block Editor -->
        <div class="w-full lg:w-80 flex-shrink-0">
            <div class="content-card p-6 sticky top-24" x-show="editingBlock" x-transition>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-900">Edit Block</h3>
                    <button @click="cancelEdit" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <!-- Hero Block Fields -->
                    <template x-if="editingBlock?.type === 'hero'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" x-model="editingBlock.data.title" class="input-field" placeholder="Hero title">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                <textarea x-model="editingBlock.data.subtitle" class="input-field" rows="2" placeholder="Subtitle text"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CTA Text</label>
                                <input type="text" x-model="editingBlock.data.cta_text" class="input-field" placeholder="Learn More">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CTA URL</label>
                                <input type="text" x-model="editingBlock.data.cta_url" class="input-field" placeholder="/about">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Background Image URL</label>
                                <input type="text" x-model="editingBlock.data.background_image" class="input-field" placeholder="/storage/images/hero.jpg">
                            </div>
                        </div>
                    </template>

                    <!-- Rich Text Block Fields -->
                    <template x-if="editingBlock?.type === 'richtext'">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML)</label>
                            <textarea x-model="editingBlock.data.content" class="input-field font-mono text-sm" rows="10" placeholder="<p>Your content here...</p>"></textarea>
                        </div>
                    </template>

                    <!-- CTA Block Fields -->
                    <template x-if="editingBlock?.type === 'cta'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" x-model="editingBlock.data.title" class="input-field" placeholder="Ready to get started?">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea x-model="editingBlock.data.description" class="input-field" rows="2" placeholder="Description text"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                                <input type="text" x-model="editingBlock.data.button_text" class="input-field" placeholder="Get Started">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Button URL</label>
                                <input type="text" x-model="editingBlock.data.button_url" class="input-field" placeholder="/contact">
                            </div>
                        </div>
                    </template>

                    <!-- Image Block Fields -->
                    <template x-if="editingBlock?.type === 'image'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                                <input type="text" x-model="editingBlock.data.src" class="input-field" placeholder="/storage/images/image.jpg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                                <input type="text" x-model="editingBlock.data.alt" class="input-field" placeholder="Image description">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                                <input type="text" x-model="editingBlock.data.caption" class="input-field" placeholder="Optional caption">
                            </div>
                        </div>
                    </template>

                    <!-- Video Block Fields -->
                    <template x-if="editingBlock?.type === 'video'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                                <input type="text" x-model="editingBlock.data.url" class="input-field" placeholder="https://youtube.com/watch?v=...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" x-model="editingBlock.data.title" class="input-field" placeholder="Video title">
                            </div>
                        </div>
                    </template>

                    <!-- Custom HTML Block Fields -->
                    <template x-if="editingBlock?.type === 'custom_html'">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">HTML Code</label>
                            <textarea x-model="editingBlock.data.html" class="input-field font-mono text-sm" rows="12" placeholder="<div>Your HTML here</div>"></textarea>
                        </div>
                    </template>

                    <!-- Generic Fields for other block types -->
                    <template x-if="['features', 'gallery', 'testimonials', 'faq', 'contact'].includes(editingBlock?.type)">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Block Data (JSON)</label>
                            <textarea x-model="editingBlockJson" class="input-field font-mono text-xs" rows="10"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Advanced: Edit the raw JSON data</p>
                        </div>
                    </template>

                    <div class="flex gap-2 pt-4 border-t">
                        <button @click="applyEdit" class="btn-primary flex-1">Apply Changes</button>
                        <button @click="cancelEdit" class="btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Page Info when not editing -->
            <div class="content-card p-6 sticky top-24" x-show="!editingBlock">
                <h3 class="font-semibold text-gray-900 mb-4">Page Info</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium {{ $page->status ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $page->status ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Template</span>
                        <span class="font-medium text-gray-900">{{ $templates[$page->template] ?? 'Default' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">URL</span>
                        <span class="font-medium text-gray-900">/p/{{ $page->slug }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Last Updated</span>
                        <span class="font-medium text-gray-900">{{ $page->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function pageBuilder(initialBlocks, blockTypes) {
            return {
                blocks: initialBlocks || [],
                blockTypes: blockTypes,
                editingBlock: null,
                editingBlockId: null,
                editingBlockJson: '',
                originalBlocks: JSON.stringify(initialBlocks || []),
                hasChanges: false,
                saving: false,
                successMessage: '',

                init() {
                    this.$watch('blocks', () => {
                        this.hasChanges = JSON.stringify(this.blocks) !== this.originalBlocks;
                    }, { deep: true });

                    // Initialize lucide icons
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                },

                generateId() {
                    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                        const r = Math.random() * 16 | 0;
                        const v = c === 'x' ? r : (r & 0x3 | 0x8);
                        return v.toString(16);
                    });
                },

                addBlock(type) {
                    const newBlock = {
                        id: this.generateId(),
                        type: type,
                        data: this.getDefaultData(type)
                    };
                    this.blocks.push(newBlock);
                    this.editBlock(newBlock);
                },

                getDefaultData(type) {
                    const defaults = {
                        hero: { title: '', subtitle: '', cta_text: '', cta_url: '', background_image: '' },
                        richtext: { content: '' },
                        cta: { title: '', description: '', button_text: '', button_url: '' },
                        image: { src: '', alt: '', caption: '' },
                        video: { url: '', title: '' },
                        custom_html: { html: '' },
                        features: { columns: 3, items: [] },
                        gallery: { images: [] },
                        testimonials: { items: [] },
                        faq: { items: [] },
                        contact: { title: '', description: '' }
                    };
                    return defaults[type] || {};
                },

                editBlock(block) {
                    this.editingBlock = JSON.parse(JSON.stringify(block));
                    this.editingBlockId = block.id;
                    this.editingBlockJson = JSON.stringify(block.data, null, 2);
                },

                applyEdit() {
                    if (!this.editingBlock) return;

                    // For advanced blocks, parse JSON
                    if (['features', 'gallery', 'testimonials', 'faq', 'contact'].includes(this.editingBlock.type)) {
                        try {
                            this.editingBlock.data = JSON.parse(this.editingBlockJson);
                        } catch (e) {
                            alert('Invalid JSON format');
                            return;
                        }
                    }

                    const index = this.blocks.findIndex(b => b.id === this.editingBlock.id);
                    if (index !== -1) {
                        this.blocks[index] = this.editingBlock;
                    }
                    this.cancelEdit();
                },

                cancelEdit() {
                    this.editingBlock = null;
                    this.editingBlockId = null;
                    this.editingBlockJson = '';
                },

                deleteBlock(index) {
                    if (confirm('Are you sure you want to delete this block?')) {
                        this.blocks.splice(index, 1);
                        if (this.editingBlockId === this.blocks[index]?.id) {
                            this.cancelEdit();
                        }
                    }
                },

                duplicateBlock(index) {
                    const original = this.blocks[index];
                    const clone = JSON.parse(JSON.stringify(original));
                    clone.id = this.generateId();
                    this.blocks.splice(index + 1, 0, clone);
                },

                moveBlock(index, direction) {
                    const newIndex = index + direction;
                    if (newIndex < 0 || newIndex >= this.blocks.length) return;

                    const block = this.blocks.splice(index, 1)[0];
                    this.blocks.splice(newIndex, 0, block);
                },

                async saveBlocks() {
                    if (this.saving) return;

                    this.saving = true;
                    try {
                        const response = await fetch('{{ route('dashboard.pages.blocks', $page) }}', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ blocks: this.blocks })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.originalBlocks = JSON.stringify(this.blocks);
                            this.hasChanges = false;
                            this.successMessage = 'Changes saved successfully!';
                            setTimeout(() => { this.successMessage = ''; }, 3000);
                        } else {
                            alert('Failed to save changes');
                        }
                    } catch (error) {
                        console.error('Save error:', error);
                        alert('An error occurred while saving');
                    } finally {
                        this.saving = false;
                    }
                }
            };
        }
    </script>
    @endpush
</x-admin-dashboard-layout>
