<script setup>
    import { useAuthStore } from '../stores/auth';
    const authStore = useAuthStore();
</script>
<template>
    <div class="mt-24 flex justify-center">
        <p class="text-center text-2xl font-semibold">Bienvenido <span class="text-red-700">{{ authStore.authUser.name }}</span>, ahora puede gestionar

            <router-link :to="{name: 'Escuelas'}" class="text-blue-700 underline">Escuelas</router-link>

            y

            <router-link :to="{name: 'Alumnos'}" class="text-blue-700 underline">Alumnos</router-link>.</p>

    </div>
</template>
