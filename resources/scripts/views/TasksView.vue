<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <Sidebar :model="model" />
    <Content :model="model" />
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import Sidebar from '@/components/ui/Sidebar.vue'
import Content from '@/components/ui/Content.vue'
import Breadcrumbs from '@/components/ui/Breadcrumbs.vue'

export default defineComponent({
  name: 'TasksView',
  components: {Content, Sidebar, Breadcrumbs},
  data() {
    return {
      model: 'task'
    }
  },
})

</script>

<style>

</style>
