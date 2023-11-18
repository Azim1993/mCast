<script lang="ts" setup>
import { GlobeAltIcon, CameraIcon, CheckIcon, UsersIcon, UserMinusIcon } from "@heroicons/vue/24/outline"
import { ErrorMessage, Field, Form } from 'vee-validate'
import {registrationSchema} from '~/schema/authSchema'
import {useTimelineStore} from '~/store/timelineStore'
import { defineEmits } from 'vue'


const previewPrivacySets = {
    public: 'Everyone can view',
    private: 'Only you can view',
    followers: 'Your Followers can view'
}
const {handleTimelineStore} = useTimelineStore()

const emitter = defineEmits()
const timeline = ref({
    content: '',
    previewPrivacy: 'public',
    images: []
})

const imageUrls = ref([])
const showPrivacyDropper = ref(false)
const onClickAway = () => showPrivacyDropper.value = false

const handlePreviewPrivacy = (status) => {
    timeline.value.previewPrivacy = status
    showPrivacyDropper.value = false
}

const handleSubmit = () => {
    handleTimelineStore(timeline.value)
        .then(() => {
            timeline.value ={
                content: '',
                previewPrivacy: 'public',
                images: []
            }
            imageUrls.value = []
            emitter('timeline:refresh')
        })
}

const handleUploadedMedias = (event: { target: { files: any } }) => {
    const files = event.target.files
    if (files.length === 0) return

    timeline.value.images = files
    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        const reader = new FileReader()
        reader.onload = (e) => {
          imageUrls.value.push(e.target.result)
        }
        reader.readAsDataURL(file)
    }
}
</script>

<template>
    <ClientOnly>
    <form method="post" @submit.prevent="handleSubmit" class="mb-4 text-center">
        <textarea v-model="timeline.content" class="p-4 h-24 w-full border border-gray-200 rounded-t" placeholder="What is happening Now?"></textarea>
        <div class="border -mt-2 border-gray-200 border-t-0 py-2 pt-3 px-5 w-full text-center rounded-b-lg">
            <div class="flex justify-start">
            <div class="relative" v-click-away="onClickAway">
                <a href="#" @click.prevent="showPrivacyDropper = !showPrivacyDropper" class="flex justify-start rounded-xl px-3 py-1 mr-2 hover:bg-secondary-light text-secondary-dark cursor-pointer">
                    <GlobeAltIcon v-if="timeline.previewPrivacy === 'public'" class="w-6 h-6" />
                    <UsersIcon v-if="timeline.previewPrivacy === 'followers'" class="w-6 h-6" />
                    <UserMinusIcon v-if="timeline.previewPrivacy === 'private'" class="w-6 h-6" />
                    <span>{{  previewPrivacySets[timeline.previewPrivacy] }}</span>
                </a>
                <div v-if="showPrivacyDropper" class="py-4 rounded-xl border absolute text-left bg-white w-96">
                    <h4 class="font-semibold px-4">Who can Preview?</h4>
                    <p class="font-extralight px-4">Choose who can preview to this post. Anyone mentioned can always reply.</p>
                    <ul>
                        <li>
                            <a href="#" @click.prevent="handlePreviewPrivacy('public')" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                <div class="flex justify-start items-center">
                                    <GlobeAltIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                    <p class="font-bold ml-2">Everyone</p>
                                </div>
                                <CheckIcon v-if="timeline.previewPrivacy === 'public'" class="text-secondary-dark w-6 h-6" />
                            </a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="handlePreviewPrivacy('followers')" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                <div class="flex justify-start items-center">
                                    <UsersIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                    <p class="font-bold ml-2">Followers</p>
                                </div>
                                <CheckIcon v-if="timeline.previewPrivacy === 'followers'" class="text-secondary-dark w-6 h-6" />
                            </a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="handlePreviewPrivacy('private')" class="flex justify-between items-center py-2 px-4 hover:bg-light">
                                <div class="flex justify-start items-center">
                                    <UserMinusIcon class="bg-secondary-light text-white rounded-full w-8 h-8" />
                                    <p class="font-bold ml-2">Only Me</p>
                                </div>
                                <CheckIcon v-if="timeline.previewPrivacy === 'private'" class="text-secondary-dark w-6 h-6" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
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
    </form>
    </ClientOnly>
</template>

<style scoped></style>
