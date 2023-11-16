<script lang="ts" setup>
import RegisterForm from '~/components/Auth/RegisterForm.vue';
definePageMeta({ layout: 'guest' });

</script>

<template>
  <div class="bg-white p-8 rounded shadow-md w-96">
    <div class="flex items-center justify-left mb-8">
        <h3 class="text-lg font-bold text-secondary-dark border-l-4 border-secondary-light pl-3">SignUp</h3>
    </div>

    
    <RegisterForm />

    <div class="mt-5 text-center border-t border-gray-100 pt-5">
        <p class="text-gray-600">Already have an account?</p>
        <NuxtLink to="/login" class="text-blue-500 font-bold">Log In</NuxtLink>
    </div>
</div>
</template>

<style scoped></style>
