import { createWebHistory, createRouter } from "vue-router";
import Home from '../view/Home.vue'
import Employee from '../view/employee/Employee.vue'
import Order from '../view/order/Order.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/employees',
        name: 'employees',
        component: Employee,
    },
    {
        path: '/orders',
        name: 'order',
        component: Order,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
export default router;