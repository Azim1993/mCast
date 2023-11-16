<script lang="ts" setup>
import {useAuthStore} from '~/store/authStore'
const {handleLogout} = useAuthStore()
</script>
<template>
    <form method="post" @submit.prevent="handleLogout">
        <button type="submit" class="font-semibold">Logout</button>
    </form>
</template>

<style scoped></style>
