import {defineStore} from 'pinia'

export interface ThemeState {
    isDark: boolean | false,
}

export const useThemeStore = defineStore({
    id: 'themeStore',
    state: (): ThemeState => ({
        isDark: localStorage.getItem('dark-theme') === 'true'
    }),
    actions: {
        switchTheme() {
            this.isDark = !this.isDark
            localStorage.setItem('dark-theme', (this.isDark).toString())
        }
    }
})
