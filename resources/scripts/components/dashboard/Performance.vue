<template>
  <div>
    <div class="mb-5">
      <h1 class="text-2xl dark:text-white">Работы по сотрудникам</h1>
    </div>

    <div class="w-full border-t dark:border-gray-700 mb-5"></div>

    <div v-if="loading">
      <Spinner/>
    </div>
    <div v-else-if="statistics && !loading">
      <div class="mb-5">
        <div class="flex-col flex-wrap mb-5 justify-between">
          <div class="flex mb-5">
            <div class="w-32 mr-5">
              <select
                  class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option v-for="(month) in months">{{ month }}</option>
              </select>
            </div>
            <div class="w-32 mr-5">
              <select
                  class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option v-for="year in years">{{ year }}</option>
              </select>
            </div>
            <div>
              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Показать</button>
            </div>
          </div>
          <div class="flex items-center">
            <span class="dark:text-white">
              Время (норма за месяц: {{statistics.month_norm}} ч., на сегодня: {{ statistics.today_norm }} ч.)
            </span>
          </div>
        </div>
      </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">Исполнитель</th>
              <th scope="col" class="px-6 py-3">Всего в этом месяце</th>
              <th v-for="month in statistics.months" scope="col" class="px-6 py-3">
                {{ months[month] }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="statistic in statistics.users"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ statistic.name }}
              </th>
              <td class="px-6 py-4">{{ statistic.current_time }} ч.</td>
              <td class="px-6 py-4">{{ statistic.last_time }} ч.</td>
              <td class="px-6 py-4">{{ statistic.before_last_time }} ч.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else>
      <span class="dark:text-white">Нет данных на текущий месяц!</span>
    </div>
  </div>

</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {months, years} from '@/data/constants'
import axios from "axios";
import Spinner from "@/components/Spinner.vue";

export default defineComponent({
  name: "Performance",
  components: {Spinner},
  data() {
    return {
      statistics: {},
      months,
      years,
      loading: false
    }
  },
  async mounted() {
    await this.fetchData()
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const resultStatistic = await axios.get('/api/dashboard/statistics/', {
          params: {}
        })
        this.statistics = resultStatistic.data
        this.loading = false
        console.log(this.statistics)
      } catch (error) {
        console.log(error)
      }
    }
  }
})
</script>

