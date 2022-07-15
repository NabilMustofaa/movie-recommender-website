module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resourcer/**/**/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],

}
