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
            fontFamily: {
                sans: ['League Spartan', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'light-gray': '#F8F8FB',
                'dark-gray': '#494E6E',
                'border-gray': '#DFE3FA',
                'light-purple': '#7E88C3',
                'purple': '#7C5DFA',
                'black': '#0C0E16',
                'blue': '#373B53',
                'light-blue': '#7E88C3',
                'red': '#EC5757',
                'green': '#33D69F',
                'orange': '#FF8F00',
            },
        },
    },

    plugins: [forms],
}
