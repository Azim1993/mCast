import ApiClient from "~/service/ApiClient"

export const useUserStore = defineStore('useUserStore', () => {
    const users = ref([])
    const isLoading = ref(false)
    const isSearchLoading = ref(false)
    const user = ref({})

    const fetchUsers = async (userInfo?: string) => {
        isSearchLoading.value = true
        const {data} = await ApiClient.get('/users', {user_info: userInfo})
        isSearchLoading.value = false
        users.value = data.value.data?.data
    }

    const fetchUser = async (userId?: bigint) => {
        isLoading.value = true
        const {data} = await ApiClient.get('/users/' + userId)
        console.log("🚀 ~ file: userStore.ts:9 ~ fetchUsers ~ data:", data)
        isLoading.value = false
        user.value = data.value.data
    }

    return {
        users,
        user,
        isLoading,
        isSearchLoading,
        fetchUsers,
        fetchUser
    }
})