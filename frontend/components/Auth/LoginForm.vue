<script lang="ts" setup>
import { ErrorMessage, Field, Form } from 'vee-validate'
import {loginSchema} from '~/schema/authSchema'
import {useAuthStore} from '~/store/authStore'

const {handleLogin} = useAuthStore()
</script>

<template>
  <Form method="post" :validation-schema="loginSchema" @submit="handleLogin">
        <!-- Username or Email Input -->
        <div class="mb-4">
            <label for="user" class="block text-gray-700 text-sm font-bold mb-2">Username or Email</label>
            <Field type="text" id="user" name="user" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="user" class="text-xs text-red-500" />
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <Field type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="password" class="text-xs text-red-500" />
        </div>

        <!-- Remember Me Checkbox -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="remember" name="remember" class="mr-2">
            <label for="remember" class="text-gray-700 text-sm">Remember me</label>
        </div>

        <!-- Login Button -->
        <button type="submit" class="bg-secondary text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline-blue active:bg-secondary-dark hover:bg-secondary-dark">
            Log in
        </button>
    </form>
</template>

<style scoped></style>
