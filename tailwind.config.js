const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    './app/**/*.php',
    './resources/**/*.{html,blade.php,js,jsx,ts,tsx,php,vue,twig}',
    './public/index.html',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
