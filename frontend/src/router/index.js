import { createRouter, createWebHistory } from 'vue-router'
import Menu from '../views/Menu.vue'
import Check from '../views/Check.vue'
import Wait from '../views/Wait.vue'

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes: [
        {
            path: '/',
            redirect: '/Menu'
        },
        {
            path: '/Menu',
            component: Menu
        },
        {
            path: '/Check',
            component: Check
        },
        {
            path: '/Wait',
            component: Wait
        }
    ]
})

export default router