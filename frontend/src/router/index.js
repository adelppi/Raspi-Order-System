import { createRouter, createWebHistory } from 'vue-router'
import Menu from '../views/Menu.vue'
import Check from '../views/Check.vue'
import Wait from '../views/Wait.vue'
import OrderStatus from '../views/OrderStatus.vue'

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes: [
        {
            path: '/',
            redirect: '/Menu'
        },
        {
            path: '/:table_number/Menu',
            component: Menu
        },
        {
            path: '/Check',
            component: Check
        },
        {
            path: '/Wait',
            component: Wait
        },
        {
            path: '/OrderStatus',
            component: OrderStatus
        }
    ]
})

export default router