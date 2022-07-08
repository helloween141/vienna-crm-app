export default [{
    path: '/constants/:id?',
    name: 'constants',
    component: () => import('../views/DefaultView.vue'),
    meta: {
        middleware: 'auth',
        title: 'Константы',
        singleTitle: 'Константа',
        moduleUrl: 'constant',
        breadCrumb(route) {
            const paramId = route.params.id
            let result = [
                {
                    text: 'Константы',
                    link: '/constants/'
                },
            ]

            if (paramId) {
                result.push({
                    text: paramId,
                    link: ''
                })
            }
            return result
        }
    }
}]