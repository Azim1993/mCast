<script lang="ts" setup>
import { XCircleIcon } from "@heroicons/vue/24/outline"
import {useUserStore} from "~/store/userStore"

const searchValue = ref('')
const userStore = useUserStore()
const {isSearchLoading, users}  = storeToRefs(userStore);

const onClickAway = () => {
    searchValue.value = ''
    users.value = []
}

const handleUserSearch = () => {
    userStore.fetchUsers(searchValue.value)
}

</script>

<template>
    <div class="relative ml-10" v-click-away="onClickAway">

        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input v-model="searchValue" @keyup="handleUserSearch" type="text" placeholder="Click Enter" class="w-80 h-10 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-light">
            <button v-if="searchValue" @click="searchValue = ''" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary focus:outline-none">
                <XCircleIcon class="w-6 h-6" />
            </button>
        </div>
            
        <div v-if="searchValue" class="bg-white py-4 border rounded absolute left-0 w-full">
            <div v-if="isSearchLoading" class="w-full flex justify-center items-center">
                <img class="w-8" src="/images/rolling.svg" alt="rolling" />
            </div>
            <template v-else-if="users.length > 0 && !isSearchLoading">
                <NuxtLink v-for="user in users"
                    :key="user.id" 
                    :to="`/users/${user.id}`"
                    @click.prevent="searchValue = ''"
                    class="flex justify-start w-full border-b last:border-b-0 px-4 py-2">
                    <div v-if="!user.profile_pic" class="w-10 h-10 mr-4 bg-gray-300 rounded-lg"></div>
                    <img v-else :src="user.profile_pic" class="w-10 h-10 mr-4 bg-gray-300 rounded-lg" />
                    <div class="">
                        <h3 class="font-bold text-sm m-0">{{ user.first_name + ' ' + user.last_name }}</h3>
                        <p class="text-gray-600 font-extralight text-xs"><span class="text-secondary">@</span>{{ user.user_name }}</p>
                    </div>
                </NuxtLink>
            </template>
            <p v-else class="px-4">No users found</p>
        </div>
    </div>
</template>

<style scoped></style>
