import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/blog.css',
                'resources/js/app.js', 
                'resources/js/blog.js'
            ],
            refresh: true,
        }),
    ],
});
