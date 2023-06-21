import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { initFlowbite } from "flowbite";
import tailwindcss from "tailwindcss";

export default defineConfig({
    build: {
        rollupOptions: {
            input: {
                app: "./resources/js/app.js",
                css: "./resources/css/app.css",
                ptk: "./resources/js/ptk.js",
                mapel: "./resources/js/mapel.js",
                kelas: "./resources/js/kelas.js",
                jurusan: "./resources/js/jurusan.js",
                laporan: "./resources/js/laporan.js",
                sekolah: "./resources/js/sekolah.js",
            },
        },
    },
    plugins: [
        tailwindcss(),
        laravel({
            input: ["./resources/css/app.css", "./resources/js/**/*.js"],
            refresh: true,
        }),
    ],
    mounted() {
        initFlowbite();
    },
});
