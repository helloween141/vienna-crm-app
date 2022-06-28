<template>
  <textarea
      rows="5"
      v-model="value"
      :required="field.required"
      @input="handleInput"
      class="bg-gray-200 appearance-none border-gray-200 rounded w-full text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  >
    {{value}}
  </textarea>
</template>

<script>
export default {
  name: 'TextField',
  props: {
    field: Object,
    value: ''
  },
  methods: {
    handleInput() {
      this.$emit('set-value', this.field.name, this.value)
    }
  }
}
</script>

<style scoped>

</style>