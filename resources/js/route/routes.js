import {createRouter, createWebHistory} from 'vue-router';

const Home = () => import('../pages/home.vue');
const Index = () => import('../pages/index.vue');

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'index',
        path: '/todo',
        component: Index,
        props: true
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;