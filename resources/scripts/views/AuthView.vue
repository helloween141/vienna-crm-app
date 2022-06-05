<template>
    <div class="w-full h-full px-5 py-5">
        <p v-if="error">
            {{error}}
        </p>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="handleSubmit">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email"
                    type="text"
                    v-model="email"
                />
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Пароль
                </label>
                <input
                    class="shadow appearance-none border border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password"
                    type="password"
                    v-model="password"
                />
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Войти
                </button>
            </div>
        </form>
    </div>
</template>

<script lang="ts">
import {defineComponent, Ref, ref} from "vue";
import axios from "axios";
import router from "@/router";

export default defineComponent({
    name: "AuthView",
    setup() {
        const email: Ref<string> = ref('')
        const password: Ref<string> = ref('')
        let error: Ref<string> = ref('')

        const handleSubmit = () => {
            if (password.value.length > 0) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/login', {
                        email: email.value,
                        password: password.value
                    }).then(response => {
                        console.log(response.data)
                        if (response.data.success) {
                            // TODO: записать в store
                            router.push('dashboard')
                        } else {
                            error.value = response.data.message
                        }
                    }).catch(function (error) {
                        console.error(error);
                    });
                })
            }
        }
        return {
            email,
            password,
            error,
            handleSubmit
        }
    }
})
</script>

<style scoped>

</style>
