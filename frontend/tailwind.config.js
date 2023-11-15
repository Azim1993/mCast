/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            raleway: 'Raleway',
        },
        colors: {
            primary: '#006d77',
            'primary-light': '#83c5be',
            secondary: '#e29578',
            'secondary-light': '#ffddd2',
            'secondary-dark': '#c36744',
            light: '#edf6f9'
        },
        fontSize: {
            'xs': '.75rem',   // Extra Small
            'sm': '.875rem',  // Small
            'base': '1rem',   // Base
            'lg': '1.125rem', // Large
            'xl': '1.25rem',  // Extra Large
            '2xl': '1.5rem',  // 2 Extra Large
            '3xl': '1.875rem',// 3 Extra Large
            '4xl': '2.25rem', // 4 Extra Large
            '5xl': '3rem',    // 5 Extra Large
            '6xl': '4rem',    // 6 Extra Large
          },
    },
  },
  plugins: [],
}

