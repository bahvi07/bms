import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.1.20',
            protocol: 'ws',
            port: 5174,
        },
        cors: true,
        watch: {
            usePolling: true,
        },
        strictPort: true,
        port: 5174,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // Only set base URL in development
    base: command === 'serve' ? 'http://localhost:5173' : '/build/',
}));
