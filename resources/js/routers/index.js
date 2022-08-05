import { createWebHistory, createRouter } from "vue-router";
import Home from '../view/Home.vue'
import Employee from '../view/Employee.vue'

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
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
export default router;