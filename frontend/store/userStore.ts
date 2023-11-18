import ApiClient from "~/service/ApiClient"

export const useUserStore = defineStore('useUserStore', () => {
    const users = ref([])
    const isLoading = ref(false)

    const fetchUsers = async (userInfo?: string) => {
        isLoading.value = true
        const {data} = await ApiClient.get('/users', {user_info: userInfo})
        console.log("🚀 ~ file: userStore.ts:9 ~ fetchUsers ~ data:", data)
        isLoading.value = false
        users.value = data.value.data?.data
    }

    return {
        users,
        isLoading,
        fetchUsers
    }
})