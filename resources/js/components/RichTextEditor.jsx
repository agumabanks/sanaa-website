import { useEditor, EditorContent } from '@tiptap/react';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';
import CharacterCount from '@tiptap/extension-character-count';
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight';
import { lowlight } from 'lowlight';
import javascript from 'highlight.js/lib/languages/javascript';
import python from 'highlight.js/lib/languages/python';
import php from 'highlight.js/lib/languages/php';
import css from 'highlight.js/lib/languages/css';
import React, { useEffect, useState } from 'react';

// Register languages for syntax highlighting
lowlight.registerLanguage('javascript', javascript);
lowlight.registerLanguage('python', python);
lowlight.registerLanguage('php', php);
lowlight.registerLanguage('css', css);

const MenuBar = ({ editor }) => {
    if (!editor) return null;

    const addImage = () => {
        const url = window.prompt('Enter image URL:');
        if (url) {
            editor.chain().focus().setImage({ src: url }).run();
        }
    };

    const setLink = () => {
        const url = window.prompt('Enter URL:');
        if (url) {
            editor.chain().focus().setLink({ href: url }).run();
        }
    };

    return (
        <div className="border-b border-gray-200 bg-gray-50 px-4 py-2 flex flex-wrap items-center gap-1">
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleBold().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('bold') ? 'bg-gray-300' : ''}`}
                title="Bold (Cmd+B)"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleItalic().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('italic') ? 'bg-gray-300' : ''}`}
                title="Italic (Cmd+I)"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleCode().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('code') ? 'bg-gray-300' : ''}`}
                title="Inline Code"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
            </button>
            <div className="w-px h-6 bg-gray-300 mx-1"></div>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleHeading({ level: 1 }).run()}
                className={`p-2 rounded hover:bg-gray-200 font-bold ${editor.isActive('heading', { level: 1 }) ? 'bg-gray-300' : ''}`}
                title="Heading 1"
            >
                H1
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleHeading({ level: 2 }).run()}
                className={`p-2 rounded hover:bg-gray-200 font-bold ${editor.isActive('heading', { level: 2 }) ? 'bg-gray-300' : ''}`}
                title="Heading 2"
            >
                H2
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleHeading({ level: 3 }).run()}
                className={`p-2 rounded hover:bg-gray-200 font-bold ${editor.isActive('heading', { level: 3 }) ? 'bg-gray-300' : ''}`}
                title="Heading 3"
            >
                H3
            </button>
            <div className="w-px h-6 bg-gray-300 mx-1"></div>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleBulletList().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('bulletList') ? 'bg-gray-300' : ''}`}
                title="Bullet List"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleOrderedList().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('orderedList') ? 'bg-gray-300' : ''}`}
                title="Numbered List"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleCodeBlock().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('codeBlock') ? 'bg-gray-300' : ''}`}
                title="Code Block"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <rect x="2" y="3" width="20" height="18" rx="2"></rect>
                    <line x1="7" y1="8" x2="17" y2="8"></line>
                    <line x1="7" y1="12" x2="13" y2="12"></line>
                    <line x1="7" y1="16" x2="15" y2="16"></line>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().toggleBlockquote().run()}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('blockquote') ? 'bg-gray-300' : ''}`}
                title="Quote"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                </svg>
            </button>
            <div className="w-px h-6 bg-gray-300 mx-1"></div>
            <button
                type="button"
                onClick={setLink}
                className={`p-2 rounded hover:bg-gray-200 ${editor.isActive('link') ? 'bg-gray-300' : ''}`}
                title="Add Link"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
            </button>
            <button
                type="button"
                onClick={addImage}
                className="p-2 rounded hover:bg-gray-200"
                title="Add Image"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </button>
            <button
                type="button"
                onClick={() => editor.chain().focus().setHorizontalRule().run()}
                className="p-2 rounded hover:bg-gray-200"
                title="Horizontal Rule"
            >
                <svg className="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13H5v-2h14v2z"/>
                </svg>
            </button>
        </div>
    );
};

export default function RichTextEditor({ content = '', onChange, placeholder = 'Write your story...' }) {
    const [wordCount, setWordCount] = useState(0);
    const [charCount, setCharCount] = useState(0);

    const editor = useEditor({
        extensions: [
            StarterKit.configure({
                codeBlock: false,
            }),
            Image,
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    class: 'text-emerald-600 hover:text-emerald-700 underline',
                },
            }),
            Placeholder.configure({
                placeholder,
            }),
            CharacterCount,
            CodeBlockLowlight.configure({
                lowlight,
            }),
        ],
        content,
        editorProps: {
            attributes: {
                class: 'prose prose-lg max-w-none focus:outline-none min-h-[400px] px-6 py-4',
            },
        },
        onUpdate: ({ editor }) => {
            const html = editor.getHTML();
            const json = editor.getJSON();
            const text = editor.getText();
            
            setCharCount(editor.storage.characterCount.characters());
            setWordCount(editor.storage.characterCount.words());
            
            if (onChange) {
                onChange({
                    html,
                    json,
                    text,
                    wordCount: editor.storage.characterCount.words(),
                    charCount: editor.storage.characterCount.characters(),
                });
            }
        },
    });

    return (
        <div className="border border-gray-300 rounded-lg overflow-hidden bg-white">
            <MenuBar editor={editor} />
            <EditorContent editor={editor} />
            <div className="border-t border-gray-200 bg-gray-50 px-4 py-2 flex items-center justify-between text-xs text-gray-600">
                <div className="flex items-center gap-4">
                    <span>{wordCount} words</span>
                    <span>{charCount} characters</span>
                    <span>{Math.max(1, Math.ceil(wordCount / 200))} min read</span>
                </div>
                <div className="text-gray-500">
                    <span title="Auto-saved">💾</span>
                </div>
            </div>
        </div>
    );
}
