<template>
  <div class="flex-1 h-full pl-5 pt-5">
    <div v-if="loading">
      <Spinner/>
    </div>
    <div v-else>
      <div class="flex mb-5 justify-between items-center">
        <h1 v-if="!formValues.id" class="text-2xl dark:text-white">Создать {{formInterface.accusative_name}}</h1>
        <h1 v-else class="text-2xl dark:text-white">{{ formInterface.single_name }} {{ formValues.id }}</h1>
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
      <div class="relative overflow-x-auto">
        <form @submit.prevent="onSave">
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
                    v-if="field.type === 'string' || field.type === 'int'"
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
                    v-if="field.type === 'datetime'"
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
import {useToast} from "vue-toastification"
import Spinner from "@/components/Spinner.vue";
import axios from "axios";

export default defineComponent({
  name: "Content",
  components: {Spinner},
  data() {
    return {
      startTimer: false,
      loading: false,
      toast: useToast(),
      formInterface: {},
      formValues: {}
    }
  },
  props: {
    model: String
  },
  async mounted() {
    this.$watch(
        () => this.$route.params,
        async () => {
          await this.fetchData()
        },
        {
          immediate: true
        }
    )
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true;
        //this.formInterface = {...this.formInterface, ...formInterface}

        const recordId = this.$route.params.id
        const resultInterface = await axios.get(`/api/core/${this.model}/interface/`)
        this.formInterface = resultInterface.data
        console.log(this.formInterface)

        if (recordId) {
          const resultData = await axios.get(`/api/core/${this.model}/${this.$route.params.id}/`)
          this.formValues = resultData.data.data[0]
          this.loading = false;
          console.log(this.formValues)
        } else {
          this.loading = false;
        }
      } catch (error) {
        console.error(error)
      }
    },
    onChangeTimerState() {
      this.startTimer = !this.startTimer
    },
    onSave() {
      this.toast.success("Данные сохранены!", {
        timeout: 3000
      });
    }
  }
})
</script>
