import {defineStore} from 'pinia'
import axios from "axios";

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
        getUser() {
            return axios.get('api/user').then(({data}) => {
                this.auth = true
                this.user = data
                console.log(data)
            }).catch(e => {
                console.log(e)
            })
        },
        logout() {
            return axios.post('api/logout').then(() => {
                this.auth = false
                this.user = {}
            })
        }
    }
})
