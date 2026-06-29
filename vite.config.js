import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [ 
                'resources/css/app.css',
                'resources/css/layout-conflicts-fix.css',
                'resources/css/premium-nav.css',
                'resources/css/blog.css',
                'resources/css/tiptap-editor.css',
                'resources/js/app.js',
                'resources/js/blog.js',
                'resources/js/tiptap-editor.js',
                'resources/js/blog-admin-editor.js',
            ],
            refresh: true,
        }),
    ],
});
