<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <Sidebar :model="model" />
    <Content :model="model" />
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import Sidebar from '@/components/module/Sidebar.vue'
import Content from '@/components/module/Content.vue'
import Breadcrumbs from '@/components/ui/Breadcrumbs.vue'

export default defineComponent({
  name: 'ConstantsView',
  components: {Content, Sidebar, Breadcrumbs},
  data() {
    return {
      model: 'constant'
    }
  },
})

</script>

<style>

</style>
