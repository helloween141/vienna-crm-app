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
    <span class="text-white text-2xl">
      Время выполнения: {{ hour }} ч. {{ min }} мин.
    </span>
  </div>

</template>

<script>
import axios from "axios";

export default {
  name: 'Timer',
  data() {
    return {
      isStarted: false,
      min: 0,
      hour: 0,
      timer: null,
      currentTime: this.initialTime,
      timeField: 'executor_time'
    }
  },
  props: {
    initialTime: Number,
    taskId: Number
  },
  created() {
    this.hour = Math.floor(this.currentTime / 60)
    this.min = this.currentTime % 60
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
      this.timer = setInterval(() => {
        this.min++
        if (this.min === 60) {
          this.hour++;
          this.min = 0
        }
        this.currentTime = this.min + (this.hour * 60)

        this.update()
      }, 1000)
    },
    async update() {
      try {
        await axios.post(`/api/tasks/update-timer/`, {
          'id': this.taskId,
          'time': this.currentTime
        })
        console.log('Timer updated', this.currentTime)
        this.$emit('set-value', this.timeField, this.currentTime)
      } catch (error) {
        console.log(error)
      }
    }
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>

<style scoped>

</style>