<script lang="ts" setup>
    import LoginForm from '~/components/Auth/LoginForm.vue';
    definePageMeta({ layout: 'guest' });
</script>

<template>
    <div class="bg-white p-8 rounded shadow-md w-96">
        <div class="flex items-center justify-left mb-8">
            <h3 class="text-lg font-bold text-secondary-dark border-l-4 border-secondary-light pl-3">Login</h3>
        </div>

        <LoginForm />

        <div class="mt-4">
            <a href="#" class="text-blue-500 text-sm">Forgot password?</a>
        </div>

        <div class="mt-5 text-center border-t border-gray-100 pt-5">
            <p class="text-gray-600">Don't have an account?</p>
            <NuxtLink to="/register" class="text-blue-500 font-bold">Sign up</NuxtLink>
        </div>
    </div>
</template>

<style scoped></style>
