import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/calender.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // 出力先を明示
    }
});
