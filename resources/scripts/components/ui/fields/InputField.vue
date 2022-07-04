<template>
  <input
      type="text"
      v-model="currentValue"
      :readonly="field.readonly"
      :required="field.required"
      @input="handleInput"
      class="bg-gray-200 appearance-none border-gray-200 rounded w-full text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  />
</template>

<script>
export default {
  name: 'InputField',
  props: {
    field: Object,
    value: ''
  },
  computed: {
    currentValue() {
      return this.value ? this.value : this.field.default
    }
  },
  methods: {
    handleInput() {
      this.$emit('set-value', this.field.name, this.initialValue)
    }
  }
}
</script>

<style scoped>

</style>