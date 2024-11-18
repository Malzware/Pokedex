/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,ts}", 
  ],
  theme: {
    extend: {
      fontFamily: {
        courgette: ['Courgette', 'cursive'],
      },
    },
  },
  plugins: [
    require('daisyui'),
  ],
}
