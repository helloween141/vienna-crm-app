<template>
    <div :class="{'dark': themeStore.isDark}">
        <div class="flex flex-col dark:bg-gray-800">
            <Navbar @on-toggle-theme="onToggleTheme"/>
            <RouterView class="px-6 mb-10"/>
            <Copyright/>
            <ModalsContainer/>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {useThemeStore} from "@/stores/theme";
import Navbar from "@/components/Navbar.vue";
import AuthView from "@/views/LoginView.vue";
import Copyright from "@/components/Copyright.vue";
import {useUserStore} from "@/stores/user";

export default defineComponent({
    components: {AuthView, Copyright, Navbar},
    setup() {
        const themeStore = useThemeStore()
        const onToggleTheme = () => {
            themeStore.switchTheme()
        }

        return {
            onToggleTheme,
            themeStore
        }
    }
})
</script>

<style>
</style>
