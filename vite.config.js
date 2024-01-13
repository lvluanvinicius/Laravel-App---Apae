import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react-refresh';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/photo-gallery/photo-gallery.js',
                'resources/js/contact/contact.js',
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
});
