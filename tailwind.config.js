import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      colors: {
        blue: {
          500: '#7E88C3',
          800: '#252945',
        },
        gray: {
          100: '#F8F8FB',
          400: '#DFE3FA',
          500: '#888EB0',
          900: '#1E2139',
        },
        purple: {
          400: '#9277FF',
          500: '#7C5DFA',
        },
        red: {
          400: '#9277FF',
          500: '#EC5757',
        },
      },
      fontFamily: {
        sans: ['League Spartan', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
}
