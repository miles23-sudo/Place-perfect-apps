import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/filament/theme.css",
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: [
                "**/storage/logs/**",
                "**/storage/framework/cache/**",
                "**/storage/framework/sessions/**",
                "**/storage/framework/views/**",
                "**/vendor/**",
                "**/node_modules/**",
                "**/public/storage/**",
            ],
        },
    },
});
