import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.jsx',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                'welcome': 'rgba(22, 49, 114, 0.7)',
                'sidebar': '#163172',
                'darken' : 'rgba(0, 0, 0, 0.4)',
            }
        },
    },
    plugins: [],
};
