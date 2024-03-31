import laravel from 'laravel-vite-plugin';
import { colors } from './styles';

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './node_modules/flowbite/**/*.js',
    'resources/blog/src/**/*.{js,ts,jsx,tsx}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      backgroundImage: {
        'header-linear':
          'linear-gradient(0deg, rgba(40,167,69,1) 37%, rgba(0,240,27,1) 100%)',
      },
      boxShadow: {
        'card-default': '0 0 13px rgba(0,0,0,0.6)',
      },
      base: {
        // Aplica o estilo para todos os elementos em foco
        '*:focus': {
          outline: 'none!important',
        },
      },
    },
    colors: {
      ...colors,
    },
  },
  plugins: [
    laravel(['resources/css/app.css', 'resources/js/app.js']),
    require('flowbite/plugin'),
  ],
};
