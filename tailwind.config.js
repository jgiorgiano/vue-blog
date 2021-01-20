module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
    purge: {
        // Learn more on https://tailwindcss.com/docs/controlling-file-size/#removing-unused-css
        // enabled: process.env.NODE_ENV === 'production',
        content: [
            'resources/js/components/**/*.vue',
            'resources/js/components/*.vue',
            'resources/js/views/*.vue',
            'resources/js/views/**/*.vue',
        ]
    },
  theme: {
    extend: {
        /* For A4 size */
        screens: {
            // screen: {'raw': 'screen'},
            print: {'raw': 'print'},
        },
        maxWidth: {
            'a4': '64.609375rem'
        },
        height: {
            'a4': '91.350883rem',
        //     'a4-col': '77.36632rem',
        //     'a4-col-full': '83.350883rem',
        },
    },
  },
  variants: {
      animation: ['hover', 'group-hover']
  },
  plugins: [],
}
