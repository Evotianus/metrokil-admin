import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/assets/vendor/css/core.css',
                'public/assets/vendor/css/theme-default.css',
                'public/assets/vendor/fonts/boxicons.css',
                'public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'public/assets/js/config.js',
                'public/assets/vendor/libs/jquery/jquery.js',
                'public/assets/vendor/libs/popper/popper.js',
                'public/assets/vendor/js/bootstrap.js',
                'public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'public/assets/vendor/js/menu.js',
                'public/assets/js/main.js',
                'public/assets/vendor/libs/github/github.min.js',
            ],
            refresh: true,
        }),
    ],
});
