import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/main.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
