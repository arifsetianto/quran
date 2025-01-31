/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                gold: {
                    300: '#B9AA8DFF',
                    400: '#B89E6F',
                    950: '#B89E6F',
                }
            }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

