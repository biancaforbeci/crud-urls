const Welcome = () => import('./components/Welcome.vue')
const UrlList = () => import('./components/url/List.vue')
const UrlCreate = () => import('./components/url/Add.vue')
const UrlEdit = () => import('./components/url/Edit.vue')
const Response = () => import('./components/url/Response.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'urlList',
        path: '/url',
        component: UrlList
    },
    {
        name: 'urlEdit',
        path: '/url/:id/edit',
        component: UrlEdit
    },
    {
        name: 'urlAdd',
        path: '/url/add',
        component: UrlCreate
    },
    {
        name: 'response',
        path: '/url/:id/responses',
        component: Response
    }
]
