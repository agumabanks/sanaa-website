/**
 * Tiptap Rich Text Editor for Blog Compose
 * A Google Docs-like editing experience
 */

import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';
import CharacterCount from '@tiptap/extension-character-count';
import Underline from '@tiptap/extension-underline';
import TextAlign from '@tiptap/extension-text-align';

/**
 * Initialize the Tiptap editor
 * @param {HTMLElement} mountPoint - The container element
 * @param {HTMLTextAreaElement} hiddenInput - Hidden textarea to sync content
 * @param {Object} options - Editor options
 */
export function initTiptapEditor(mountPoint, hiddenInput, options = {}) {
    const {
        placeholder = 'Start writing your story...',
        initialContent = '',
        onUpdate = null,
    } = options;

    // Create toolbar
    const toolbar = createToolbar();
    mountPoint.appendChild(toolbar);

    // Create editor container
    const editorContainer = document.createElement('div');
    editorContainer.className = 'tiptap-editor-content';
    mountPoint.appendChild(editorContainer);

    // Create status bar
    const statusBar = createStatusBar();
    mountPoint.appendChild(statusBar);

    // Initialize Tiptap
    const editor = new Editor({
        element: editorContainer,
        extensions: [
            StarterKit.configure({
                heading: {
                    levels: [1, 2, 3],
                },
            }),
            Image.configure({
                HTMLAttributes: {
                    class: 'tiptap-image',
                },
            }),
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    class: 'tiptap-link',
                },
            }),
            Placeholder.configure({
                placeholder,
            }),
            CharacterCount,
            Underline,
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
        ],
        content: initialContent || hiddenInput.value || '',
        editorProps: {
            attributes: {
                class: 'tiptap-prose',
            },
        },
        onUpdate: ({ editor }) => {
            const html = editor.getHTML();
            hiddenInput.value = html;

            // Update stats
            updateStatusBar(statusBar, editor);

            // Custom callback
            if (onUpdate) {
                onUpdate({
                    html,
                    text: editor.getText(),
                    wordCount: editor.storage.characterCount.words(),
                    charCount: editor.storage.characterCount.characters(),
                });
            }
        },
        onSelectionUpdate: ({ editor }) => {
            updateToolbarState(toolbar, editor);
        },
    });

    // Attach toolbar handlers
    attachToolbarHandlers(toolbar, editor);

    // Initial update
    updateStatusBar(statusBar, editor);
    updateToolbarState(toolbar, editor);

    return editor;
}

/**
 * Create the formatting toolbar
 */
function createToolbar() {
    const toolbar = document.createElement('div');
    toolbar.className = 'tiptap-toolbar';
    toolbar.innerHTML = `
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="undo" title="Undo (Ctrl+Z)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 7v6h6"/><path d="M21 17a9 9 0 00-9-9 9 9 0 00-6.36 2.64L3 13"/>
                </svg>
            </button>
            <button type="button" data-action="redo" title="Redo (Ctrl+Y)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 7v6h-6"/><path d="M3 17a9 9 0 019-9 9 9 0 016.36 2.64L21 13"/>
                </svg>
            </button>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <select data-action="heading" class="tiptap-select" title="Text style">
                <option value="paragraph">Normal text</option>
                <option value="1">Heading 1</option>
                <option value="2">Heading 2</option>
                <option value="3">Heading 3</option>
            </select>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="bold" title="Bold (Ctrl+B)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/>
                </svg>
            </button>
            <button type="button" data-action="italic" title="Italic (Ctrl+I)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/>
                </svg>
            </button>
            <button type="button" data-action="underline" title="Underline (Ctrl+U)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z"/>
                </svg>
            </button>
            <button type="button" data-action="strike" title="Strikethrough" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 19h4v-3h-4v3zM5 4v3h5v3h4V7h5V4H5zM3 14h18v-2H3v2z"/>
                </svg>
            </button>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="alignLeft" title="Align left" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z"/>
                </svg>
            </button>
            <button type="button" data-action="alignCenter" title="Align center" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 15v2h10v-2H7zm-4 6h18v-2H3v2zm0-8h18v-2H3v2zm4-6v2h10V7H7zM3 3v2h18V3H3z"/>
                </svg>
            </button>
            <button type="button" data-action="alignRight" title="Align right" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 21h18v-2H3v2zm6-4h12v-2H9v2zm-6-4h18v-2H3v2zm6-4h12V7H9v2zM3 3v2h18V3H3z"/>
                </svg>
            </button>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="bulletList" title="Bullet list" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/>
                </svg>
            </button>
            <button type="button" data-action="orderedList" title="Numbered list" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/>
                </svg>
            </button>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="blockquote" title="Quote" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                </svg>
            </button>
            <button type="button" data-action="codeBlock" title="Code block" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                </svg>
            </button>
            <button type="button" data-action="horizontalRule" title="Horizontal line" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13H5v-2h14v2z"/>
                </svg>
            </button>
        </div>
        
        <div class="tiptap-toolbar-divider"></div>
        
        <div class="tiptap-toolbar-group">
            <button type="button" data-action="link" title="Insert link (Ctrl+K)" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
            </button>
            <button type="button" data-action="image" title="Insert image" class="tiptap-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </button>
        </div>
    `;
    return toolbar;
}

/**
 * Create the status bar
 */
function createStatusBar() {
    const statusBar = document.createElement('div');
    statusBar.className = 'tiptap-status-bar';
    statusBar.innerHTML = `
        <div class="tiptap-status-left">
            <span class="tiptap-word-count">0 words</span>
            <span class="tiptap-char-count">0 characters</span>
            <span class="tiptap-read-time">~1 min read</span>
        </div>
        <div class="tiptap-status-right">
            <span class="tiptap-autosave" title="Content synced">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Saved
            </span>
        </div>
    `;
    return statusBar;
}

/**
 * Update status bar with current editor stats
 */
function updateStatusBar(statusBar, editor) {
    const wordCount = editor.storage.characterCount.words();
    const charCount = editor.storage.characterCount.characters();
    const readTime = Math.max(1, Math.ceil(wordCount / 200));

    statusBar.querySelector('.tiptap-word-count').textContent = `${wordCount} word${wordCount !== 1 ? 's' : ''}`;
    statusBar.querySelector('.tiptap-char-count').textContent = `${charCount} character${charCount !== 1 ? 's' : ''}`;
    statusBar.querySelector('.tiptap-read-time').textContent = `~${readTime} min read`;
}

/**
 * Update toolbar button active states
 */
function updateToolbarState(toolbar, editor) {
    // Text formatting buttons
    const actions = ['bold', 'italic', 'underline', 'strike', 'blockquote', 'bulletList', 'orderedList', 'codeBlock'];
    actions.forEach(action => {
        const btn = toolbar.querySelector(`[data-action="${action}"]`);
        if (btn) {
            btn.classList.toggle('active', editor.isActive(action === 'bulletList' ? 'bulletList' : action === 'orderedList' ? 'orderedList' : action));
        }
    });

    // Heading dropdown
    const headingSelect = toolbar.querySelector('[data-action="heading"]');
    if (headingSelect) {
        if (editor.isActive('heading', { level: 1 })) {
            headingSelect.value = '1';
        } else if (editor.isActive('heading', { level: 2 })) {
            headingSelect.value = '2';
        } else if (editor.isActive('heading', { level: 3 })) {
            headingSelect.value = '3';
        } else {
            headingSelect.value = 'paragraph';
        }
    }

    // Alignment buttons
    ['alignLeft', 'alignCenter', 'alignRight'].forEach(align => {
        const btn = toolbar.querySelector(`[data-action="${align}"]`);
        if (btn) {
            const alignValue = align.replace('align', '').toLowerCase();
            btn.classList.toggle('active', editor.isActive({ textAlign: alignValue }));
        }
    });

    // Link button
    const linkBtn = toolbar.querySelector('[data-action="link"]');
    if (linkBtn) {
        linkBtn.classList.toggle('active', editor.isActive('link'));
    }
}

/**
 * Attach click handlers to toolbar buttons
 */
function attachToolbarHandlers(toolbar, editor) {
    // Undo/Redo
    toolbar.querySelector('[data-action="undo"]')?.addEventListener('click', () => {
        editor.chain().focus().undo().run();
    });
    toolbar.querySelector('[data-action="redo"]')?.addEventListener('click', () => {
        editor.chain().focus().redo().run();
    });

    // Heading dropdown
    toolbar.querySelector('[data-action="heading"]')?.addEventListener('change', (e) => {
        const value = e.target.value;
        if (value === 'paragraph') {
            editor.chain().focus().setParagraph().run();
        } else {
            editor.chain().focus().toggleHeading({ level: parseInt(value) }).run();
        }
    });

    // Text formatting
    toolbar.querySelector('[data-action="bold"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleBold().run();
    });
    toolbar.querySelector('[data-action="italic"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleItalic().run();
    });
    toolbar.querySelector('[data-action="underline"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleUnderline().run();
    });
    toolbar.querySelector('[data-action="strike"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleStrike().run();
    });

    // Alignment
    toolbar.querySelector('[data-action="alignLeft"]')?.addEventListener('click', () => {
        editor.chain().focus().setTextAlign('left').run();
    });
    toolbar.querySelector('[data-action="alignCenter"]')?.addEventListener('click', () => {
        editor.chain().focus().setTextAlign('center').run();
    });
    toolbar.querySelector('[data-action="alignRight"]')?.addEventListener('click', () => {
        editor.chain().focus().setTextAlign('right').run();
    });

    // Lists
    toolbar.querySelector('[data-action="bulletList"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleBulletList().run();
    });
    toolbar.querySelector('[data-action="orderedList"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleOrderedList().run();
    });

    // Blockquote and code
    toolbar.querySelector('[data-action="blockquote"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleBlockquote().run();
    });
    toolbar.querySelector('[data-action="codeBlock"]')?.addEventListener('click', () => {
        editor.chain().focus().toggleCodeBlock().run();
    });
    toolbar.querySelector('[data-action="horizontalRule"]')?.addEventListener('click', () => {
        editor.chain().focus().setHorizontalRule().run();
    });

    // Link
    toolbar.querySelector('[data-action="link"]')?.addEventListener('click', () => {
        if (editor.isActive('link')) {
            editor.chain().focus().unsetLink().run();
        } else {
            const url = window.prompt('Enter URL:');
            if (url) {
                editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
            }
        }
    });

    // Image
    toolbar.querySelector('[data-action="image"]')?.addEventListener('click', () => {
        const url = window.prompt('Enter image URL:');
        if (url) {
            editor.chain().focus().setImage({ src: url }).run();
        }
    });
}

// Auto-initialize if DOM element exists
document.addEventListener('DOMContentLoaded', () => {
    const mountPoint = document.getElementById('tiptap-editor-mount');
    const hiddenInput = document.getElementById('body');
    
    if (mountPoint && hiddenInput) {
        window.tiptapEditor = initTiptapEditor(mountPoint, hiddenInput, {
            placeholder: 'Start writing your story...',
            initialContent: hiddenInput.value,
            onUpdate: ({ wordCount }) => {
                // Update preview if it exists
                const previewBody = document.getElementById('previewBody');
                if (previewBody) {
                    previewBody.innerHTML = hiddenInput.value;
                }
                // Update external word count display
                const bodyWords = document.getElementById('bodyWords');
                const bodyMinutes = document.getElementById('bodyMinutes');
                if (bodyWords) bodyWords.textContent = wordCount;
                if (bodyMinutes) bodyMinutes.textContent = Math.max(1, Math.ceil(wordCount / 200));
            },
        });
    }
});

export default { initTiptapEditor };
