import ApiClient from "~/service/ApiClient"
import { timelineParams } from "~/types/timelineTypes"
import { useToast } from 'tailvue'

export const useTimelineStore = defineStore('useTimelineStore', () => {
    const timelines = ref([])
    const isLoading: Ref<Boolean | false> = ref(false)
    const isSubmitLoading: Ref<Boolean | false> = ref(false)

    const fetchPersonalizeTimelines = async () => {
        isLoading.value = true;
        const { data } = await ApiClient.get('/timelines')
        isLoading.value = false
        timelines.value = data.value?.data?.data
        return data
    }

    const handleTimelineStore = async (timelineData: timelineParams) => {
        isSubmitLoading.value = true;
        let formdata = new FormData();
        formdata.append('content', timelineData.content)
        formdata.append('preview_privacy', timelineData.previewPrivacy)

        if (timelineData.images?.length > 0) {
            for (let start = 0; start < timelineData.images?.length; start++) {
                formdata.append(`images[${start}]`, timelineData.images[start])
            }
        }
        const { data, error } = await ApiClient.post('/timelines', formdata);
        if (process.client) {
            useToast().success(data.value.message)
        }
        isSubmitLoading.value = false;
    }

    return {
        isLoading,
        timelines,
        handleTimelineStore,
        fetchPersonalizeTimelines
    }
})