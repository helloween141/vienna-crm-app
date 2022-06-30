<template>
  <div class="flex-1 h-full pl-5 pt-5">
    <div v-if="loading">
      <Spinner/>
    </div>
    <div v-else>
      <div class="mb-5 justify-between items-center">
        <h1 v-if="!formValues.id" class="text-2xl dark:text-white">
          Создать {{formInterface.accusative_detail_title}}
        </h1>
        <h1 v-else class="text-2xl dark:text-white">
          {{ formInterface.detail_title }} {{ formValues.id }}
        </h1>
      </div>

      <Timer
          v-if="formValues['id'] && model === 'task'"
          @set-value="setValue"
          :task-id="formValues['id']"
          :initial-time="formValues['executor_time']"
      />

      <div class="relative overflow-x-auto">
        <span class="text-white">{{formValues}}</span>
        <form @submit.prevent="handleSave">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <tbody>
              <tr
                  v-for="field in formInterface.fields"
                  v-show="!field.hidden"
                  :key="field"
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white odd:bg-gray-50"
              >
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap w-1/6">
                  {{ field.title }}
                </th>
                <td class="px-6 py-4 w-1/2">

                  <InputField
                      v-if="field.type === 'string' || field.type === 'int'"
                      :field="field"
                      :value="formValues[field.name]"
                      @set-value="setValue"
                  />

                  <TextField
                      v-else-if="field.type === 'text'"
                      :field="field"
                      :value="formValues[field.name]"
                      @set-value="setValue"
                  />

                  <SelectField
                      v-else-if="field.type === 'select'"
                      :field="field"
                      :value="formValues[field.name]"
                      @set-value="setValue"
                  />

                  <PointerField
                      v-else-if="field.type === 'pointer'"
                      :field="field"
                      :value="formValues[field.name]"
                      @set-value="setValue"
                  />

                  <DateTimeField
                      v-else-if="field.type === 'datetime'"
                      :field="field"
                      :value="formValues[field.name]"
                      @set-value="setValue"
                  />
                </td>
              </tr>
            </tbody>
          </table>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-5 mt-5">
            Сохранить
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {useToast} from 'vue-toastification'
import axios from 'axios';
import * as moment from 'moment';
import InputField from "@/components/ui/fields/InputField.vue";
import TextField from "@/components/ui/fields/TextField.vue";
import SelectField from "@/components/ui/fields/SelectField.vue";
import PointerField from "@/components/ui/fields/PointerField.vue";
import DateTimeField from "@/components/ui/fields/DateTimeField.vue";
import Timer from "@/components/ui/Timer.vue"
export default defineComponent({
  name: 'Content',
  components: {DateTimeField, PointerField, SelectField, TextField, InputField, Timer},
  data() {
    return {
      loading: false,
      toast: useToast(),
      formInterface: {},
      formValues: {},
      recordId: 0,
    }
  },
  props: {
    model: String
  },
  async mounted() {
    this.$watch(
        () => this.$route.params,
        async () => {
          this.recordId = this.$route.params.id
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
        this.formValues = {}
        this.loading = true;

        const resultInterface = await axios.get(`/api/core/${this.model}/interface/`)
        this.formInterface = resultInterface.data
        console.log(this.formInterface)

        if (this.recordId) {
          const resultData = await axios.get(`/api/core/${this.model}/${this.recordId}/`)
          this.formValues = resultData.data.data[0]
          console.log(this.formValues)
        }

        this.loading = false;
      } catch (error) {
        console.error(error)
      }
    },
    getFormData() {
      const formData = new FormData()

      // TODO: Возможно не formValues
      Object.keys(this.formValues).forEach(key => {
        let item = this.formValues[key]
        if (item) {
          if (typeof item === 'object' && item.id) {
            formData.append(key, item.id)
          } else {
            formData.append(key, item)
          }
        }
      })
      return formData
    },
    async handleSave() {
      try {
        const resultSave = await axios.post(`/api/core/${this.model}/save/`, this.getFormData())
        const id = resultSave.data?.id

        if (id) {
          this.toast.success("Данные сохранены!", {
            timeout: 3000
          });

          // TODO: Redirect after success create ({params: id})
          this.$router.push(`${this.$route.path}`, {
            params: {
              id
            }
          })
        }
      } catch (error) {
        console.error(error)
      }
    },
    setValue(fieldName, fieldValue) {
      console.log(fieldName)
      this.formValues[fieldName] = fieldValue
    },
  }
})
</script>

<style scoped>

</style>
