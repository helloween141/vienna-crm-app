export default [{
    path: '/tasks/:id/',
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
}, {
    path: '/tasks/',
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
}]