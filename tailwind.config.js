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
    extend: {},
  },
  variants: {
      animation: ['hover']
  },
  plugins: [],
}
