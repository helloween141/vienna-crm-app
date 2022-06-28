import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import Toast from "vue-toastification"
import Spinner from './components/Spinner.vue'
import 'vue-toastification/dist/index.css'
import router from './router'
import 'flowbite'
import vfmPlugin from 'vue-final-modal'
import Datepicker from '@vuepic/vue-datepicker';
import vSelect from 'vue-select'

import '@vuepic/vue-datepicker/dist/main.css'
import 'vue-select/dist/vue-select.css';

const app = createApp(App)
app.use(createPinia())
app.use(Toast, {});
app.use(router)
app.use(vfmPlugin)
app.component('v-select', vSelect)
app.component('Datepicker', Datepicker)
app.component('Spinner', Spinner)
app.mount('#app')
