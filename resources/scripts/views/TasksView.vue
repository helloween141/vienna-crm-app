<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <Sidebar
        :title="sidebarTitle"
        :url="sidebarDataUrl"
    />
    <Content />
  </div>
</template>

<script lang="ts">
import Sidebar from "@/components/ui/Sidebar.vue"
import Content from "@/components/ui/Content.vue"
import {defineComponent} from "vue";
import axios from "axios";
import Breadcrumbs from "@/components/ui/Breadcrumbs.vue";

export default defineComponent({
  name: "TasksView",
  components: {Content, Sidebar, Breadcrumbs},
  data() {
    return {
      sidebarTitle: 'Обращения',
      sidebarDataUrl: 'tasks'
    }
  },
})

</script>

<style>

</style>
