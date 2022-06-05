import {defineStore} from 'pinia'

export const useThemeStore = defineStore({
    id: 'theme',
    state: () => ({
        darkTheme: localStorage.getItem('dark-theme') === 'true' || false
    }),
    getters: {
        isDark: (state) => state.darkTheme
    },
    actions: {
        switchTheme() {
            this.darkTheme = !this.darkTheme
            localStorage.setItem('dark-theme', (this.darkTheme).toString())
        }
    }
})
