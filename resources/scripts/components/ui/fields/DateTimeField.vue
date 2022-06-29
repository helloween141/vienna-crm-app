<template>
  <Datepicker
      v-model="initialValue"
      :readonly="field.readonly"
      :required="field.required"
      :format="'dd.MM.yyyy HH:mm'"
      :clearable="false"
      @update:modelValue="handleInput"
      locale="ru"
      autoApply
      class="w-1/2"
      inputClassName="appearance-none bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
  />
</template>

<script>
import * as moment from "moment";

export default {
  name: 'DateTimeField',
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
    handleInput(value) {
      value = moment(value).format('YYYY-MM-DD HH:mm')
      this.$emit('set-value', this.field.name, value)
    }
  }
}
</script>

<style scoped>
.dp__theme_light {
  --dp-background-color: rgb(229 231 235 / var(--tw-bg-opacity));
}
</style>