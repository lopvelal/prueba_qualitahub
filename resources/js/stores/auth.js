import { computed, ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';
import router from '../router';

export const useAuthStore = defineStore("auth", () => {

    const authUser = ref(null);
    const authErrors = ref(null);

    const isAuthenticated = computed(() => !!authUser.value);
    const errores = computed(() => authErrors.value);

    const getToken = async () => {
        await axios.get('/sanctum/csrf-cookie');
    }

    const getUser = async () => {
        getToken();
        const data = await axios.get('api/user');
        authUser.value = data.data;
    }

    const handleLogin = async (data) => {
        authErrors.value = null;
        getToken();
        try {
            await axios.post('/login', {
                email: data.email,
                password: data.password
            })
            authUser.value = getUser();
            localStorage.setItem('logged', true);
            router.push('/');
        } catch (error) {
            if (error.response.status === 422) {
                authErrors.value = error.response.data.errors;
            }
        }
    }
    const handleLogout = async () => {
        localStorage.removeItem('logged');
        await axios.post('/logout');
        authUser.value = false;
        router.push('/login');
    }

    return {
        authUser,
        authErrors,
        isAuthenticated,
        errores,
        getUser,
        getToken,
        handleLogin,
        handleLogout
    }
}
);
