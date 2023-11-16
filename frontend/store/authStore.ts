

export const useAuthStore = defineStore('useAuthStore', () => {
    const accessToken: Ref<string | ''> = ref('');

},
{
    persist: {
        paths: ['accessToken'],
            storage: persistedState.cookiesWithOptions({
                sameSite: 'strict'
            })
        }
    }
)