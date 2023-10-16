import laravel from "laravel-vite-plugin";

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {},
    colors: {
      "apae-yellow": "#ffc107",
      "apae-green": "#28a745",
      "apae-teal": "#20c997",
      "apae-cyan": "#17a2b8",
      "apae-white": "#fff",
      "apae-gray": "#6c757d",
      "apae-gray-dark": "#343a40",
      "apae-primary": "#007bff",
      "apae-secondary": "#6c757d",
      "apae-success": "#28a745",
      "apae-info": "#17a2b8",
      "apae-warning": "#ffc107",
      "apae-danger": "#dc3545",
      "apae-light": "#f8f9fa",
      "apae-dark": "#343a40",
      "apae-back-light": "#e8eff9"
    } 
  },
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.js',
    ]),
  ],
}