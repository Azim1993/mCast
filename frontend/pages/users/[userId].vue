<script lang="ts" setup>
import { useUserStore } from '~/store/userStore'
import { useToast } from 'tailvue'

const userStore = useUserStore()
const route = useRoute()
const toast = process.client ? useToast() : {}
const showFollowingText = ref(true)

const {isLoading, user, isFollowToggleLoading} = storeToRefs(userStore)
const {handleFollow, handleUnFollow} = userStore

const handleFollowAction = (userId: any) => {
    handleFollow(userId).then((response) => {
        if (process.client) {
            toast.success(response.message) 
        }
    })
}
const handleUnFollowAction = (userId: any) => {
    handleUnFollow(userId).then((response) => {
        if (process.client) {
            toast.success(response.message) 
        }
    })
}
onMounted(() => {
    nextTick(() => {
        userStore.fetchUser(route.params?.userId)
    })
})
</script>

<template>
    <div>
        <div v-if="isLoading" class="w-full flex justify-center items-center mt-12">
            <img class="w-10" src="/images/rolling.svg" alt="rolling" />
        </div>
        <template v-else>
            <div class="flex justify-between w-full border-b pb-4 mb-4">
               <div class="flex justify-start">
                    <div v-if="!user.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg"></div>
                    <img v-else :src="user.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg" />
                    <div class="">
                        <h3 class="font-bold text-lg">{{ user.first_name + ' '+ user.last_name }}</h3>
                        <p class="text-gray-600"><span class="text-secondary">@</span>{{ user.user_name }}</p>
                    </div>
               </div>
               <div class="">
                    <button v-if="!user.is_following"
                        :disabled="isFollowToggleLoading"
                        @click="handleFollowAction(user.id)"
                        class="bg-secondary py-2 px-4 text-white rounded-lg font-bold border border-secondary-dark hover:bg-secondary-dark disable:opacity-75"
                        >Follow</button>
                    <button v-else
                        :disabled="isFollowToggleLoading"
                        @click="handleUnFollowAction(user.id)"
                        @mouseenter="showFollowingText = false"
                        @mouseleave="showFollowingText = true"
                        class="bg-white py-2 px-4 text-secondary-dark rounded-lg font-bold border border-secondary-dark hover:bg-red-600 hover:text-white  hover:bg-red-600 hover:border-red-700 disable:opacity-75"
                    > {{ showFollowingText ? 'Following' : 'UnFollow' }} </button>
               </div>
            </div>
            <p><strong>Email: </strong> {{  user.email }}</p>
            <p><strong>Bio: </strong> N/A</p>
            <div class="grid grid-cols-2 gap-3 mt-6">
                <div class="bg-light rounded-lg shadow-lg p-5">
                    <h2 class="text-4xl font-bold mb-2">{{ user.total_followers }}</h2>
                    <p class="text-gray-600 text-sm uppercase">Followers</p>
                </div>
                <div class="bg-light rounded-lg shadow-lg p-5">
                    <h2 class="text-4xl font-bold mb-2">{{ user.total_following }}</h2>
                    <p class="text-gray-600 text-sm uppercase">Following</p>
                </div>
            </div>
        </template>
    </div>
</template>

<style scoped></style>
