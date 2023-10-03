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
                'primary' : '#FBB03B' ,
                'secondary' : '#F7C843' ,
                'accent' : '#E7E7E7' ,
                'cta' : '#FFFFFF' ,
                'background' : '#FBB03B' ,
                'link ' :'#1565C0',

            },
        },
    },

    plugins: [forms],
};
