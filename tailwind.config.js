/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.js", "./src/**/*.js", "./templates/**/*.html.twig"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
