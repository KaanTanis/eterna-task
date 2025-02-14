import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                // Ana uygulama girdileri
                "resources/css/app.css",
                "resources/js/app.js",
                // Admin panel girdileri
                "resources/admin/css/admin.css",
                "resources/admin/src/main.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
