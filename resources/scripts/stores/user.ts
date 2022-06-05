import {defineStore} from 'pinia'

export interface User {
}

export interface UserState {
    auth: boolean | false,
    user: User | {}
}

export const useUserStore = defineStore({
    id: 'user',
    state: (): UserState => ({
        auth: false,
        user: {}
    }),
    getters: {
        isAuth: (state) => state.auth,
        getUserData: (state) => state.user
    },
    actions: {
        login() {

        },
        logout() {
        }
    }
})
