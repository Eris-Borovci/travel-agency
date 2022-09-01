/** @type {import('tailwindcss').Config} */

module.exports = {
    plugins: [require("flowbite/plugin")],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "shadow-2xl",
        "text-gray-200",
        "text-gray-400",
        "fill-blue-600",
        "animate-spin",
        "px-3",
        "absolute",
        "peer",
        "overflow-y-hidden",
        "animate-wiggle",
        "peer-checked:border",
        "peer-checked:border-blue-600",
        "border-gray-400",
        "p-2",
        "text-sm",
        "scale-110",
        "!text-blue-600",
        "!border-blue-600",
    ],
    theme: {
        colors: {
            primary: "#62b7fc",
            "primary-darker": "#1f98fa",
            secondary: "#febb02",
        },
        extend: {
            zIndex: {
                999: "999",
            },
        },
    },
};
