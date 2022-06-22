<template>
  <div class="flex flex-col">
    <Navbar @on-toggle-theme="onToggleTheme"/>
    <main>
      <RouterView class="flex-grow px-6 py-6"/>
    </main>
    <ModalsContainer/>
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
      applyTheme()
    }

    const applyTheme = () => {
      if (themeStore.isDark) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    }

    applyTheme()

    return {
      onToggleTheme,
      themeStore
    }
  }
})
</script>
<style>
</style>
