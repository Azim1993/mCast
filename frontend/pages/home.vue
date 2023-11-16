<script lang="ts" setup>
import { GlobeAltIcon, CameraIcon, CheckIcon, UsersIcon, UserMinusIcon } from "@heroicons/vue/24/outline"

definePageMeta({
  middleware: 'auth'
})

const imageUrls = ref([])
const showPrivacyDropper = ref(false)
const onClickAway = () => showPrivacyDropper.value = false
const handleUploadedMedias = (event: { target: { files: any } }) => {
    const files = event.target.files
    if (files.length === 0) return
    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        const reader = new FileReader()
        reader.onload = (e) => {
          imageUrls.value.push(e.target.result)
        }
        reader.readAsDataURL(file)
    }
}
onMounted(() => {
})

</script>

<template>
  <div>
    <div class="mb-4 text-center">
        <textarea class="p-4 h-24 w-full border border-gray-200 rounded-t" placeholder="What is happening Now?"></textarea>
        <div class="border -mt-2 border-gray-200 border-t-0 py-2 pt-3 px-5 w-full text-center rounded-b-lg">
            <div class="flex justify-start">
                <ClientOnly>
                    <div class="relative" v-click-away="onClickAway">
                        <a href="#" @click.prevent="showPrivacyDropper = !showPrivacyDropper" class="flex justify-start rounded-xl px-3 py-1 mr-2 hover:bg-secondary-light text-secondary-dark cursor-pointer">
                            <GlobeAltIcon class="w-6 h-6" />
                            <span>Everyone can view</span>
                        </a>
                        <div v-if="showPrivacyDropper" class="py-4 rounded-xl border absolute text-left bg-white w-96">
                            <h4 class="font-semibold px-4">Who can Preview?</h4>
                            <p class="font-extralight px-4">Choose who can preview to this post. Anyone mentioned can always reply.</p>
                            <ul>
                                <li>
                                    <a href="" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                        <div class="flex justify-start items-center">
                                            <GlobeAltIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                            <p class="font-bold ml-2">Everyone</p>
                                        </div>
                                        <CheckIcon class="text-secondary-dark w-6 h-6" />
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                        <div class="flex justify-start items-center">
                                            <UsersIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                            <p class="font-bold ml-2">Followers</p>
                                        </div>
                                        <CheckIcon class="text-secondary-dark w-6 h-6" />
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                        <div class="flex justify-start items-center">
                                            <UserMinusIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                            <p class="font-bold ml-2">Only Me</p>
                                        </div>
                                        <CheckIcon class="text-secondary-dark w-6 h-6" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </ClientOnly>
                <div class="relative inline-block rounded-xl px-3 py-1 hover:bg-secondary-light text-secondary-dark">
                    <input multiple @change="handleUploadedMedias" accept="image/*" class="absolute left-0 top-0 opacity-0 w-full h-full cursor-pointer" type="file">
                    <CameraIcon class="w-6 h-6" />
                </div>
            </div>
            <div v-if="imageUrls.length" class="grid grid-cols-3 gap-3 my-3">
                <img v-for="image in imageUrls" :key="image" :src="image" alt="">
            </div>
        </div>
        <button class="bg-secondary border border-secondary-dark text-white font-bold py-2 px-6 rounded mt-2 hover:bg-secondary-dark">Publish</button>
    </div>

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
