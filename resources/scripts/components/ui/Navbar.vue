<template>
  <header v-show="userStore.auth">
    <div class="wrapper">
      <nav class="border-gray-200 px-2 sm:px-4 py-1 dark:bg-gray-700 bg-gray-50">
        <div class="container flex flex-wrap justify-between items-center mx-auto">

          <RouterLink to="/" class="flex items-center" aria-current="page">
            <img src="@/assets/logo.svg" class="mr-3 h-6 sm:h-9" alt="Logo"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
              Vienna CRM
            </span>
          </RouterLink>

          <div class="flex items-center md:order-2">
            <button
                class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" type="button" data-dropdown-toggle="dropdown">
              <span class="sr-only">Открыть меню пользователя</span>
              <img class="w-8 h-8 rounded-full"
                   src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6X6SlR7kCahU2erUQtNwHMTGyznLddopKDA&usqp=CAU"
                   alt="user photo">
            </button>

            <div class="hidden py-3 px-4 md:inline-block">
              <span class="block text-sm text-gray-900 dark:text-white">{{ userStore.user.name }}</span>
              <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ userStore.user.email }}</span>
            </div>

            <!-- Dropdown menu -->
            <div
                class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown">
              <ul class="py-1" aria-labelledby="dropdown">
                <li>
                  <RouterLink to="/"
                              class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    Мои обращения
                  </RouterLink>
                </li>
                <li>
                  <a href="#"
                     class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Настройки</a>
                </li>
                <li>
                  <RouterLink to="/constants/"
                              class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    Константы
                  </RouterLink>
                </li>
                <li>
                  <a href="#" @click.prevent="logout"
                     class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Выйти</a>
                </li>
              </ul>
            </div>
            <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
              <span class="sr-only">Открыть основное меню</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
              </svg>
              <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
              </svg>
            </button>

            <button aria-hidden="true" class="relative focus:outline-none" @click="onToggle">
              <div class="w-12 h-6 transition rounded-full outline-none bg-gray-100 dark:bg-gray-500"></div>
              <div
                  class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm translate-x-0 -translate-y-px bg-white text-primary-dark"
                  :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !themeStore.isDark, 'translate-x-6 text-primary-100 bg-primary-darker': themeStore.isDark }">
                <svg v-show="!themeStore.isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <svg v-show="themeStore.isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" style="display: none;">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
              </div>
            </button>
          </div>

          <div v-show="userStore.auth" class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
               id="mobile-menu-2">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
              <li>
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                  Документы
                  <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                  </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownNavbar"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    <li>
                      <RouterLink to="/tasks/"
                                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Обращения
                      </RouterLink>
                    </li>
                    <li>
                      <a href="#"
                         class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Платежи</a>
                    </li>
                    <li>
                      <a href="#"
                         class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Продажи</a>
                    </li>
                    <li>
                      <a href="#"
                         class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Счета</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#"
                   class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Отчеты</a>
              </li>
              <li>
                <a href="#"
                   class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Справочники</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
</template>

<script lang="ts">
import {defineComponent} from "vue"
import router from "@/router";
import {useUserStore} from "@/stores/user";
import {useThemeStore} from "@/stores/theme";
import {storeToRefs} from "pinia";
import axios from "axios";

export default defineComponent({
  name: 'Navbar',
  data() {
    return {
      userStore: {},
      themeStore: {}
    }
  },
  created() {
    this.userStore = useUserStore()
    this.themeStore = useThemeStore()
  },
  methods: {
    onToggle() {
      this.$emit('on-toggle-theme')
    },
    async logout() {
      try {
        await axios.post('/api/logout')
        this.userStore.$reset()
        await router.push({name: 'login'})
      } catch (error) {
        console.error(error)
      }
    },
  }
})
</script>

<style scoped>
</style>
