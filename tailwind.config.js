/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "dm-sans": ["DM Sans", "sans-serif"],
            },
            colors: {
                "main-blue": "#6172F3",
                "text-black": "#1E1E1",
                "text-light": "#667085",
                ice: "#F1FBFF",
            },
        },
    },
    plugins: [],
};
