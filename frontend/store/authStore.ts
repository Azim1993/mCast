import {loginParamsType, UserInfo, registerParamsType} from '~/types/authTypes'
import ApiClient from '~/service/ApiClient';
import { useToast } from 'tailvue';

export const useAuthStore = defineStore('useAuthStore', () => {
    const accessToken: Ref<string | ''> = ref('')
    const refreshToken: Ref<string | ''> = ref('')
    const userInfo: Ref<UserInfo | {}> = ref({})
    const isLoading: Ref<Boolean | false> = ref(false);

    const handleLogin = async (loginInfo: loginParamsType, actions: any) => {
        isLoading.value = true;
        const { data } = await ApiClient.post('/login', loginInfo);
        isLoading.value = false
        if (process.client) {
            useToast().success(data.value.message)
        }
        userInfo.value = data.value.data.user
        accessToken.value = data.value.data.access.bearerToken
        refreshToken.value = data.value.data.access.refreshToken
        navigateTo('/home');
    };

    const handleRefreshToken = async () => {
        if (!refreshToken.value) {
            console.error('===| No refresh token found |===')
            rerturn ;
        }

        try {
            const {data} = await useFetch(`${useRuntimeConfig().public.baseURL}/refresh/token`, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + refreshToken.value
                },
            })
            userInfo.value = data.value.data.user
            accessToken.value = data.value.data.access.bearerToken
            refreshToken.value = data.value.data.access.refreshToken
        }
        catch (refreshError) {
            console.error('Token refresh failed', refreshError);
            if (process.client) {
                useToast().warning('UnAuthorized')
            }
            resetAuthStateToken()
            navigateTo('/login')
        }
    }

    const handleRegistration = async (userInfoParams: registerParamsType, actions: any) => {
        isLoading.value = true;
        const { data } = await ApiClient.post('/register', userInfoParams);
        if (process.client) {
            useToast().success(data.value.message)
        }
        userInfo.value = data.value.data.user
        accessToken.value = data.value.data.access.bearerToken
        refreshToken.value = data.value.data.access.refreshToken
        isLoading.value = false;
        navigateTo('/home');
    };

    const handleLogout = async (actions: any) => {
        isLoading.value = true;
        const { data } = await ApiClient.delete('/logout');
        if (process.client) {
            useToast().success(data.value.message)
        }
        userInfo.value = {}
        accessToken.value = ''
        isLoading.value = false;
        navigateTo('/login');
    };

    const resetAuthStateToken = () => {
        userInfo.value = {}
        accessToken.value = ''
        isLoading.value = false
    }
    return {
        handleLogin,
        accessToken,
        isLoading,
        handleRegistration,
        handleLogout,
        userInfo,
        resetAuthStateToken,
        handleRefreshToken
    }
},
{
    persist: {
        storage: persistedState.cookiesWithOptions({
          sameSite: 'strict',
        }),
    },
})