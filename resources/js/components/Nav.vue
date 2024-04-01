<script setup>
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();

</script>
<template>
    <nav class="bg-white border-gray-20">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <router-link to="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://qualitahub.com/wp-content/uploads/QualitaHUB-Logotipo.png" class="h-8"
                    alt="Flowbite Logo" />
            </router-link>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Abrir el menú</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <template v-if="authStore.isAuthenticated">
                        <li>
                            <router-link :to="{ name: 'Home' }" active-class="text-blue-700"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Inicio</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'Escuelas' }" active-class="text-blue-700"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Escuelas</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'Alumnos' }" active-class="text-blue-700"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Alumnos</router-link>
                        </li>
                        <li>
                            <a href="#" @click="authStore.handleLogout"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Salir</a>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <router-link :to="{ name: 'Login' }" active-class=""
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Log
                                in</router-link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>
