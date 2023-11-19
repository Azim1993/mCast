import {loginParamsType, UserInfo, registerParamsType} from '~/types/authTypes'
import ApiClient from '~/service/ApiClient';
import { useToast } from 'tailvue';

export const useAuthStore = defineStore('useAuthStore', () => {
    const accessToken: Ref<string | ''> = ref('')
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
        navigateTo('/home');
    };

    const handleRegistration = async (userInfoParams: registerParamsType, actions: any) => {
        isLoading.value = true;
        const { data } = await ApiClient.post('/register', userInfoParams);
        if (process.client) {
            useToast().success(data.value.message)
        }
        userInfo.value = data.value.data.user
        accessToken.value = data.value.data.access.bearerToken
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
        resetAuthStateToken
    }
},
{
    persist: {
        storage: persistedState.cookiesWithOptions({
          sameSite: 'strict',
        }),
    },
})