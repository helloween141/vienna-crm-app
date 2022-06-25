<template>
  <aside class="flex-shrink-0 hidden w-1/3 bg-white border-r dark:border-gray-700 dark:border-primary-darker dark:bg-gray-900 md:block pr-5 pt-5" aria-label="Sidebar">
    <div class="flex mb-2 justify-between">
      <div>
        <span class="text-2xl dark:text-white">{{ title }}</span>
      </div>
      <div>
        <button
            @click="onCreateNew"
            class="bg-green-500 hover:bg-green-700 text-white font-bold mr-2 py-2 px-2 rounded focus:outline-none focus:shadow-outline right-0">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </button>
        <button
            @click="onShowFilters"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline right-0"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="mb-5 overflow-y-auto bg-gray-50 rounded dark:bg-gray-800">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3" v-for="header in fetchedData.headers">
              {{ header }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="value in fetchedData.data"
              class="bg-white border-b hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 cursor-pointer"
              :key="value.id"
              @click="onOpenDetail(value.id)"
          >
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{ value.id }}
            </th>
            <td class="px-6 py-4">{{ value.created_at }}</td>
            <td class="px-6 py-4">{{ value.short_description }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <Pagination :pages="fetchedData.meta" @set-page="setPage" />
  </aside>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import { $vfm } from "vue-final-modal";
import VModal from "./modal/VModal.vue";
import VTitle from "./modal/VTitle.vue";
import VContent from "./modal/VContent.vue";
import router from "@/router";
import Pagination from "@/components/Pagination.vue";
import axios from "axios";

export default defineComponent({
  name: "Sidebar",
  components: {Pagination},
  data() {
    return {
      fetchedData: []
    }
  },
  props: {
    title: String,
    model: String
  },
  async mounted() {
    await this.fetchData()
  },
  methods: {
    async fetchData() {
      try {
        const result = await axios.get(`/api/core/${this.model}/sidebar/`, {
          params: {
            'page': this.$route.query.page || 1
          }
        })
        this.fetchedData = result.data
        console.log(this.fetchedData)
      } catch (error) {
        console.error(error)
      }
    },
    setPage(page) {
      this.$router.replace(`${this.$route.path}?page=${page}`)
      this.fetchData()
    },
    onOpenDetail(id: number) {
      router.push({ name: this.$route.meta.detailUrl, params: { id } })
    },
    onCreateNew() {
      alert(this.model)
    },
    onShowFilters() {
      $vfm.show({
        component: VModal,
        on: {
          confirm(close) {
            close()
          },
        },
        slots: {
          title: {
            component: VTitle,
            bind: {
              text: 'Hello, vue-final-modal'
            }
          },
          default: {
            component: VContent,
          }
        }
      })
    }
  }
})
</script>

<style scoped>
</style>
