<template>
  <input
      type="text"
      v-model="value"
      :readonly="field.readonly"
      :required="field.required"
      @input="handleInput"
      class="bg-gray-200 appearance-none border-gray-200 rounded w-1/2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  />
</template>

<script>
export default {
  name: 'InputField',
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