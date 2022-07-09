<template>
  <div class="flex justify-between mb-5">
    <button
        v-if="!isStarted"
        @click="onChangeTimerState"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline right-0">
      Включить таймер
    </button>
    <button
        v-else
        @click="onChangeTimerState"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline right-0">
      Выключить таймер
    </button>
  </div>

</template>

<script>
import axios from 'axios';

export default {
  name: 'Timer',
  props: {
    taskId: Number,
    timerField: String
  },
  data() {
    return {
      isStarted: false,
      timer: null,
    }
  },
  async mounted() {
    try {
      const result = await axios.get(`/api/tasks/get-all-time`,{
        params: {
          'id': this.taskId
        }
      })
      this.$emit('set-timer-value', this.timerField, result.data.timer)
    } catch (error) {
      console.log(error)
    }
  },
  methods: {
    onChangeTimerState() {
      this.isStarted = !this.isStarted

      if (this.isStarted) {
        this.launchTimer()
      } else {
        clearInterval(this.timer)
      }
    },
    launchTimer() {
      const date = new Date()

      setTimeout( () => {
        this.timer = setInterval(this.update, 60000)
      }, (60 - date.getSeconds()) * 1000)
    },
    async update() {
      try {
        const response = await axios.post(`/api/tasks/update-timer`, {
          'id': this.taskId
        })
        this.$emit('set-timer-value', this.timerField, response.data.timer)
      } catch (error) {
        console.log(error)
      }
    },
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>

<style scoped>

</style>