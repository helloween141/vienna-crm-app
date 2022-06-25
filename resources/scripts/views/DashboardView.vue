<template>
  <div>
    <CurrentTasks />
    <Performance />
  </div>
</template>

<script lang="ts">
import CurrentTasks from "@/components/dashboard/CurrentTasks.vue";
import Performance from "@/components/dashboard/Performance.vue";

export default {
  components: {Performance, CurrentTasks}
}
</script>
