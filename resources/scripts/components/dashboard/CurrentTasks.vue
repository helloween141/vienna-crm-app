<template>
  <div>
    <div class="mb-5">

      <div class="mb-5">
        <h1 class="text-2xl dark:text-white">Мои обращения</h1>
      </div>

      <div class="w-full border-t border-gray-200 mb-5"></div>

      <div class="flex items-center mb-5">
        <label class="mr-5 dark:text-white">Сотрудник:</label>
        <select class="block py-2.5 px-0 w-64 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
          <option v-for="user in users">{{ user.name }}</option>
        </select>
      </div>

      <div>
        <div class="flex justify-between flex-wrap">
          <ul class="flex items-center flex-wrap w-full md:w-auto">
            <li class="pr-4 mt-3 md:mt-0 text-sm hover:underline">
              <a href="#" class="dark:text-white" @click="applyTypeFilter('')">Все обращения ({{ tasks.length }})</a>
            </li>
            <li v-for="(count, name) in typeFilters" class="pr-4 mt-3 md:mt-0 text-sm hover:underline">
              <a href="#" class="dark:text-white" @click="applyTypeFilter(name)">{{ taskTypes[name] }} ({{ count }})</a>
            </li>
          </ul>

          <div class="relative w-full md:w-auto md:mt-0 mt-3">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg>
            </div>
            <input type="text" id="email-address-icon"
              class="block w-full md:w-auto p-2 pl-10 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Поиск по обращениям..." v-model="searchString" @input="applySearchFilter" />
          </div>
        </div>
      </div>
    </div>

    <div v-if="currentTasks.length > 0" class="relative overflow-x-auto shadow-md sm:rounded-lg mb-10">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Номер</th>
            <th scope="col" class="px-6 py-3">Дата</th>
            <th scope="col" class="px-6 py-3">Клиент/персона</th>
            <th scope="col" class="px-6 py-3">Тип</th>
            <th scope="col" class="px-6 py-3">Суть обращения</th>
            <th scope="col" class="px-6 py-3">Статус</th>
            <th scope="col" class="px-6 py-3">Исполнитель</th>
            <th scope="col" class="px-6 py-3">Приоритет</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in currentTasks"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{ task.id }}
            </th>
            <td class="px-6 py-4">{{ task.date }}</td>
            <td class="px-6 py-4">
              <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">{{ task.client }}</a>
            </td>
            <td class="px-6 py-4">
              <select id="task-types"
                class="block py-2.5 px-0 w-48 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option v-for="(value, name) in taskTypes" :selected="name === task.type">{{ value }}</option>
              </select>
            </td>
            <td class="px-6 py-4">{{ task.short_description }}</td>
            <td class="px-6 py-4">
              <select id="task-statuses"
                class="block py-2.5 px-0 w-48 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option v-for="(value, name) in taskStatuses" :selected="name === task.status">{{ value }}</option>
              </select>
            </td>
            <td class="px-6 py-4">
              <select id="users"
                class="block py-2.5 px-0 w-48 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option v-for="user in users" :selected="user.id === task.executorId">{{ user.name }}</option>
              </select>
            </td>
            <td class="px-6 py-4">
              <span v-if="task.priority === 'high'" class="text-red-500">Высокий</span>
              <span v-else-if="task.priority === 'middle'" class="text-orange-500">Средний</span>
              <span v-else-if="task.priority === 'low'" class="text-green-500">Низкий</span>
              <span v-else-if="task.deadline_date" class="text-green-500">Выполнить до: {{ task.deadline_date }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <div class="mb-10">
        <span>Обращения не найдены!</span>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import tasks from '@/data/mock/tasks.json'
import users from '@/data/mock/users.json'
import { taskStatuses, taskTypes } from '@/data/constants'

export default defineComponent({
  name: "CurrentTasks",
  data() {
    return {
      tasks,
      users,
      taskTypes,
      taskStatuses,
      currentTasks: tasks,
      searchString: ''
    }
  },
  computed: {
    typeFilters() {
      return tasks.reduce((prev: any, cur: any) => (prev[cur.type] = prev[cur.type] + 1 || 1, prev), {})
    }
  },
  methods: {
    applySearchFilter() {
      const searchStr: string = (this.searchString).trim()
      if (searchStr) {
        this.currentTasks = this.currentTasks.filter((task: any) => (
            task.short_description.includes(searchStr) || task.client.includes(searchStr) || (task.id.toString()).includes(searchStr)
        ))
      } else {
        this.currentTasks = tasks
      }
    },
    applyTypeFilter(type: string) {
      this.searchString = ''
      if (type) {
        this.currentTasks = tasks.filter((task: any) => (task.type === type))
      } else {
        this.currentTasks = tasks
      }
    }
  }
})
</script>

