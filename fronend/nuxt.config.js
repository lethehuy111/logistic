export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'fronend',
    mode: 'universal',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1'},
      {hid: 'description', name: 'description', content: ''},
      {name: 'format-detection', content: 'telephone=no'}
    ],
    link: [
      {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    {
      src: '~/node_modules/bootstrap/dist/css/bootstrap.min.css',
    },
    {
      src: '~/assets/css/common.css'
    }
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: "~/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js", mode: "client" },
    {
      src: '~/plugins/vue-star-rating.js',
      mode: 'client'
    }, {src: "~/plugins/jquery.js", mode: "client"}, {src: "~/plugins/vue-js-modal.js", mode: "client"}], router: {
    middleware: 'auth'
  },
  auth: {
      strategies: {
      local: {
        endpoints: {
          login: { url: '/login', method: 'post', propertyName: 'authorisation.token'},
          user: { url: '/user', method: 'get', propertyName: 'result' },
          logout: { url: '/logout', method: 'post'}
        }
      }
    },
    localStorage: {

    }
  },
  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxtjs/fontawesome'
  ],

  fontawesome: {
    icons: {
      solid: true,
      brands: true
    }
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    'vue-sweetalert2/nuxt'
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
