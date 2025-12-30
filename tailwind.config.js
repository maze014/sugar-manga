/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{js,php}",
    "./component/*.{js,php}",
    "./restApi/*.js"],
  theme: {
    extend: {
      keyframes: {
        bounce: {
          '0%, 100%': {
            transform: 'translateY(0)',
          },
          '50%': {
            transform: 'translateY(-20%)',
          },
        },
        pulse: {
          '0%, 100%': {
            scale: '100%',
            opacity: '100%'
          },
          '50%': {
            scale: '105%',
            opacity: '100%'
          }
        }
      },
      animation: {
        bounce: 'bounce 1s ease-in-out infinite',
        pulse: 'pulse 1s ease-in-out infinite',
      }
    },
  },
  plugins: [require('tailwind-scrollbar')],
}

