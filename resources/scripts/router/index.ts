import {createRouter, createWebHistory} from 'vue-router'
import DashboardView from '../views/DashboardView.vue'
import {useUserStore} from "@/stores/user";
import tasksRoute from "@/router/tasksRoute";
import constantsRoute from "@/router/constantsRoute";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: DashboardView,
            meta: {
                middleware: 'auth',
                title: 'Главная'
            }
        },
        {
            path: '/login/',
            name: 'login',
            component: () => import('../views/LoginView.vue'),
            meta: {
                middleware: 'guest',
                title: 'Авторизация'
            }
        },
        ...tasksRoute,
        ...constantsRoute
    ]
});

router.beforeEach(async (to, from, next) => {
    try {
        document.title = `${to.meta.title}`
        const userStore = useUserStore()
        await userStore.getUserData()

        if (to.meta.middleware === 'guest') {
            if (userStore.auth) {
                next({name: 'dashboard'})
            }
            next()
        } else {
            if (userStore.auth) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    } catch (e) {
        console.log(e)
    }
})

export default router
