/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ], daisyui: {
    themes: [
      {
        duafe: {
          "primary": "#B41D1D",
          "primary-content" : "#F16868",
          "secondary": "#0F7173",
          "secondary-content" : "#3E9595",
          "accent": "#B41D1D",
          "accent-content": "#262626",
          "neutral": "#262626",
          "neutral-content": "#F7F7FF",
          "base-100": "#F7F7FF",
          "base-200": "#646779",
          "base-300": "#474A59",
          "base-content": "#F7F7FF",
        },
      },
      "light",
      "dark",
      "retro"],
  },
}

