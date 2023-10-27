import { createRouter, createWebHistory } from 'vue-router'
import Menu from '../views/Menu.vue'
import TableStatus from '../views/TableStatus.vue'
import Wait from '../views/Wait.vue'
import OrderStatus from '../views/OrderStatus.vue'
import UpdateStock from '../views/UpdateStock.vue'
import Products from '../views/Products.vue'

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes: [
        {
            path: '/',
            redirect: '/Menu'
        },
        {
            path: '/Menu/:table_number/:token',
            component: Menu
        },
        {
            path: '/TableStatus',
            component: TableStatus
        },
        {
            path: '/Wait',
            component: Wait
        },
        {
            path: '/OrderStatus',
            component: OrderStatus
        },
        {
            path: '/UpdateStock',
            component: UpdateStock
        },
        {
            path: '/Products',
            component: Products
        },
    ]
})

export default router