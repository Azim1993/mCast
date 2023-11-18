import { useToast } from 'tailvue';
import { storeToRefs } from "pinia";
import { useAuthStore } from '~/store/authStore';
import HttpStatusCode from "~/service/HttpStatusCode";

export default {
  async interceptor(url: string, method: 'get' | 'POST' | 'put' | 'delete', payload?: any | null) {
    const authStore = useAuthStore()
    const { accessToken } = storeToRefs(authStore);
    return await useFetch(url,
      {
        baseURL: useRuntimeConfig().public.baseURL,
        body: method !== 'get' ? payload : undefined,
        params: method === 'get' ? payload :  undefined,
        method: method,
        headers: {
            Accept: 'application/json',
            // 'Content-Type': 'application/json',
            Authorization: accessToken.value ? 'Bearer ' + accessToken.value : null
        },
        onRequestError: ({ error }) => {
            console.log("🚀 ~ file: ApiClient.ts:28 ~ interceptor ~ onRequestError:", error)
        },
        onResponseError: ({ request, response, options }) => {
          const toast = useToast()
          if (response.status === HttpStatusCode.UNPROCESSABLE_ENTITY) {
            toast.warning(response._data.message)
            return response._data.errors
          }

          useToast({theme: 'white'}).danger(response._data.message)
          if (response.status === HttpStatusCode.UNAUTHORIZED) {
            authStore.resetAuthStateToken()
            navigateTo('login')
          }
        },
        onResponse({ request, response, options }) {
            return response._data
        },
    });
  },

  get(url: string, payload?: any | null) {
    return this.interceptor(url, 'get', payload);
  },

  post(url: string, payload?: any | null) {
    return this.interceptor(url, 'POST', payload);
  },

  put(url: string, payload?: any | null) {
    return this.interceptor(url, 'put', payload);
  },

  delete(url: string, payload?: any | null) {
    return this.interceptor(url, 'delete', payload);
  }
}
