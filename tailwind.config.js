/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

module.exports = {
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
    "overflow-y-hidden"
  ],
  theme: {
    colors:{
      "primary": "#62b7fc",
      "primary-darker": "#1f98fa",
      "secondary": "#febb02"
    },
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}