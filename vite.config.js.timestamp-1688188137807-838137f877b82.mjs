// vite.config.js
import { defineConfig } from "file:///D:/laragon/www/laravel-icp2/node_modules/vite/dist/node/index.js";
import laravel from "file:///D:/laragon/www/laravel-icp2/node_modules/laravel-vite-plugin/dist/index.mjs";
import { initFlowbite } from "file:///D:/laragon/www/laravel-icp2/node_modules/flowbite/lib/cjs/index.js";
import tailwindcss from "file:///D:/laragon/www/laravel-icp2/node_modules/tailwindcss/lib/index.js";
var vite_config_default = defineConfig({
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
        capaian: "./resources/js/capaian_jam.js",
        api: "./resources/js/api.js",
        toast: "./resources/js/toast.js",
        mengajar: "./resources/js/mengajar.js"
      }
    }
  },
  plugins: [
    tailwindcss(),
    laravel({
      input: ["./resources/css/app.css", "./resources/js/**/*.js"],
      refresh: true
    })
  ],
  mounted() {
    initFlowbite();
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFxsYXJhZ29uXFxcXHd3d1xcXFxsYXJhdmVsLWljcDJcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkQ6XFxcXGxhcmFnb25cXFxcd3d3XFxcXGxhcmF2ZWwtaWNwMlxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vRDovbGFyYWdvbi93d3cvbGFyYXZlbC1pY3AyL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcbmltcG9ydCBsYXJhdmVsIGZyb20gXCJsYXJhdmVsLXZpdGUtcGx1Z2luXCI7XG5pbXBvcnQgeyBpbml0Rmxvd2JpdGUgfSBmcm9tIFwiZmxvd2JpdGVcIjtcbmltcG9ydCB0YWlsd2luZGNzcyBmcm9tIFwidGFpbHdpbmRjc3NcIjtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBidWlsZDoge1xuICAgICAgICByb2xsdXBPcHRpb25zOiB7XG4gICAgICAgICAgICBpbnB1dDoge1xuICAgICAgICAgICAgICAgIGFwcDogXCIuL3Jlc291cmNlcy9qcy9hcHAuanNcIixcbiAgICAgICAgICAgICAgICBjc3M6IFwiLi9yZXNvdXJjZXMvY3NzL2FwcC5jc3NcIixcbiAgICAgICAgICAgICAgICBwdGs6IFwiLi9yZXNvdXJjZXMvanMvcHRrLmpzXCIsXG4gICAgICAgICAgICAgICAgbWFwZWw6IFwiLi9yZXNvdXJjZXMvanMvbWFwZWwuanNcIixcbiAgICAgICAgICAgICAgICBrZWxhczogXCIuL3Jlc291cmNlcy9qcy9rZWxhcy5qc1wiLFxuICAgICAgICAgICAgICAgIGp1cnVzYW46IFwiLi9yZXNvdXJjZXMvanMvanVydXNhbi5qc1wiLFxuICAgICAgICAgICAgICAgIGxhcG9yYW46IFwiLi9yZXNvdXJjZXMvanMvbGFwb3Jhbi5qc1wiLFxuICAgICAgICAgICAgICAgIHNla29sYWg6IFwiLi9yZXNvdXJjZXMvanMvc2Vrb2xhaC5qc1wiLFxuICAgICAgICAgICAgICAgIGNhcGFpYW46IFwiLi9yZXNvdXJjZXMvanMvY2FwYWlhbl9qYW0uanNcIixcbiAgICAgICAgICAgICAgICBhcGk6IFwiLi9yZXNvdXJjZXMvanMvYXBpLmpzXCIsXG4gICAgICAgICAgICAgICAgdG9hc3Q6IFwiLi9yZXNvdXJjZXMvanMvdG9hc3QuanNcIixcbiAgICAgICAgICAgICAgICBtZW5nYWphcjogXCIuL3Jlc291cmNlcy9qcy9tZW5nYWphci5qc1wiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgdGFpbHdpbmRjc3MoKSxcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1wiLi9yZXNvdXJjZXMvY3NzL2FwcC5jc3NcIiwgXCIuL3Jlc291cmNlcy9qcy8qKi8qLmpzXCJdLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgXSxcbiAgICBtb3VudGVkKCkge1xuICAgICAgICBpbml0Rmxvd2JpdGUoKTtcbiAgICB9LFxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQTJRLFNBQVMsb0JBQW9CO0FBQ3hTLE9BQU8sYUFBYTtBQUNwQixTQUFTLG9CQUFvQjtBQUM3QixPQUFPLGlCQUFpQjtBQUV4QixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixPQUFPO0FBQUEsSUFDSCxlQUFlO0FBQUEsTUFDWCxPQUFPO0FBQUEsUUFDSCxLQUFLO0FBQUEsUUFDTCxLQUFLO0FBQUEsUUFDTCxLQUFLO0FBQUEsUUFDTCxPQUFPO0FBQUEsUUFDUCxPQUFPO0FBQUEsUUFDUCxTQUFTO0FBQUEsUUFDVCxTQUFTO0FBQUEsUUFDVCxTQUFTO0FBQUEsUUFDVCxTQUFTO0FBQUEsUUFDVCxLQUFLO0FBQUEsUUFDTCxPQUFPO0FBQUEsUUFDUCxVQUFVO0FBQUEsTUFDZDtBQUFBLElBQ0o7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxZQUFZO0FBQUEsSUFDWixRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMsMkJBQTJCLHdCQUF3QjtBQUFBLE1BQzNELFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxVQUFVO0FBQ04saUJBQWE7QUFBQSxFQUNqQjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
