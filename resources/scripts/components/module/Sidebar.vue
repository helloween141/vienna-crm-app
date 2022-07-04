<template>
  <aside class="flex-shrink-0 hidden w-1/3 bg-white border-r dark:border-gray-700 dark:border-primary-darker dark:bg-gray-900 md:block pr-5 pt-5" aria-label="Sidebar">
    <div v-if="loading">
      <Spinner/>
    </div>
    <div v-else-if="!loading && fetchedData">
      <div class="flex mb-2 justify-between">
        <div>
          <span class="text-2xl dark:text-white">{{ fetchedData.title }}</span>
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
              <th v-for="(name, key) in fetchedData.headers"
                   :key="key"
                   scope="col"
                   class="px-6 py-3"
              >
                {{ name }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="value in fetchedData.data"
                @click="onOpenDetail(value.id)"
                :key="value.id"
                class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 dark:border-gray-700 cursor-pointer"
                :class="{'dark:bg-gray-600 bg-gray-100': value.id === selectedId}"
            >
              <td v-for="(v, i, key) in value"
                  :key="key"
                  v-show="fetchedData.headers[i]"
                  class="px-6 py-4"
              >
                {{ v }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :pages="fetchedData.meta" @set-page="setPage" />
    </div>
    <div v-else>
      <span class="dark:text-white">Ничего не найдено!</span>
    </div>
  </aside>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import { $vfm } from "vue-final-modal";
import VModal from "../ui/modal/VModal.vue";
import VTitle from "../ui/modal/VTitle.vue";
import VContent from "../ui/modal/VContent.vue";
import Pagination from "@/components/ui/Pagination.vue";
import axios from "axios";
import Spinner from "@/components/ui/Spinner.vue";

export default defineComponent({
  name: "Sidebar",
  components: {Spinner, Pagination},
  data() {
    return {
      fetchedData: {},
      selectedId: 0,
      loading: false
    }
  },
  props: {
    model: String,
    detailRouteName: String
  },
  async mounted() {
    this.$watch(
        () => this.$route.params,
        async () => {
          this.selectedId = parseInt(this.$route.params.id)
          await this.fetchData()
        },
        {
          immediate: true
        }
    )
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const result = await axios.get(`/api/core/${this.model}/sidebar/`, {
          params: {
            'page': this.$route.query.page || 1
          }
        })
        this.fetchedData = result.data
        this.loading = false
        console.log(this.fetchedData)
      } catch (error) {
        console.error(error)
      }
    },
    setPage(page) {
      this.$router.push({ name: this.detailRouteName, query: { page } })
    },
    onOpenDetail(id: number) {
      this.$router.push({ name: this.detailRouteName, params: { id } })
    },
    onCreateNew() {
      this.$router.push({ name: this.fetchedData.url})
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
