<template>
  <v-select
      :label="identifyLabel"
      v-model="value"
      :options="options"
      :required="field.required"
      @search="fetchData"
      @update:modelValue="handleInput"
      class="py-2 bg-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-purple-500 font-medium"
  />
</template>

<script>
import axios from "axios";

export default {
  name: 'PointerField',
  props: {
    field: Object,
    value: Object
  },
  data() {
    return {
      options: [],
      identifyLabel: this.field.identify || 'name'
    }
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
      this.$emit('set-value', this.field.name, this.value)
    }
  }
}
</script>

<style scoped>

</style>