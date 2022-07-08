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
    <div v-if="hour || minute"
         class="text-white text-1xl flex items-center"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
              clip-rule="evenodd"/>
      </svg>
      <div class="pl-3">
        <span v-if="hour > 0">{{ hour }} ч.&nbsp;</span>
        <span v-if="minute > 0">{{ minute }} мин.</span>
      </div>
    </div>
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
      hour: 0,
      minute: 0,
      timer: null,
    }
  },
  async mounted() {
    try {
      const result = await axios.get(`/api/tasks/get-timer/`,{
        params: {
          'id': this.taskId
        }
      })
      this.currentTime = result.data.timer
      this.hour = Math.floor(this.currentTime / 60)
      this.min = this.currentTime % 60
      console.log(result.data)
      this.$emit('set-timer-value', this.timerField, this.currentTime)
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
        this.timer = setInterval(this.calcTime, 60000)
        this.calcTime()
      }, (60 - date.getSeconds()) * 1000)

    },
    calcTime() {
      this.minute++
      if (this.minute === 60) {
        this.hour++;
        this.minute = 0
      }
      this.currentTime = this.minute + (this.hour * 60)
      this.update()
    },
    async update() {
      try {
        await axios.post(`/api/tasks/update-timer/`, {
          'id': this.taskId,
          'timer': this.currentTime
        })

        this.$emit('set-timer-value', this.timerField, this.currentTime)
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