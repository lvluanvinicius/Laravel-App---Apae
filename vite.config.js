import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react-refresh";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/photo-gallery/photo-gallery.js",
                "resources/js/contact/contact.js",
                "resources/css/mails/complaints.css",
                "resources/css/app.css",
                "resources/css/website.css",
                "resources/css/login.css",
                "resources/css/app-mobile.css",
                "resources/js/app.js",
                "resources/js/website.js",
            ],
            refresh: true,
        }),
        react(),
    ],
});
