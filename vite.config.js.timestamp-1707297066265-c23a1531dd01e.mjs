// vite.config.js
import { defineConfig } from "file:///home/luan/Laravel-App-Apae/node_modules/vite/dist/node/index.js";
import laravel from "file:///home/luan/Laravel-App-Apae/node_modules/laravel-vite-plugin/dist/index.mjs";
import react from "file:///home/luan/Laravel-App-Apae/node_modules/@vitejs/plugin-react-refresh/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/js/photo-gallery/photo-gallery.js",
        "resources/js/contact/contact.js",
        "resources/css/mails/complaints.css",
        "resources/sass/app.scss",
        "resources/js/app.js"
      ],
      refresh: true
    }),
    react()
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvaG9tZS9sdWFuL0xhcmF2ZWwtQXBwLUFwYWVcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIi9ob21lL2x1YW4vTGFyYXZlbC1BcHAtQXBhZS92aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vaG9tZS9sdWFuL0xhcmF2ZWwtQXBwLUFwYWUvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tIFwidml0ZVwiO1xuaW1wb3J0IGxhcmF2ZWwgZnJvbSBcImxhcmF2ZWwtdml0ZS1wbHVnaW5cIjtcbmltcG9ydCByZWFjdCBmcm9tIFwiQHZpdGVqcy9wbHVnaW4tcmVhY3QtcmVmcmVzaFwiO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL3Bob3RvLWdhbGxlcnkvcGhvdG8tZ2FsbGVyeS5qc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL2NvbnRhY3QvY29udGFjdC5qc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2Nzcy9tYWlscy9jb21wbGFpbnRzLmNzc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3NcIixcbiAgICAgICAgICAgICAgICBcInJlc291cmNlcy9qcy9hcHAuanNcIixcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgcmVhY3QoKSxcbiAgICBdLFxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQW1RLFNBQVMsb0JBQW9CO0FBQ2hTLE9BQU8sYUFBYTtBQUNwQixPQUFPLFdBQVc7QUFFbEIsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTztBQUFBLFFBQ0g7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsTUFDSjtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLElBQ0QsTUFBTTtBQUFBLEVBQ1Y7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
