<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <DefaultSidebar />
    <TaskContent />
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import DefaultSidebar from '@/components/modules/sidebars/DefaultSidebar.vue'
import TaskContent from '@/components/modules/contents/TaskContent.vue'
import Breadcrumbs from '@/components/ui/Breadcrumbs.vue'

export default defineComponent({
  name: 'TasksView',
  components: {TaskContent, DefaultSidebar, Breadcrumbs},
})

</script>

<style>

</style>
