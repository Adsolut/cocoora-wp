/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './theme/cocoora-theme/**/*.php',
    './src/**/*.{js,css}',
  ],
  theme: {
    extend: {
      colors: {
        'cocoora-blue': '#008ECF',
        'cocoora-navy': '#102D69',
        'cocoora-light': '#F5F7FA',
      },
      fontFamily: {
        sans: ['Arial', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      },
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          sm: '2rem',
          lg: '4rem',
          xl: '5rem',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
