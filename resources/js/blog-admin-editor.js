function debounce(fn, wait = 500) {
    let timer = null;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), wait);
    };
}

function slugify(value) {
    return String(value || '')
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
}

function stripHtml(html) {
    return String(html || '').replace(/<[^>]*>/g, ' ');
}

function escapeHtml(value) {
    return String(value || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-blog-editor-form]');
    if (!form) {
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const fields = {
        title: form.querySelector('#title'),
        slug: form.querySelector('#slug'),
        excerpt: form.querySelector('#excerpt'),
        body: form.querySelector('#body'),
        keywords: form.querySelector('#keywords'),
        metaTitle: form.querySelector('#meta_title'),
        metaDescription: form.querySelector('#meta_description'),
        status: form.querySelector('#status'),
    };

    const seoScoreValue = document.getElementById('seo-score-value');
    const seoScoreBar = document.getElementById('seo-score-bar');
    const seoRecommendations = document.getElementById('seo-recommendations');
    const autosaveStatus = document.getElementById('editor-autosave-status');
    const wordCountNode = document.getElementById('editor-word-count');
    const readTimeNode = document.getElementById('editor-read-time');
    let editorWordCount = 0;

    function syncCounters() {
        const counters = [
            { input: fields.excerpt, output: document.getElementById('excerpt-count'), max: 180 },
            { input: fields.metaTitle, output: document.getElementById('meta-title-count'), max: 60 },
            { input: fields.metaDescription, output: document.getElementById('meta-description-count'), max: 160 },
        ];

        counters.forEach(({ input, output, max }) => {
            if (!input || !output) {
                return;
            }
            const len = String(input.value || '').trim().length;
            output.textContent = `${len}/${max}`;
            output.classList.toggle('text-red-600', len > max);
        });
    }

    function updateWordStats() {
        if (!fields.body) {
            return;
        }

        if (!editorWordCount) {
            const plain = stripHtml(fields.body.value).trim();
            editorWordCount = plain ? plain.split(/\s+/).length : 0;
        }

        const readingTime = Math.max(1, Math.ceil(editorWordCount / 200));
        if (wordCountNode) {
            wordCountNode.textContent = String(editorWordCount);
        }
        if (readTimeNode) {
            readTimeNode.textContent = String(readingTime);
        }
    }

    function updateSeoScore() {
        if (!seoScoreValue || !seoScoreBar || !seoRecommendations) {
            return;
        }

        const recommendations = [];
        let score = 0;

        const titleLength = String(fields.title?.value || '').trim().length;
        if (titleLength >= 30 && titleLength <= 65) {
            score += 20;
        } else {
            recommendations.push('Use a title between 30 and 65 characters.');
        }

        const excerptLength = String(fields.excerpt?.value || '').trim().length;
        if (excerptLength >= 100 && excerptLength <= 180) {
            score += 15;
        } else {
            recommendations.push('Write an excerpt around 100-180 characters.');
        }

        const metaTitleLength = String(fields.metaTitle?.value || '').trim().length;
        if (metaTitleLength >= 30 && metaTitleLength <= 60) {
            score += 15;
        } else {
            recommendations.push('Set an SEO title between 30 and 60 characters.');
        }

        const metaDescriptionLength = String(fields.metaDescription?.value || '').trim().length;
        if (metaDescriptionLength >= 120 && metaDescriptionLength <= 160) {
            score += 20;
        } else {
            recommendations.push('Keep meta description between 120 and 160 characters.');
        }

        if (editorWordCount >= 700) {
            score += 20;
        } else if (editorWordCount >= 450) {
            score += 10;
            recommendations.push('Expand content to 700+ words for stronger search coverage.');
        } else {
            recommendations.push('Add more depth. Target at least 450 words.');
        }

        const keywordsRaw = String(fields.keywords?.value || '').trim();
        const primaryKeyword = keywordsRaw.split(',').map((item) => item.trim()).find(Boolean) || '';
        if (primaryKeyword) {
            score += 10;
            const haystack = `${fields.title?.value || ''} ${fields.metaDescription?.value || ''}`.toLowerCase();
            if (!haystack.includes(primaryKeyword.toLowerCase())) {
                recommendations.push('Include the primary keyword in title or meta description.');
            }
        } else {
            recommendations.push('Add 3-5 target keywords.');
        }

        const hasHeading = /<h2|<h3/i.test(fields.body?.value || '');
        if (hasHeading) {
            score += 10;
        } else {
            recommendations.push('Use H2/H3 headings to improve structure.');
        }

        score = Math.min(100, score);
        seoScoreValue.textContent = `${score}/100`;
        seoScoreBar.style.width = `${score}%`;
        seoScoreBar.classList.toggle('bg-red-500', score < 50);
        seoScoreBar.classList.toggle('bg-amber-500', score >= 50 && score < 75);
        seoScoreBar.classList.toggle('bg-emerald-500', score >= 75);

        seoRecommendations.innerHTML = recommendations.length
            ? recommendations.map((item) => `<li>${escapeHtml(item)}</li>`).join('')
            : '<li>SEO baseline looks solid.</li>';
    }

    function updateEditorInsights() {
        syncCounters();
        updateWordStats();
        updateSeoScore();
    }

    let slugManuallyEdited = Boolean(String(fields.slug?.value || '').trim());
    fields.slug?.addEventListener('input', () => {
        slugManuallyEdited = true;
    });
    fields.title?.addEventListener('input', () => {
        if (!slugManuallyEdited && fields.slug) {
            fields.slug.value = slugify(fields.title.value);
        }
    });

    const localDraftKey = form.dataset.draftKey || '';
    const hasAutosaveUrl = Boolean(form.dataset.autosaveUrl);

    if (localDraftKey) {
        const hasExistingContent = [
            fields.title?.value,
            fields.excerpt?.value,
            fields.body?.value,
        ].some((value) => String(value || '').trim().length > 0);

        if (!hasExistingContent) {
            try {
                const cached = localStorage.getItem(localDraftKey);
                if (cached) {
                    const parsed = JSON.parse(cached);
                    if (fields.title && parsed.title) fields.title.value = parsed.title;
                    if (fields.slug && parsed.slug) fields.slug.value = parsed.slug;
                    if (fields.excerpt && parsed.excerpt) fields.excerpt.value = parsed.excerpt;
                    if (fields.body && parsed.body) fields.body.value = parsed.body;
                    if (fields.metaTitle && parsed.meta_title) fields.metaTitle.value = parsed.meta_title;
                    if (fields.metaDescription && parsed.meta_description) fields.metaDescription.value = parsed.meta_description;
                    if (fields.keywords && parsed.keywords) fields.keywords.value = parsed.keywords;
                    if (fields.status && parsed.status) fields.status.value = parsed.status;
                }
            } catch (error) {
                // Ignore malformed local draft payloads.
            }
        }
    }

    const saveLocalDraft = debounce(() => {
        if (!localDraftKey) {
            return;
        }

        const payload = {
            title: fields.title?.value || '',
            slug: fields.slug?.value || '',
            excerpt: fields.excerpt?.value || '',
            body: fields.body?.value || '',
            meta_title: fields.metaTitle?.value || '',
            meta_description: fields.metaDescription?.value || '',
            keywords: fields.keywords?.value || '',
            status: fields.status?.value || 'draft',
            saved_at: new Date().toISOString(),
        };

        try {
            localStorage.setItem(localDraftKey, JSON.stringify(payload));
            if (!hasAutosaveUrl && autosaveStatus) {
                autosaveStatus.textContent = `Draft saved at ${new Date().toLocaleTimeString()}`;
            }
        } catch (error) {
            // Ignore localStorage failures.
        }
    }, 900);

    const remoteAutosave = debounce(async () => {
        const autosaveUrl = form.dataset.autosaveUrl;
        if (!autosaveUrl) {
            return;
        }

        if (autosaveStatus) {
            autosaveStatus.textContent = 'Saving...';
        }

        try {
            const response = await fetch(autosaveUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    content: {
                        title: fields.title?.value || '',
                        excerpt: fields.excerpt?.value || '',
                        body: fields.body?.value || '',
                    },
                    version: 0,
                    pending_operations: [],
                }),
            });

            if (autosaveStatus) {
                autosaveStatus.textContent = response.ok
                    ? `Saved at ${new Date().toLocaleTimeString()}`
                    : 'Autosave failed';
            }
        } catch (error) {
            if (autosaveStatus) {
                autosaveStatus.textContent = 'Autosave failed';
            }
        }
    }, 1400);

    const onFieldInput = () => {
        saveLocalDraft();
        remoteAutosave();
        updateEditorInsights();
    };

    [fields.title, fields.slug, fields.excerpt, fields.keywords, fields.metaTitle, fields.metaDescription]
        .filter(Boolean)
        .forEach((field) => field.addEventListener('input', onFieldInput));

    if (fields.body) {
        fields.body.addEventListener('input', () => {
            editorWordCount = 0;
            onFieldInput();
        });
    }

    document.addEventListener('tiptap:updated', (event) => {
        editorWordCount = event.detail?.wordCount || 0;
        updateEditorInsights();
        saveLocalDraft();
        remoteAutosave();
    });

    document.addEventListener('tiptap:upload-state', (event) => {
        if (!autosaveStatus) {
            return;
        }

        const state = event.detail?.state;
        if (state === 'uploading') {
            autosaveStatus.textContent = 'Uploading image...';
        } else if (state === 'uploaded') {
            autosaveStatus.textContent = 'Image added';
        } else if (state === 'error') {
            autosaveStatus.textContent = 'Image upload failed';
        }
    });

    form.querySelectorAll('[data-set-status]').forEach((button) => {
        button.addEventListener('click', () => {
            if (fields.status && button.dataset.setStatus) {
                fields.status.value = button.dataset.setStatus;
            }
            form.requestSubmit();
        });
    });

    form.querySelectorAll('[data-editor-command]').forEach((button) => {
        button.addEventListener('click', () => {
            const editor = window.tiptapEditor;
            if (!editor) {
                return;
            }

            const command = button.dataset.editorCommand;
            if (command === 'image') {
                document.dispatchEvent(new CustomEvent('tiptap:open-image'));
                return;
            }

            if (command === 'heading') {
                editor.chain().focus().insertContent('<h2>New section</h2><p></p>').run();
            } else if (command === 'quote') {
                editor.chain().focus().insertContent('<blockquote><p>Add a memorable quote.</p></blockquote><p></p>').run();
            } else if (command === 'divider') {
                editor.chain().focus().setHorizontalRule().createParagraphNear().run();
            }
        });
    });

    const featuredInput = form.querySelector('#featured_image');
    const featuredPreview = document.getElementById('featured-image-preview');
    featuredInput?.addEventListener('change', (event) => {
        const file = event.target.files?.[0];
        if (!file || !featuredPreview) {
            return;
        }
        featuredPreview.src = URL.createObjectURL(file);
        featuredPreview.classList.remove('hidden');
    });

    const aiButton = document.getElementById('refresh-ai-suggestions');
    const aiPanel = document.getElementById('ai-suggestions-panel');
    aiButton?.addEventListener('click', async () => {
        const aiUrl = form.dataset.aiUrl;
        if (!aiUrl || !aiPanel) {
            return;
        }
        aiPanel.innerHTML = '<p>Loading suggestions...</p>';
        try {
            const response = await fetch(aiUrl, { credentials: 'same-origin' });
            const data = await response.json();
            const suggestions = [
                ...(data?.seo_suggestions?.title_optimization?.suggestions || []),
                ...(data?.content_improvements || []),
            ];
            aiPanel.innerHTML = suggestions.length
                ? `<ul>${suggestions.map((item) => `<li>${escapeHtml(item)}</li>`).join('')}</ul>`
                : '<p>No suggestions right now.</p>';
        } catch (error) {
            aiPanel.innerHTML = '<p>Could not load suggestions.</p>';
        }
    });

    const seoButton = document.getElementById('refresh-seo-analysis');
    const seoApiPanel = document.getElementById('seo-analysis-panel');
    seoButton?.addEventListener('click', async () => {
        const seoUrl = form.dataset.seoUrl;
        if (!seoUrl || !seoApiPanel) {
            return;
        }
        seoApiPanel.innerHTML = '<p>Analyzing...</p>';
        try {
            const response = await fetch(seoUrl, { credentials: 'same-origin' });
            const data = await response.json();
            const tips = (data?.suggestions || []).map((item) => `<li>${escapeHtml(item)}</li>`).join('');
            seoApiPanel.innerHTML = `
                <p><strong>Overall score:</strong> ${data?.overall_score ?? '-'}</p>
                <ul>${tips || '<li>No recommendations from server.</li>'}</ul>
            `;
        } catch (error) {
            seoApiPanel.innerHTML = '<p>Could not run SEO analysis.</p>';
        }
    });

    form.addEventListener('submit', () => {
        if (localDraftKey) {
            localStorage.removeItem(localDraftKey);
        }
    });

    updateEditorInsights();
});
