module.exports = {
    content: [
        // https://tailwindcss.com/docs/content-configuration
        './*.php',
        './inc/**/*.php',
        './templates/**/*.php',
        './safelist.txt',
        './**/*.ts',
        './**/*.scss',
        //'./**/*.php', // recursive search for *.php (be aware on every file change it will go even through /node_modules which can be slow, read doc)
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                'primary': ['var(--font-primary)', 'sans-serif'],
                'header': ['var(--font-header)', 'sans-serif'],
            },
            colors: {

            },
        },
        screens: {
            'sm': '576px',
            'md': '768px',
            'lg': '992px',
            'xl': '1200px',
            '2xl': '1400px',
        }
    },
    plugins: []
}