<template>
  <v-select
      :label="identifyLabel"
      v-model="value"
      :options="options"
      :required="field.required"
      @search="fetchData"
      @update:modelValue="handleInput"
      class="w-1/2 py-2 bg-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  />
</template>

<script>
import axios from "axios";

export default {
  name: 'PointerField',
  data() {
    return {
      options: [],
      identifyLabel: ''
    }
  },
  props: {
    field: Object,
    value: Object
  },
  created() {
    this.identifyLabel = this.field.identify || 'name'
  },
  methods: {
    async fetchData(search, loading) {
      try {
        loading(true)
        const searchModel = this.field?.search_model || ''
        if (searchModel) {
          const resultSearch = await axios.get(`/api/core/${searchModel}/search/`, {
            params: {
              'search_string': search
            }
          })
          this.options = resultSearch.data.data
        }
        loading(false)
      } catch (error) {
        console.error(error)
      }
    },
    handleInput() {
      this.$emit('set-value', (this.field.identify || this.field.name), this.value)
    }
  }
}
</script>

<style scoped>

</style>