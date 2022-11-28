module.exports = {
  plugins: {
    'postcss-import': {},
    'tailwindcss': {},
    "autoprefixer": {},
    'postcss-nested': {},
    ...(process.env.NODE_ENV === 'production' ? { 'cssnano': {} } : {})
  }
}