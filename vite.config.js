import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        https: {
            key: "/Users/sebastian/.config/valet/Certificates/cluedo.test.key",
            cert: "/Users/sebastian/.config/valet/Certificates/cluedo.test.crt"
        },
        host: 'cluedo.test',
    },
});
