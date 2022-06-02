<template>
  <div class="flex-1 h-full pl-6">
    <div v-if="loading" class="loading">Загрузка...</div>
    <div v-else>
      <div class="flex mb-5 justify-between items-center">
        <h1 v-if="!formValues" class="text-2xl dark:text-white">Новое обращение</h1>
        <h1 v-else class="text-2xl dark:text-white">Обращение {{ formValues.id }}</h1>
        <button
            v-if="!startTimer"
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

      <div class="w-full border-t border-gray-200 mb-5"></div>

      <div class="relative overflow-x-auto">
        <form @submit.prevent="onSaveTask">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <tbody>
            <tr
                v-for="field in formInterface.fields"
                :key="field"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white odd:bg-gray-50"
            >
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap w-1/6">
                {{ field.title }}
              </th>
              <td class="px-6 py-4 w-1/2">
                <input
                    v-if="field.type === 'string'"
                    type="text"
                    name="{{field.name}}"
                    :v-model="formValues[field.name]"
                    :value="formValues[field.name]"
                    :readonly="field.readonly"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-1/2 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                />

                <textarea
                    v-else-if="field.type === 'text'"
                    rows="5"
                    name="{{field.name}}"
                    :v-model="formValues[field.name]"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                >{{formValues[field.name]}}</textarea>

                <select
                    v-else-if="field.type === 'select' && field.values.length > 0"
                    :v-model="formValues[field.name]"
                    class="w-1/2 py-2 px-4"
                >
                  <option
                      v-for="value in field.values"
                      :key="value.id"
                      :selected="formValues ? formValues[field.name] === value.name : value.default"
                  >
                    {{ value.title }}
                  </option>
                </select>

                <input
                    v-if="field.type === 'date'"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-1/2 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    type="text"
                    name="{{field.name}}"
                    :v-model="formValues[field.name]"
                    :value="formValues[field.name]"
                    :readonly="field.readonly"
                />
              </td>
            </tr>
            </tbody>
          </table>
          <button
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-5 mt-5">
            Сохранить
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from "vue"
import formInterface from "@/data/mock/task-interface.json"
import tasks from "@/data/mock/tasks.json"
import {useToast} from "vue-toastification"

export default defineComponent({
  name: "Content",
  data() {
    return {
      startTimer: false,
      loading: false,
      toast: useToast(),
      formInterface: {},
      formValues: {}
    }
  },
  created() {
    // TODO: get task data from backend
    this.$watch(
        () => this.$route.params,
        () => {
          this.fetchData()
        },
        // fetch the data when the view is created and the data is
        // already being observed
        {immediate: true}
    )
  },
  methods: {
    fetchData() {
      this.formInterface = this.formValues = {}

      this.loading = true;
      setTimeout(() => {
        this.formInterface = {...this.formInterface, ...formInterface}
        this.formValues = tasks.find(task => (task.id).toString() === this.$route.params.id) || {}
        this.loading = false;
      }, 1000)
    },
    onChangeTimerState() {
      this.startTimer = !this.startTimer
    },
    onSaveTask() {
      this.toast.success("Задача успешно сохранена", {
        timeout: 3000
      });
    }
  }
})
</script>
