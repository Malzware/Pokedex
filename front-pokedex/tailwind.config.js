/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,ts}", // Vérifiez que tous les chemins sont bien inclus
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
