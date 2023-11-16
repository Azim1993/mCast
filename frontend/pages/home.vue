<script lang="ts" setup>
import { GlobeAltIcon, CameraIcon, CheckIcon, UsersIcon, UserMinusIcon } from "@heroicons/vue/24/outline"
import CreateForm from "~/components/Timeline/CreateForm.vue"
definePageMeta({
  middleware: 'auth'
})


onMounted(() => {
})

</script>

<template>
  <div>
    <CreateForm />

    <div class="">
        <div v-for="n in 20" :key="n" class="border-b border-gray-300 pb-4 mb-4 flex justify-start w-full">
            <!-- User Avatar -->
            <div class="w-10 h-10 bg-gray-300 rounded-lg mb-2"></div>
            <!-- Tweet Content -->
            <div class="ml-3 w-full">
                <div class="flex justify-start">
                    <h3 class="font-bold mb-0">John Doe</h3>
                    <p class="text-gray-600 mb-0 ml-3">@johndoe - 2h ago</p>
                </div>
                <div class="mt">
                    <p>This is an example tweet. #TailwindCSS #TwitterClone</p>
                    <img class="w-full rounded my-1" src="https://picsum.photos/seed/picsum/700" alt="">
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped></style>
