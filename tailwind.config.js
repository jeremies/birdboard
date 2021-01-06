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
                'blue': '#47cdff',
                'error': 'var(--text-error-color)'
            },
            textColor: {
                'default': 'var(--text-default-color)'
            },
            backgroundColor: {
                'page': 'var(--page-background-color)',
                'card': 'var(--card-background-color)',
                'button': 'var(--button-background-color)',
                'header': 'var(--header-background-color)'
            }
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
