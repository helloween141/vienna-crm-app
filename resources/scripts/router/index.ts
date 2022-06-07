import {createRouter, createWebHistory} from 'vue-router'
import DashboardView from '../views/DashboardView.vue'
import {useUserStore} from "@/stores/user";

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
            path: '/login',
            name: 'login',
            component: () => import('../views/LoginView.vue'),
            meta: {
                middleware: 'guest',
                title: 'Авторизация'
            }
        },
        {
            path: '/tasks/:id',
            name: 'task',
            component: () => import('../views/TasksView.vue'),
            meta: {
                middleware: 'auth',
                title: 'Обращение'
            }
        },
        {
            path: '/tasks',
            name: 'tasks',
            component: () => import('../views/TasksView.vue'),
            meta: {
                middleware: 'auth',
                title: 'Обращения'
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title}`
    const userStore = useUserStore()
    userStore.getUser().then(() => {
        if (to.meta.middleware === 'guest') {
            if (userStore.isAuth) {
                next({name: 'dashboard'})
            }
            next()
        } else {
            if (userStore.isAuth) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    })
})

export default router
