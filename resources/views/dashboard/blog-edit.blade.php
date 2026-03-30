@push('styles')
<style>
    .writing-canvas {
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .writing-canvas textarea {
        background: rgba(248, 250, 252, 0.98);
        border-bottom-left-radius: 24px;
        border-bottom-right-radius: 24px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border: 1px solid rgba(15, 23, 42, 0.18);
        padding: 1.5rem;
        color: #0f172a;
        box-shadow: inset 0 2px 4px rgba(15, 23, 42, 0.05);
        transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        font-size: 1rem;
        line-height: 1.65;
        letter-spacing: 0.01em;
        white-space: pre-wrap;
        tab-size: 2;
    }
    .writing-canvas.focus-mode textarea {
        background: rgba(2, 6, 23, 0.82);
        color: #f8fafc;
        border-color: rgba(255, 255, 255, 0.12);
        box-shadow: inset 0 25px 65px rgba(2, 6, 23, 0.65);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }
    .writing-canvas textarea::placeholder {
        color: rgba(15, 23, 42, 0.45);
    }
    .writing-canvas.focus-mode textarea::placeholder {
        color: rgba(248, 250, 252, 0.45);
    }
    .writing-canvas textarea::selection {
        background: rgba(16, 185, 129, 0.35);
    }
    .writing-canvas textarea::-webkit-scrollbar {
        width: 10px;
    }
    .writing-canvas textarea::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.4);
        border-radius: 999px;
    }
    .writing-canvas.focus-mode {
        position: fixed;
        inset: 2.5rem;
        margin: auto;
        max-width: min(1100px, calc(100vw - 5rem));
        z-index: 2000;
        box-shadow: 0 40px 160px rgba(15, 23, 42, 0.55);
    }
    .writing-canvas.focus-mode textarea {
        min-height: calc(100vh - 9rem);
    }
    body.writing-focus-active {
        overflow: hidden;
    }
    body.writing-focus-active::after {
        content: '';
        position: fixed;
        inset: 0;
        background: rgba(2, 6, 23, 0.7);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 1990;
    }
</style>
@endpush

<x-dashboard-layout title="Edit Blog">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Edit Blog Post</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard.blog.manage') }}" class="px-3 py-2 text-sm rounded bg-gray-100 hover:bg-gray-200">Back to Manage</a>
                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="px-3 py-2 text-sm rounded bg-gray-900 text-white hover:bg-black">View</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Editor form -->
            <div class="lg:col-span-2">
                <form id="editorForm" method="POST" action="{{ route('dashboard.blog.update', $blog) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input id="title" name="title" value="{{ old('title', $blog->title) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Slug</label>
                                <input id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        </div>
                        <div>
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-900">Body</label>
                                    <p class="text-xs text-gray-500 mt-1">Write freely using Markdown or HTML snippets. Autosave + AI suggestions run in the background.</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" id="insertDivider" class="px-3 py-1.5 text-xs font-semibold rounded-full border border-gray-200 text-gray-700 hover:bg-gray-100">Insert Divider</button>
                                    <button type="button" id="toggleFocus" class="px-3 py-1.5 text-xs font-semibold rounded-full border border-emerald-400 text-emerald-500 bg-white shadow-sm hover:-translate-y-0.5 transition">
                                        <span>Focus Mode</span>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Formatting Toolbar (Sticky) -->
                            <div class="sticky top-[72px] z-50 border border-gray-300 rounded-t-lg bg-gray-50/95 backdrop-blur shadow-sm p-2 flex flex-wrap items-center gap-1 mt-4 transition-all duration-300">
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
                            
                            <div id="writingCanvas" class="writing-canvas relative rounded-b-[30px] rounded-t-none border border-t-0 border-white/10 bg-white shadow-[0_10px_40px_rgba(15,23,42,0.12)] overflow-hidden transition-all duration-300">
                                <span class="absolute -top-24 -left-10 w-80 h-80 bg-emerald-500/20 blur-[160px] pointer-events-none"></span>
                                <span class="absolute bottom-0 right-0 w-64 h-64 bg-cyan-400/20 blur-[140px] pointer-events-none"></span>
                                <textarea id="body" name="body" rows="14" class="relative z-10 w-full min-h-[28rem] border-0 focus:ring-0 focus:outline-none text-base leading-relaxed placeholder-slate-400 font-light tracking-wide resize-none overflow-hidden">{{ old('body', $blog->body) }}</textarea>
                            </div>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-3 text-xs text-gray-400">
                                    <span><span id="wc">0</span> words</span>
                                    <span class="w-1 h-1 rounded-full bg-gray-400/70"></span>
                                    <span>~<span id="rt">0</span> min read</span>
                                </div>
                                <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                    <div id="wordGoalBar" data-goal="1200" class="h-full bg-emerald-400 transition-all duration-300" style="width:0%"></div>
                                </div>
                                <p id="wordGoalText" class="text-[11px] uppercase tracking-[0.35em] text-gray-500">Goal: 0%</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="draft" @selected(old('status', $blog->status)==='draft')>Draft</option>
                                    <option value="published" @selected(old('status', $blog->status)==='published')>Published</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Publish At</label>
                                <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                            <div class="flex items-end">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-emerald-600" @checked(old('featured', $blog->featured)) />
                                    Featured
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">—</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('category_id', $blog->category_id)===$cat->id)>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                                <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer focus:outline-none" accept="image/*" />
                                <div class="mt-2">
                                    @if($blog->featured_image)
                                        <img id="previewImage" src="{{ cdn_storage($blog->featured_image) }}" class="h-40 rounded border" />
                                    @else
                                        <img id="previewImage" class="h-40 rounded border hidden" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">SEO</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                                <input name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                                <input name="meta_description" value="{{ old('meta_description', $blog->meta_description) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keywords</label>
                                <input name="keywords" value="{{ old('keywords', $blog->keywords) }}" class="mt-1 w-full rounded border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <button type="submit" class="inline-flex items-center rounded bg-emerald-600 text-white px-4 py-2 text-sm hover:bg-emerald-700">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Insights side panel -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-gray-900">AI Suggestions</h3>
                        <button id="btnAISuggest" class="text-xs px-2 py-1 rounded bg-gray-900 text-white">Refresh</button>
                    </div>
                    <div id="aiSuggestions" class="text-sm text-gray-700 space-y-2">
                        <div class="text-gray-500">No suggestions yet.</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-gray-900">SEO Analysis</h3>
                        <button id="btnSEO" class="text-xs px-2 py-1 rounded bg-gray-900 text-white">Analyze</button>
                    </div>
                    <div id="seoBox" class="text-sm text-gray-700 space-y-2">
                        <div class="text-gray-500">Run analysis to see recommendations.</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-gray-900">Autosave</h3>
                        <span id="autosaveStatus" class="text-xs text-gray-500">Idle</span>
                    </div>
                    <p class="text-sm text-gray-600">Your changes are periodically saved as versions.</p>
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
                    updateStats();
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
            updateStats();
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
            updateStats();
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

        const bodyEl = document.getElementById('body');
        const titleEl = document.getElementById('title');
        const wcEl = document.getElementById('wc');
        const rtEl = document.getElementById('rt');
        const wordGoalBar = document.getElementById('wordGoalBar');
        const wordGoalText = document.getElementById('wordGoalText');
        const wordGoalTarget = Number(wordGoalBar?.dataset.goal || 1200);
        function updateStats(){
            const text = (bodyEl?.value || '').replace(/<[^>]*>?/gm, ' ');
            const wc = text.trim()? text.trim().split(/\s+/).length : 0;
            const rt = Math.max(1, Math.ceil(wc/200));
            wcEl.textContent = wc; rtEl.textContent = rt;
            if (wordGoalBar) {
                const pct = Math.min(100, Math.round((wc / wordGoalTarget) * 100));
                wordGoalBar.style.width = pct + '%';
                wordGoalBar.classList.toggle('bg-red-400', pct < 35);
                wordGoalBar.classList.toggle('bg-amber-400', pct >= 35 && pct < 70);
                wordGoalBar.classList.toggle('bg-emerald-400', pct >= 70);
                if (wordGoalText) {
                    wordGoalText.textContent = `${pct}% of ${wordGoalTarget.toLocaleString()} word goal`;
                }
            }
            // Auto-resize textarea
            if (bodyEl) {
                bodyEl.style.height = 'auto';
                bodyEl.style.height = (bodyEl.scrollHeight) + 'px';
            }
        }
        bodyEl?.addEventListener('input', updateStats); updateStats();

        // Focus / divider helpers
        const focusBtn = document.getElementById('toggleFocus');
        const writingCanvas = document.getElementById('writingCanvas');
        focusBtn?.addEventListener('click', () => {
            if (!writingCanvas) return;
            writingCanvas.classList.toggle('focus-mode');
            const active = writingCanvas.classList.contains('focus-mode');
            document.body.classList.toggle('writing-focus-active', active);
            focusBtn.querySelector('span').textContent = active ? 'Exit Focus' : 'Focus Mode';
            if (active) {
                setTimeout(() => bodyEl?.focus(), 200);
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && writingCanvas?.classList.contains('focus-mode')) {
                writingCanvas.classList.remove('focus-mode');
                document.body.classList.remove('writing-focus-active');
                focusBtn?.querySelector('span').textContent = 'Focus Mode';
            }
        });
        document.getElementById('insertDivider')?.addEventListener('click', () => {
            if (!bodyEl) return;
            const snippet = '\n\n---\n\n';
            const start = bodyEl.selectionStart ?? bodyEl.value.length;
            const end = bodyEl.selectionEnd ?? start;
            if (typeof bodyEl.setRangeText === 'function') {
                bodyEl.setRangeText(snippet, start, end, 'end');
            } else {
                bodyEl.value = bodyEl.value.slice(0, start) + snippet + bodyEl.value.slice(end);
            }
            bodyEl.dispatchEvent(new Event('input'));
            bodyEl.focus();
        });

        // Image preview
        const fi = document.getElementById('featured_image');
        const preview = document.getElementById('previewImage');
        fi?.addEventListener('change', (e)=>{ const f=e.target.files?.[0]; if(!f) return; preview.src = URL.createObjectURL(f); preview.classList.remove('hidden'); });

        // Autosave to web route
        const autosaveStatus = document.getElementById('autosaveStatus');
        let autosaveTimer; let pending = false;
        function queueAutosave(){
            if (pending) return; pending = true; autosaveStatus.textContent = 'Pending...';
            clearTimeout(autosaveTimer);
            autosaveTimer = setTimeout(doAutosave, 1200);
        }
        ['input','change'].forEach(ev=>{
            ['title','excerpt','body'].forEach(id=> document.getElementById(id)?.addEventListener(ev, queueAutosave));
        });
        async function doAutosave(){
            try {
                const res = await fetch('{{ route('api.blogs.autosave', $blog) }}',{
                    method:'POST',
                    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                    body: JSON.stringify({
                        content: { title: titleEl.value, body: bodyEl.value },
                        version: 0,
                    }),
                    credentials:'same-origin'
                });
                if(res.ok){ autosaveStatus.textContent='Saved ' + new Date().toLocaleTimeString(); }
                else { autosaveStatus.textContent='Autosave failed'; }
            } catch(e){ autosaveStatus.textContent='Autosave failed'; }
            finally { pending=false; }
        }

        // AI suggestions
        document.getElementById('btnAISuggest')?.addEventListener('click', async ()=>{
            const box = document.getElementById('aiSuggestions');
            box.innerHTML = '<div class="text-gray-500">Loading...</div>';
            try {
                const res = await fetch('{{ route('api.blogs.ai', $blog) }}', {credentials:'same-origin'});
                const data = await res.json();
                box.innerHTML = '';
                if(data.seo_suggestions){
                    const ul = document.createElement('ul'); ul.className='list-disc ml-5 text-sm';
                    data.seo_suggestions.title_optimization?.suggestions?.forEach(s=>{ const li=document.createElement('li'); li.textContent=s; ul.appendChild(li); });
                    box.appendChild(ul);
                }
                if(data.content_improvements){
                    const h=document.createElement('div'); h.className='font-medium mt-2'; h.textContent='Content improvements'; box.appendChild(h);
                    const ul = document.createElement('ul'); ul.className='list-disc ml-5 text-sm';
                    data.content_improvements.forEach(s=>{ const li=document.createElement('li'); li.textContent=s; ul.appendChild(li); });
                    box.appendChild(ul);
                }
            } catch(e){ box.innerHTML='<div class="text-red-600">Failed to load suggestions.</div>'; }
        });

        // SEO analysis
        document.getElementById('btnSEO')?.addEventListener('click', async ()=>{
            const box = document.getElementById('seoBox');
            box.innerHTML = '<div class="text-gray-500">Analyzing...</div>';
            try {
                const res = await fetch('{{ route('api.blogs.seo', $blog) }}');
                const d = await res.json();
                box.innerHTML = `<div class="text-sm">Overall score: <span class="font-semibold">${d.overall_score}</span></div>`;
                if(d.suggestions?.length){
                    const ul=document.createElement('ul'); ul.className='list-disc ml-5 text-sm mt-1';
                    d.suggestions.forEach(s=>{ const li=document.createElement('li'); li.textContent=s; ul.appendChild(li); });
                    box.appendChild(ul);
                }
            } catch(e){ box.innerHTML = '<div class="text-red-600">Analysis failed.</div>'; }
        });
    </script>
    @endpush
</x-dashboard-layout>
