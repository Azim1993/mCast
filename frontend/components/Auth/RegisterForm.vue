<script lang="ts" setup>
import { ErrorMessage, Field, Form } from 'vee-validate'
import {registrationSchema} from '~/schema/authSchema'
import {useAuthStore} from '~/store/authStore'

const {handleRegistration} = useAuthStore()
</script>

<template>
    <Form method="post" :validation-schema="registrationSchema" @submit="handleRegistration">
        
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
            <Field type="text" id="first_name" name="first_name" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="first_name" class="text-xs text-red-500" />
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
            <Field type="text" id="last_name" name="last_name" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="last_name" class="text-xs text-red-500" />
        </div>
        <div class="mb-4">
            <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <Field type="text" id="user_name" name="user_name" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="user_name" class="text-xs text-red-500" />
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <Field type="text" id="email" name="email" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="email" class="text-xs text-red-500" />
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <Field type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="password" class="text-xs text-red-500" />
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <Field type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded" />
            <ErrorMessage name="password" class="text-xs text-red-500" />
        </div>

        <!-- SignUp Button -->
        <button type="submit" class="bg-secondary text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline-blue active:bg-secondary-dark hover:bg-secondary-dark">
            SignUp
        </button>
    </form>
</template>

<style scoped></style>
