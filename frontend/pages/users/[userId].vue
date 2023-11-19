<script lang="ts" setup>
import { useUserStore } from '~/store/userStore';

const userStore = useUserStore()
const route = useRoute()

const {isLoading, user} = storeToRefs(userStore)
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
            <div class="flex justify-start w-full border-b pb-4 mb-4">
                <div v-if="!user.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg"></div>
                <img v-else :src="user.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg" />
                <div class="">
                    <h3 class="font-bold text-lg">{{ user.first_name + ' '+ user.last_name }}</h3>
                    <p class="text-gray-600"><span class="text-secondary">@</span>{{ user.user_name }}</p>
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
