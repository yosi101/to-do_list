import { createRouter, createWebHistory } from 'vue-router';

import Home from '../pages/home.vue';
import Index from '../pages/index.vue';
import Login from '../pages/Auth/Login.vue';
import Register from '../pages/Auth/Register.vue';
import pageNotFound from '../pages/pageNotFound.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: {
            requiresAuth: false,
        }
    },
    {
        name: 'index',
        path: '/todo',
        component: Index,
        props: true,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            requiresAuth: false,
        }
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            requiresAuth: false,
        }
    },
    {
        name: pageNotFound,
        path: '/:pathMatch(.*)*',
        component: pageNotFound,
    }

]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return { name: 'login' }
    }

    if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
        return { name: 'index' }
    }

});

export default router;