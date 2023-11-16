import ApiClient from "~/service/ApiClient"
import { timelineParams } from "~/types/timelineTypes"
import { useToast } from 'tailvue'

export const useTimelineStore = defineStore('useTimelineStore', () => {
    const timelines = ref([])
    const isLoading: Ref<Boolean | false> = ref(false)

    const handleTimelineStore = async (timelineData: timelineParams) => {
        isLoading.value = true;
        let FD = new FormData();
        console.log('content--', timelineData.content)
        FD.append('content', timelineData.content)
        FD.append('preview_privacy', timelineData.previewPrivacy)
        if (Array.isArray(timelineData.images)) {
            timelineData.images.forEach(image => {
                FD.append('images[]', image)
            });
        }
        const { data } = await ApiClient.post('/timelines', timelineData);
        console.log('== timeline', data)
        if (process.client) {
            useToast().success(data.value.message)
        }
        isLoading.value = false;
    }

    return {
        timelines,
        handleTimelineStore
    }
})