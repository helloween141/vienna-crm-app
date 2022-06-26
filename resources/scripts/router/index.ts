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
                title: 'Обращение',
                breadCrumb(route) {
                    const paramTaskId = route.params.id
                    return [
                        {
                            text: 'Обращения',
                            link: '/tasks/'
                        },
                        {
                            text: paramTaskId,
                        }
                    ]
                }
            }
        },
        {
            path: '/tasks',
            name: 'tasks',
            component: () => import('../views/TasksView.vue'),
            meta: {
                middleware: 'auth',
                title: 'Обращения',
                detailUrl: 'task',
                breadCrumb() {
                    return [
                        {
                            text: 'Обращения',
                            link: '/tasks/'
                        }
                    ]
                }

            }
        }
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
