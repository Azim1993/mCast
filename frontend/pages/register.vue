<script lang="ts" setup>
definePageMeta({ layout: 'guest' });

</script>

<template>
  <div class="bg-white p-8 rounded shadow-md w-96">
    <div class="flex items-center justify-left mb-8">
        <h3 class="text-lg font-bold text-secondary-dark border-l-4 border-secondary-light pl-3">SignUp</h3>
    </div>

    <form>
        <!-- Username or Email Input -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username or Email</label>
            <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <!-- Remember Me Checkbox -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="remember" name="remember" class="mr-2">
            <label for="remember" class="text-gray-700 text-sm">Remember me</label>
        </div>

        <!-- Login Button -->
        <button type="submit" class="bg-secondary text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline-blue active:bg-secondary-dark hover:bg-secondary-dark">
            SignUp
        </button>
    </form>


    <div class="mt-5 text-center border-t border-gray-100 pt-5">
        <p class="text-gray-600">Already have an account?</p>
        <NuxtLink to="/login" class="text-blue-500 font-bold">Log In</NuxtLink>
    </div>
</div>
</template>

<style scoped></style>
