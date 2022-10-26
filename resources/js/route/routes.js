import {createRouter, createWebHistory} from 'vue-router';

const Home = () => import('../pages/home.vue');
const Index = () => import('../pages/index.vue');
const Edit = () => import('../pages/edit.vue');

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'index',
        path: '/todo',
        component: Index
    },
    {
        name: 'Edit',
        path: '/todo/:id/edit',
        component: Edit
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;