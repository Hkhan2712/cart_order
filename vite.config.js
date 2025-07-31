import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/admin/admin.css',
                'resources/js/admin/admin.js',
                'resources/js/admin/categories.js',
                'resources/js/admmin/products.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
