import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        VitePWA({
            registerType: 'autoUpdate',
            includeAssets: ['/assets/images/favicon.ico'],
            manifest: {
                name: 'Ayam Keliling 88',
                short_name: 'Aling',
                description: 'Beli Ayam Lebih Mudah lewat Aling',
                theme_color: '#ffffff',
                background_color: '#ffffff',
                display: 'standalone',
                start_url: '/',
                icons: [
                {
                    src: '/assets/images/logo-192x192.png',
                    sizes: '192x192',
                    type: 'image/png',
                },
                {
                    src: '/assets/images/logo-512x512.png',
                    sizes: '512x512',
                    type: 'image/png',
                },
                ],
            },
        }),
    ],
});
