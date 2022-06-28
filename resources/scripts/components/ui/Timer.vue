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
    <div v-if="hour || min"
         class="text-white text-1xl flex items-center"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
              clip-rule="evenodd"/>
      </svg>
      <div class="pl-3">
        <span v-if="hour > 0">{{ hour }} ч.&nbsp;</span>
        <span v-if="min > 0">{{ min }} мин.</span>
      </div>
    </div>
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
      const date = new Date();

      setTimeout( () => {
        this.timer = setInterval(this.calcTime, 60000);
        this.calcTime();
      }, (60 - date.getSeconds()) * 1000);

    },
    calcTime() {
      this.min++
      if (this.min === 60) {
        this.hour++;
        this.min = 0
      }
      this.currentTime = this.min + (this.hour * 60)

      this.update()
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