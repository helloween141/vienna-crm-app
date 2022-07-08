<template>
  <Breadcrumbs />
  <div class="flex px-6">
    <DefaultSidebar />
    <DefaultContent />
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import DefaultSidebar from '@/components/modules/sidebars/DefaultSidebar.vue'
import DefaultContent from '@/components/modules/contents/DefaultContent.vue'
import Breadcrumbs from '@/components/ui/Breadcrumbs.vue'

export default defineComponent({
  name: 'DefaultView',
  components: {DefaultContent, DefaultSidebar, Breadcrumbs},
})

</script>

<style>

</style>
