import { useToast } from 'tailvue';
import { storeToRefs } from "pinia";
import { useAuthStore } from '~/store/authStore';
import HttpStatusCode from "~/service/HttpStatusCode";

export default {
  interceptor(url: string, method: 'get' | 'post' | 'put' | 'delete', payload?: any | null) {
    return useFetch(url,
      {
        baseURL: useRuntimeConfig().public.baseURL,
        body: method !== 'get' ? payload : undefined,
        params: method === 'get' ? payload :  undefined,
        method,
        onRequest: async ({ request, options }) => {
          const { accessToken } = storeToRefs(useAuthStore());
          options.headers = {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            Authorization: accessToken.value ? 'Bearer ' + accessToken.value : null
          }
          // @ts-ignore
          options = { ...options }
        },
        onRequestError: ({ error }) => console.error(error),
        onResponseError: ({ request, response, options }) => {
          const toast = useToast()
          console.debug(response)
          if (response.status === HttpStatusCode.UNPROCESSABLE_ENTITY) {
            // @ts-ignore
            toast.warning(response._data.message)
            // @ts-ignore
            return response
          }
          // @ts-ignore
          useToast({theme: 'white'}).danger(response._data.message)
          if (response.status === HttpStatusCode.UNAUTHORIZED) {
            navigateTo('login')
          }
        }
      });
  },

  async get(url: string, payload?: any | null) {
    return await this.interceptor(url, 'get', payload);
  },

  post(url: string, payload?: any | null) {
    return this.interceptor(url, 'post', payload);
  },

  put(url: string, payload?: any | null) {
    return this.interceptor(url, 'put', payload);
  },

  delete(url: string, payload?: any | null) {
    return this.interceptor(url, 'delete', payload);
  }
}
