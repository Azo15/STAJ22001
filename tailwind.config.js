import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    500: '#0ea5e9', // Sky-500
                    600: '#0284c7',
                    700: '#0369a1',
                },
                secondary: {
                    50: '#fdf4ff',
                    100: '#fae8ff',
                    500: '#d946ef', // Fuchsia-500
                    600: '#c026d3',
                },
                dark: {
                    800: '#1e1b4b', // Indigo-950 like
                    900: '#0f172a', // Slate-900
                }
            }
        },
    },

    plugins: [forms],
};
