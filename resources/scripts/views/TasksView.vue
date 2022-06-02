<template>
  <Breadcrumbs />
  <div class="flex px-6 dark:bg-gray-800">
    <Sidebar />
    <Content />
  </div>
</template>

<script setup lang="ts">
import Sidebar from "@/components/ui/Sidebar.vue"
import Content from "@/components/ui/Content.vue"
import Breadcrumbs from "../components/ui/Breadcrumbs.vue"
</script>

<style></style>
