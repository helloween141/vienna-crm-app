<template>
  <v-select
      label="name"
      v-model="currentValue"
      :options="field.values"
      :required="field.required"
      :searchable="false"
      :clearable="false"
      @update:modelValue="handleInput"
      class="w-1/2 py-2 bg-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  />
</template>

<script>
export default {
  name: 'SelectField',
  data() {
    return {
      currentValue: {}
    }
  },
  props: {
    field: Object,
    value: Object
  },
  created() {
    if (!this.value) {
      this.currentValue = this.field.values.find(val => val.default) || this.field.values[0]
    } else {
      this.currentValue = typeof this.value === 'object' ?
          this.value : this.field.values.find(val => val.id === this.value)
    }

  },
  methods: {
    handleInput(value) {
      this.$emit('set-value', this.field.name, value)
    }
  }
}
</script>

<style scoped>

</style>