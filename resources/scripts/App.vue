<template>
    <div :class="{'dark': themeStore.isDark}">
        <div class="flex flex-col dark:bg-gray-800">
            <Navbar @on-toggle-theme="onToggleTheme"/>
            <main>
              <RouterView class="flex-grow px-6 py-6"/>
            </main>
            <ModalsContainer/>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {useThemeStore} from "@/stores/theme";
import Navbar from "@/components/Navbar.vue";
import AuthView from "@/views/LoginView.vue";

export default defineComponent({
    components: {AuthView, Navbar},
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
