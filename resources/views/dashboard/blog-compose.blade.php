<x-dashboard-layout title="Compose Blog Post">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Compose Blog Post</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.blog.manage') }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium py-2 px-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Manage Posts
                </a>
            </div>
        </div>
    </x-slot>

    @php(
        $categories = \App\Models\BlogCategory::orderBy('name')->get()
    )

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Composer -->
                <form method="POST" action="{{ route('dashboard.blog.store') }}" enctype="multipart/form-data" class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    @csrf
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Create Blog Post</h3>
                        <p class="text-sm text-gray-500 mt-1">Minimal, focused, and precise. Keep it simple.</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" name="title" type="text" required placeholder="A clear, concise title" value="{{ old('title') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (optional)</label>
                                <input id="slug" name="slug" type="text" placeholder="auto-generated if empty" value="{{ old('slug') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="category_id" name="category_id" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                    <option value="">None</option>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Short summary (max 160 characters for SEO)" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ old('excerpt') }}</textarea>
                            <div class="mt-1 text-xs text-gray-500"><span id="excerptCount">0</span>/160</div>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Body</label>
                            
                            <!-- Formatting Toolbar (Sticky) -->
                            <div class="sticky top-[72px] z-50 border border-gray-300 rounded-t-lg bg-gray-50/95 backdrop-blur shadow-sm p-2 flex flex-wrap items-center gap-1 transition-all duration-300">
                                <button type="button" onclick="formatText('bold')" class="p-2 rounded hover:bg-gray-200 transition" title="Bold (Ctrl+B)">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('italic')" class="p-2 rounded hover:bg-gray-200 transition" title="Italic (Ctrl+I)">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('underline')" class="p-2 rounded hover:bg-gray-200 transition" title="Underline (Ctrl+U)">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('strike')" class="p-2 rounded hover:bg-gray-200 transition" title="Strikethrough">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M10 19h4v-3h-4v3zM5 4v3h5v3h4V7h5V4H5zM3 14h18v-2H3v2z"/></svg>
                                </button>
                                <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                <button type="button" onclick="formatText('h1')" class="px-2 py-1 rounded hover:bg-gray-200 transition font-bold text-sm" title="Heading 1">H1</button>
                                <button type="button" onclick="formatText('h2')" class="px-2 py-1 rounded hover:bg-gray-200 transition font-bold text-sm" title="Heading 2">H2</button>
                                <button type="button" onclick="formatText('h3')" class="px-2 py-1 rounded hover:bg-gray-200 transition font-bold text-sm" title="Heading 3">H3</button>
                                <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                <button type="button" onclick="formatText('ul')" class="p-2 rounded hover:bg-gray-200 transition" title="Bullet List">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('ol')" class="p-2 rounded hover:bg-gray-200 transition" title="Numbered List">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('quote')" class="p-2 rounded hover:bg-gray-200 transition" title="Quote">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
                                </button>
                                <button type="button" onclick="formatText('code')" class="p-2 rounded hover:bg-gray-200 transition" title="Code Block">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                                </button>
                                <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                <button type="button" onclick="formatText('link')" class="p-2 rounded hover:bg-gray-200 transition" title="Insert Link">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                </button>
                                <button type="button" onclick="insertImage()" class="p-2 rounded hover:bg-gray-200 transition" title="Insert Image">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </button>
                                <button type="button" onclick="formatText('clear')" class="ml-auto p-2 rounded hover:bg-gray-200 transition text-gray-400" title="Clear Selection">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                                </button>
                            </div>
                            
                            <textarea id="body" name="body" required placeholder="Write your post here... Use the toolbar above for formatting." class="w-full rounded-b-lg border border-t-0 border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 p-4 leading-7 font-serif resize-none overflow-hidden transition-all duration-300 min-h-[450px]">{{ old('body') }}</textarea>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <div class="flex items-center gap-3">
                                        <span><span id="bodyWords">0</span> words</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span><span id="bodyMinutes">1</span> min read</span>
                                    </div>
                                    <p id="wordGoalText" class="uppercase tracking-widest font-medium text-gray-400 text-[10px]">Goal: 0%</p>
                                </div>
                                <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden shadow-inner">
                                    <div id="wordGoalBar" data-goal="1000" class="h-full bg-emerald-400 transition-all duration-500 ease-out shadow-sm" style="width:0%"></div>
                                </div>
                                <p class="text-[10px] text-gray-400 italic">Target: 1,000 words for optimal SEO</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                            <div class="mt-2 flex items-center gap-4">
                                <input type="file" name="featured_image" id="featured_image" accept="image/*" class="block w-full text-sm text-gray-700" />
                            </div>
                            <div id="featuredPreview" class="mt-3 hidden">
                                <img src="" alt="Preview" class="h-40 rounded-lg border border-gray-200 object-cover">
                            </div>
                        </div>

                        <input type="hidden" name="author_id" value="{{ auth()->id() }}" />

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                    <option value="draft" @selected(old('status')==='draft')>Draft</option>
                                    <option value="published" @selected(old('status')==='published')>Published</option>
                                </select>
                            </div>
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700">Publish At</label>
                                <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div class="flex items-end">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-400" @checked(old('featured')) />
                                    Featured
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-3">
                                <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title') }}" placeholder="Defaults to post title" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div class="md:col-span-3">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" rows="2" placeholder="Up to 160 characters" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="md:col-span-3">
                                <label for="keywords" class="block text-sm font-medium text-gray-700">Keywords</label>
                                <input id="keywords" name="keywords" type="text" value="{{ old('keywords') }}" placeholder="comma,separated,keywords" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                        <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Save</button>
                    </div>
                </form>

                <!-- Live Preview -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Live Preview</h3>
                    <div class="space-y-3">
                        <div class="text-2xl font-semibold text-gray-900" id="previewTitle">Your title appears here</div>
                        <div class="text-sm text-gray-500" id="previewExcerpt">A short summary of your article.</div>
                        <div class="aspect-video rounded-lg border border-gray-200 bg-gray-50 overflow-hidden" id="previewImageWrap">
                            <img id="previewImage" class="w-full h-full object-cover hidden" alt="Preview" />
                        </div>
                        <div class="prose max-w-none" id="previewBody"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Text Formatting Functions
        function formatText(command) {
            const textarea = document.getElementById('body');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            let formattedText = '';
            
            switch(command) {
                case 'bold':
                    formattedText = `**${selectedText || 'bold text'}**`;
                    break;
                case 'italic':
                    formattedText = `*${selectedText || 'italic text'}*`;
                    break;
                case 'underline':
                    formattedText = `<u>${selectedText || 'underlined text'}</u>`;
                    break;
                case 'h1':
                    formattedText = `# ${selectedText || 'Heading 1'}`;
                    break;
                case 'h2':
                    formattedText = `## ${selectedText || 'Heading 2'}`;
                    break;
                case 'h3':
                    formattedText = `### ${selectedText || 'Heading 3'}`;
                    break;
                case 'ul':
                    formattedText = `- ${selectedText || 'List item'}`;
                    break;
                case 'ol':
                    formattedText = `1. ${selectedText || 'List item'}`;
                    break;
                case 'quote':
                    formattedText = `> ${selectedText || 'Quote'}`;
                    break;
                case 'code':
                    formattedText = `\`\`\`\n${selectedText || 'code here'}\n\`\`\``;
                    break;
                case 'strike':
                    formattedText = `~~${selectedText || 'strikethrough text'}~~`;
                    break;
                case 'clear':
                    textarea.value = textarea.value.substring(0, start) + selectedText + textarea.value.substring(end);
                    textarea.focus();
                    textarea.setSelectionRange(start, start + selectedText.length);
                    updateBodyStats();
                    updatePreview();
                    return;
                case 'link':
                    const url = prompt('Enter URL:');
                    if (url) {
                        formattedText = `[${selectedText || 'link text'}](${url})`;
                    } else return;
                    break;
            }
            
            textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
            textarea.focus();
            const newPos = start + formattedText.length;
            textarea.setSelectionRange(newPos, newPos);
            updateBodyStats();
            updatePreview();
        }

        function insertImage() {
            const textarea = document.getElementById('body');
            const url = prompt('Enter image URL:');
            if (!url) return;
            
            const altText = prompt('Enter image description (alt text):') || 'image';
            const imageMarkdown = `\n![${altText}](${url})\n`;
            
            const start = textarea.selectionStart;
            textarea.value = textarea.value.substring(0, start) + imageMarkdown + textarea.value.substring(start);
            textarea.focus();
            updateBodyStats();
            updatePreview();
        }

        // Keyboard shortcuts for formatting
        document.addEventListener('keydown', (e) => {
            const textarea = document.getElementById('body');
            if (document.activeElement !== textarea) return;
            
            if ((e.ctrlKey || e.metaKey) && !e.shiftKey) {
                switch(e.key.toLowerCase()) {
                    case 'b':
                        e.preventDefault();
                        formatText('bold');
                        break;
                    case 'i':
                        e.preventDefault();
                        formatText('italic');
                        break;
                    case 'u':
                        e.preventDefault();
                        formatText('underline');
                        break;
                    case 'k':
                        e.preventDefault();
                        formatText('link');
                        break;
                }
            }
        });

        // Character counters and live preview
        const titleEl = document.getElementById('title');
        const excerpt = document.getElementById('excerpt');
        const bodyEl = document.getElementById('body');
        const wordsEl = document.getElementById('bodyWords');
        const minsEl = document.getElementById('bodyMinutes');
        const excerptCount = document.getElementById('excerptCount');
        const previewTitle = document.getElementById('previewTitle');
        const previewExcerpt = document.getElementById('previewExcerpt');
        const previewBody = document.getElementById('previewBody');

        const wordGoalBar = document.getElementById('wordGoalBar');
        const wordGoalText = document.getElementById('wordGoalText');
        const wordGoalTarget = Number(wordGoalBar?.dataset.goal || 1000);

        function updateBodyStats() {
            const text = (bodyEl?.value || '').replace(/<[^>]*>?/gm, ' ');
            const wc = text.trim() ? text.trim().split(/\s+/).length : 0;
            if (wordsEl) wordsEl.textContent = wc;
            if (minsEl) minsEl.textContent = Math.max(1, Math.ceil(wc / 200));

            // Update Word Goal
            if (wordGoalBar) {
                const pct = Math.min(100, Math.round((wc / wordGoalTarget) * 100));
                wordGoalBar.style.width = pct + '%';
                wordGoalBar.classList.toggle('bg-red-400', pct < 30);
                wordGoalBar.classList.toggle('bg-amber-400', pct >= 30 && pct < 70);
                wordGoalBar.classList.toggle('bg-emerald-400', pct >= 70);
                if (wordGoalText) {
                    wordGoalText.textContent = `Goal: ${pct}%`;
                }
            }

            // Auto-resize textarea
            if (bodyEl) {
                bodyEl.style.height = 'auto';
                bodyEl.style.height = (bodyEl.scrollHeight) + 'px';
            }
        }

        function updateExcerptCount() {
            const len = (excerpt?.value || '').trim().length;
            if (excerptCount) excerptCount.textContent = Math.min(len, 160);
        }

        function updatePreview() {
            if (previewTitle && titleEl) previewTitle.textContent = titleEl.value || 'Your title appears here';
            if (previewExcerpt && excerpt) previewExcerpt.textContent = excerpt.value || 'A short summary of your article.';
            if (previewBody && bodyEl) {
                const text = bodyEl.value || '';
                // Simple markdown-to-html preview
                let html = text
                    .replace(/^### (.+)$/gm, '<h3 class="font-bold text-lg mt-4">$1</h3>')
                    .replace(/^## (.+)$/gm, '<h2 class="font-bold text-xl mt-4">$1</h2>')
                    .replace(/^# (.+)$/gm, '<h1 class="font-bold text-2xl mt-4">$1</h1>')
                    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.+?)\*/g, '<em>$1</em>')
                    .replace(/\n\n/g, '</p><p class="mt-4">')
                    .replace(/\n/g, '<br>');
                previewBody.innerHTML = '<p>' + html + '</p>';
            }
        }

        bodyEl?.addEventListener('input', () => { updateBodyStats(); updatePreview(); });
        titleEl?.addEventListener('input', updatePreview);
        excerpt?.addEventListener('input', () => { updateExcerptCount(); updatePreview(); });
        updateBodyStats();
        updateExcerptCount();
        updatePreview();

        // Featured image preview
        const fi = document.getElementById('featured_image');
        const previewWrap = document.getElementById('featuredPreview');
        const previewImg = document.getElementById('previewImage');
        if (fi && previewWrap && previewImg) {
            fi.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (!file) return;
                const url = URL.createObjectURL(file);
                previewImg.src = url;
                previewImg.classList.remove('hidden');
                previewWrap.classList.remove('hidden');
            });
        }
    </script>
    @endpush
</x-dashboard-layout>