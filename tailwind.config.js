/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './theme/cocoora-theme/**/*.php',
    './src/**/*.{js,css}',
  ],
  theme: {
    extend: {
      colors: {
        // Primary colors (from Figma)
        'cocoora-blue': '#008ECF',
        'cocoora-navy': '#102D69',
        'cocoora-dark-blue': '#143DD7',
        // Accent colors (from Figma)
        'cocoora-light-blue': '#2CB9FF',
        'cocoora-cyan': '#89E9FF',
        'cocoora-sky': '#C0E9FF',
        'cocoora-lavender': '#D0C9FD',
        'cocoora-light-lavender': '#E4E1FE',
        // Neutral
        'cocoora-light': '#EDF1FC',
      },
      fontFamily: {
        heading: ['Syne', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
        sans: ['"DM Sans"', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
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
