import { createRouter, createWebHistory } from "vue-router";

import escuelasRouter from '../modules/Escuela/router'
import alumnosRouter from '../modules/Alumno/router'

import Home from '../views/Home.vue'
import { useAuthStore } from "../stores/auth";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import("../views/Login.vue")
    },
    {
        path: '/escuelas',
        ...escuelasRouter
    },
    {
        path: '/alumnos',
        ...alumnosRouter
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();
    if(localStorage.getItem('logged')){
        await authStore.getUser();
    }
    const isAuthenticated = authStore.isAuthenticated;
    if (!isAuthenticated && to.name !== 'Login') {
        // Si el usuario no está autenticado y no está yendo a la página de login, redirigir a login
        next({ name: 'Login' });
    } else if (isAuthenticated && to.name === 'Login') {
        // Si el usuario está autenticado y está yendo a la página de login, redirigir al inicio o dashboard
        next({ name: 'Home' }); // Asumiendo que la ruta del inicio o dashboard se llama 'home'
    } else {
        // En cualquier otro caso, proceder con la navegación
        next();
    }
});

export default router;
