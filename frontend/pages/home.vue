<script lang="ts" setup>
import { GlobeAltIcon, CameraIcon, CheckIcon, UsersIcon, UserMinusIcon } from "@heroicons/vue/24/outline"
import CreateForm from "~/components/Timeline/CreateForm.vue"
import {useTimelineStore} from '~/store/timelineStore'

definePageMeta({
  middleware: 'auth'
})

const timelineStore = useTimelineStore()
const {timelines, isLoading} = storeToRefs(timelineStore)
const refreshTimeline = () => {
    console.log("🚀 ~ file: home.vue:13 ~ refreshTimeline ~ refreshTimeline:")
    timelineStore.fetchPersonalizeTimelines()
}
onMounted(() => {
    nextTick(() => {
        timelineStore.fetchPersonalizeTimelines()
    })
})
</script>

<template>
  <div>
    <CreateForm @timeline:refresh="refreshTimeline" />
    <div v-if="isLoading" class="w-full flex justify-center items-center mt-12">
        <img class="w-10" src="/images/rolling.svg" alt="rolling" />
    </div>
    <div v-else class="">
        <div v-for="timeline in timelines" :key="timeline.id" class="border-b border-gray-300 pb-4 mb-4 flex justify-start w-full">
            <!-- {{  timeline }} -->
            <!-- User Avatar -->
            <img v-if="timeline.user.profile_pic" class="w-10 h-10 rounded-lg" :src="timeline.user.profile_pic" alt="">
            <div v-else class="w-10 h-10 bg-gray-300 rounded-lg"></div>
            <!-- Tweet Content -->
            <div class="ml-3 w-full">
                <div class="flex justify-start">
                    <h3 class="font-bold mb-0">{{ timeline.user.first_name + ' ' + timeline.user.last_name }}</h3>
                    <p class="text-gray-600 mb-0 ml-3">@{{ timeline.user.user_name }} - {{ timeline.created_at_human_diff }}</p>
                </div>
                <div class="mt">
                    <p>{{ timeline.content }}</p>
                    <img v-if="Array.isArray(timeline.images) && timeline.images.length > 0"
                        class="w-full rounded my-1" 
                        :src="timeline.images[0].src" 
                        :alt="timeline.images[0].src">
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped></style>
