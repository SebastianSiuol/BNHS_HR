/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
        fontFamily: {
            'poppins' : ['Poppins', 'sans-serif' ],
        },
        colors: {
            'welcome-form-bg' : 'rgba(22, 49, 114, 0.7)',
        }
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

