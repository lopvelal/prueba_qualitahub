<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { RouterView } from 'vue-router';


const items = ref([]); // Inicializa items como un array vacío
const pagination = ref({});
const cargarEscuelas = async (url = '/api/escuela') => {
    try {
        const escuelas = await axios.get(url);
        items.value = escuelas.data.data;
        pagination.value = {
            current_page: escuelas.data.current_page,
            last_page: escuelas.data.last_page,
            per_page: escuelas.data.per_page,
            next_page_url: escuelas.data.next_page_url,
            prev_page_url: escuelas.data.prev_page_url,
            total: escuelas.data.total,
            from: escuelas.data.from,
            to: escuelas.data.to,
        };
    } catch (error) {
        console.error("Error al cargar las escuelas:", error);
    }
};

const eliminarEscuela = async (id) => {
    try {
        const validacion = confirm('Estás seguro que quieres elminar el registro');
        if (validacion) {
            await axios.delete('/api/escuela/' + id);
            if (items.value.length > 1) {
                await cargarEscuelas(`/api/escuela?page=${pagination.value.current_page}`);
            } else {
                await cargarEscuelas(pagination.value.prev_page_url);
            }
        }
    } catch (error) {
        console.error("Error al cargar las escuelas:", error);
    }
}

onMounted(async () => {
    await cargarEscuelas();
})


</script>

<template>
    <div class="mt-16 mb-6 flex justify-center">
        <router-link :to="{ name: 'Escuela.crear' }"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Añadir escuela
        </router-link>
    </div>
    <div class="flex justify-center">

        <div class=" mb-24 w-5/6 max-xl:w-full">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-slate-300 uppercase bg-slate-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dirección
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Teléfono
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Web
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="item in items" :key="item.id">
                            <td class="px-6 py-4">
                                {{ item.id }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ item.nombre }}
                            </th>
                            <td class="px-6 py-4">
                                {{ item.direccion }}
                            </td>
                            <td class="px-6 py-4">
                                <img class="w-[100px]" :src="item.logotipo" alt="">
                            </td>
                            <td class="px-6 py-4">
                                {{ item.telefono }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.web }}
                            </td>
                            <td class="px-6 py-4">
                                <router-link :to="{ name: 'Escuela.editar', params: { 'id': item.id } }"
                                    class="font-medium text-blue-600 hover:underline">Editar</router-link>
                                <a @click="eliminarEscuela(item.id)" href="#"
                                    class="ml-6 font-medium text-red-600 hover:underline">Eliminar</a>
                            </td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50 border-b">

                        </tr>
                    </tbody>
                </table>
                <div class="mt-4 mb-4 flex flex-col items-center">
                    <!-- Help text -->
                    <span class="text-sm text-gray-700">
                        Mostrando del
                        <span class="font-semibold text-gray-900">{{ pagination.from }}</span> al
                        <span class="font-semibold text-gray-900">{{ pagination.to }}</span> de entre <span
                            class="font-semibold text-gray-900">{{ pagination.total }}</span> registros
                    </span>
                    <!-- Buttons -->
                    <div class="inline-flex mt-4 xs:mt-0">

                        <button @click="cargarEscuelas(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                            :class="['mr-24 flex items-center justify-center px-3 h-8 text-sm font-medium',
            { 'text-blue-950 bg-slate-200 border-solid border-2 border-blue-950 rounded-s hover:bg-gray-900 hover:text-slate-200': pagination.prev_page_url }]">Anterior</button>
                        <button @click="cargarEscuelas(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                            :class="['flex items-center justify-center px-3 h-8 text-sm font-medium',
            { 'text-blue-950 bg-slate-200 border-solid border-2 border-blue-950 rounded-s hover:bg-gray-900 hover:text-slate-200': pagination.next_page_url }]">Siguiente</button>
                    </div>
                </div>
            </div>
        </div>
        <RouterView />
    </div>
</template>
