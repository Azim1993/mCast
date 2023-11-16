// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  build: {
    transpile: ['@vee-validate/rules']
  },
  runtimeConfig: {
    public: {
        baseURL: process.env.BASE_URL
    }
  },
  modules: [
    '@pinia/nuxt',
    '@vee-validate/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@tailvue/nuxt',
  ]
})
