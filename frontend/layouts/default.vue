<script setup lang="ts">
import { XCircleIcon } from "@heroicons/vue/24/outline"

</script>

<template>
<div class="bg-light min-h-screen">
    <nav class="bg-white p-4 drop-shadow">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex justify-start">
                <div class="text-2xl font-bold text-secondary">M-Cast</div>
                    <div class="relative ml-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                    <input type="text" placeholder="Search" class="w-80 h-10 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-light">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                        <XCircleIcon class="w-6 h-6" />
                    </button>
                </div>
            </div>
            <div class="">
                <form action="">
                    <button type="submit" class="font-semibold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4 flex">

        <!-- Sidebar -->
        <div class="w-1/4 pr-4">
            <div class="bg-white p-4 mb-4 rounded shadow">
                <div class="flex justify-start w-full border-b pb-4">
                    <div class="w-12 h-12 mr-4 bg-gray-300 rounded-lg"></div>
                    <div class="">
                        <h3 class="font-bold text-lg">John Doe</h3>
                        <p class="text-gray-600"><span class="text-secondary">@</span>johndoe</p>
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