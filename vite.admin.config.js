import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                "resources/admin/css/admin.css",
                "resources/admin/src/main.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        emptyOutDir: false,
    },
    resolve: {
        extensions: [".vue", ".js", ".json"],
    },
});
