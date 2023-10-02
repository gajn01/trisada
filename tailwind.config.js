import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './src/**/*.{html,js}',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary' : '#FCF9F6' ,
                'secondary' : '#FFEFD4' ,
                'accent' : '#e0b444' ,
                'cta' : '#790000' ,
                'background' : '#faf2e4' ,
            },
        },
    },

    plugins: [forms],
};
