<template>
    <div class="">
        <h2 class="text-5xl font-extralight mb-11">Happening now</h2>
        <div class="pb-6 border-b border-secondary">
            <h3 class="font-3xl font-semibold mb-5">Join toDay</h3>
            <a href="" class="bg-secondary text-white border inline-block border-secondary rounded-md px-5 py-2">Create New Account</a>
        </div>
        <br class="bg-secondary w-full">
        <div class="">
            <p class="mb-4">Already have account</p>
            <NuxtLink to="/login" class="text-secondary border inline-block border-secondary rounded-md px-5 py-1">Login</NuxtLink>
        </div>
    </div>
</template>

<script lang="ts" setup>
definePageMeta({ layout: 'guest' });

</script>