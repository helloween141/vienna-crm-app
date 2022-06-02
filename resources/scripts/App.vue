<template>
  <div :class="{'dark': themeStore.isDark}">
    <div class="flex flex-col dark:bg-gray-800">
      <Navbar @on-toggle-theme="onToggleTheme"/>
      <main>
        <RouterView v-if="isAuth" class="px-6 mb-10"/>
        <AuthView v-else class="px-6 mb-10" />
      </main>
      <Copyright />
      <modals-container />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import {useThemeStore} from "@/stores/theme";
import Navbar from "@/components/Navbar.vue";
import AuthView from "@/views/AuthView.vue";
import Copyright from "@/components/Copyright.vue";

export default defineComponent({
  components: { AuthView, Copyright, Navbar },
  setup() {
    const themeStore = useThemeStore()
    const onToggleTheme = () => {
      themeStore.switchTheme()
    }

    return {
      isAuth: true,
      onToggleTheme,
      themeStore
    }
  }
})
</script>

<style>
</style>
