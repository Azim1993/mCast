
import {useAuthStore} from '~/store/authStore'
export default defineNuxtRouteMiddleware((to, from) => {
    const {accessToken} = storeToRefs(useAuthStore())

    if (!accessToken.value) {
        return navigateTo('/login')
    }
})
