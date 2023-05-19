import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { initFlowbite } from "flowbite";

export default defineConfig({
    mounted() {
        initFlowbite(); // Initialize Flowbite on mount of the Vue component
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
