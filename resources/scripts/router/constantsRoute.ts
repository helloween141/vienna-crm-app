export default [{
    path: '/constants/',
    name: 'constants',
    component: () => import('../views/ConstantsView.vue'),
    meta: {
        middleware: 'auth',
        title: 'Константы',
        detailUrl: 'constant',
        breadCrumb() {
            return [
                {
                    text: 'Константы',
                    link: '/constants/'
                }
            ]
        }
    }
}, {
    path: '/constants/:id/',
    name: 'constant',
    component: () => import('../views/ConstantsView.vue'),
    meta: {
        middleware: 'auth',
        title: 'Обращение',
        breadCrumb(route) {
            const paramConstantId = route.params.id
            return [
                {
                    text: 'Константы',
                    link: '/constants/'
                },
                {
                    text: paramConstantId,
                }
            ]
        }
    }
}]