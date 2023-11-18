<script setup lang="ts">
import LogoutFormVue from "~/components/Auth/LogoutForm.vue";
import MainSearch from '~/components/MainSearch.vue'
import { useAuthStore } from "~/store/authStore"

const authStore = useAuthStore()
const {userInfo} = storeToRefs(authStore)
</script>

<template>
<div class="bg-light min-h-screen">
    <nav class="bg-white p-4 drop-shadow">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex justify-start">
                <h1 class="text-2xl font-bold text-secondary">M-Cast</h1>
                <ClientOnly>
                    <MainSearch />
                </ClientOnly>
            </div>
            <div class="">
                <LogoutFormVue />
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4 flex">

        <!-- Sidebar -->
        <div class="w-1/4 pr-4">
            <div class="bg-white p-4 mb-4 rounded shadow">
                <div class="flex justify-start w-full border-b pb-4">
                    <div v-if="!userInfo.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg"></div>
                    <img v-else :src="userInfo.profile_pic" class="w-12 h-12 mr-4 bg-gray-300 rounded-lg" />
                    <div class="">
                        <h3 class="font-bold text-lg">{{ userInfo.first_name + ' '+ userInfo.last_name }}</h3>
                        <p class="text-gray-600"><span class="text-secondary">@</span>{{ userInfo.user_name }}</p>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li class="my-2"><NuxtLink class="font-base text-lg py-2" to="/home">Home</NuxtLink></li>
                        <li class="my-2"><NuxtLink class="font-base text-lg py-2" to="/profile">My Profile</NuxtLink></li>
                        <li class="my-2"><NuxtLink class="font-base text-lg py-2" to="/notifications">Notifications</NuxtLink></li>
                        <li class="my-2"><NuxtLink class="font-base text-lg py-2" to="/followers">Followers</NuxtLink></li>
                    </ul>
                </nav>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Trending</h2>
                <ul>
                    <li class="mb-2"><a href="#" class="text-blue-500">#TailwindCSS</a></li>
                    <li class="mb-2"><a href="#" class="text-blue-500">#WebDevelopment</a></li>
                </ul>
            </div>
        </div>

        <main class="w-1/2 p-4 bg-white rounded shadow">
            <slot />
        </main>

        <!-- Additional Sidebar or Other Content -->
        <div class="w-1/4 p-4">
            <!-- Additional Content -->
        </div>

    </div>
</div>
</template>