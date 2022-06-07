import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Toast from "vue-toastification"
import App from './App.vue'
import 'vue-toastification/dist/index.css'
import router from './router'
import 'flowbite'
import vfmPlugin from 'vue-final-modal'

const app = createApp(App)
app.use(createPinia())
app.use(Toast, {});
app.use(router)
app.use(vfmPlugin)
app.mount('#app')
