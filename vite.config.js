import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '127.0.0.1',           
        port: 5173,
        origin: 'http://127.0.0.1:5173',
        cors: true, 
        strictPort: true,
        hmr: {
            host: 'admin.aquaterra.com',       
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/admin/admin.css',
                'resources/js/admin/admin.js',
                'resources/js/admin/charts/products-by-category.js',
                'resources/js/admin/charts/monthly-sales.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
