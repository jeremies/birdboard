module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            boxShadow: {
                DEFAULT: '0 0 5px 0 rgba(0,0,0,0.8)'
            },
            colors: {
                'grey-light': '#F5F6F9',
                'blue': '#47cdff'
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
