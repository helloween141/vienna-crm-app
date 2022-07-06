<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <Sidebar :model="model" :detail-route-name="detailRouteName" :list-route-name="listRouteName" />
    <Content :model="model" :detail-route-name="detailRouteName" />
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import Sidebar from '@/components/module/Sidebar.vue'
import Content from '@/components/module/Content.vue'
import Breadcrumbs from '@/components/ui/Breadcrumbs.vue'

export default defineComponent({
  name: 'TasksView',
  components: {Content, Sidebar, Breadcrumbs},
  data() {
    return {
      model: 'task',
      detailRouteName: 'task',
      listRouteName: 'tasks'
    }
  },
})

</script>

<style>

</style>
