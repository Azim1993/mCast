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
        // @ts-ignore
        headers: {
            Accept: 'application/json',
            // 'Content-Type': 'application/json',
            Authorization: accessToken.value ? 'Bearer ' + accessToken.value : null
        },
        onResponseError: ({ request, response, options }) => {
          const toast = useToast()
          if (response.status === HttpStatusCode.UNPROCESSABLE_ENTITY) {
            toast.warning(response._data.message)
            return Promise.reject(response._data.errors)
          }

          if (response.status === HttpStatusCode.UNAUTHORIZED) {
              return authStore.handleRefreshToken()
          }
        },
        onResponse({ request, response, options }) {
            return Promise.resolve(response._data)
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
