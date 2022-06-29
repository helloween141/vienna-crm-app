<template>
  <textarea
      rows="5"
      v-model="initialValue"
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
  data() {
    return {
      initialValue: ''
    }
  },
  props: {
    field: Object,
    value: ''
  },
  created() {
    this.initialValue = this.value ? this.value : this.field.default
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