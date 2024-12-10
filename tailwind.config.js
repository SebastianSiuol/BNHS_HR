import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.jsx", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                welcome: "rgba(22, 49, 114, 0.7)",
                sidebar: "#163172",
                darken: "rgba(0, 0, 0, 0.4)",
            },
            keyframes: {
                wave: {
                    "0%": { transform: "rotate(0deg)" },
                    "20%": { transform: "rotate(20deg)" },
                    "40%": { transform: "rotate(-15deg)" },
                    "60%": { transform: "rotate(10deg)" },
                    "80%": { transform: "rotate(-10deg)" },
                    "100%": { transform: "rotate(0deg)" },
                },
            },
            animation: {
                wave: 'wave 1.5s ease-in-out 1s',
            },
        },
    },
    plugins: [],
};
