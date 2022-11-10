export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'client',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  axios: {
    // proxy: true,
    credentials: true,
  // baseURL: 'http://localhost:8000/api'
  },

  auth: {
    strategies: {
      laravelSanctum: {
        provider: 'laravel/sanctum',
        url: 'http://localhost:8000',
        endpoints: {
          login: {
            url:'/api/login',
            method: 'post'
          },
          logout: {
            url:'/api/logout',
            method: 'post'
          }
        }
      }
    },
    cookie: {
      cookie: {
        name: 'XSRF-TOKEN',
      },
    },
    redirect: {
      login: "/login",
      logout: "/",
      home: "/dashboard"
    }
  },

  router: {
    middleware: ['auth'],
  },


  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'vue-toastification/nuxt',

    ["vue-toastification/nuxt", {
      timeout: 1000,
      draggable: false
    }]
  ],

  toast: {
    // Vue Toastification plugin options
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
