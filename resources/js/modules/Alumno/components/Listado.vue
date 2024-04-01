<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { RouterView } from 'vue-router';


const items = ref([]); // Inicializa items como un array vacío
const pagination = ref({});
const cargarAlumnos = async (url = '/api/alumno') => {
    try {
        const alumnos = await axios.get(url);
        items.value = alumnos.data.data;
        pagination.value = {
            current_page: alumnos.data.current_page,
            last_page: alumnos.data.last_page,
            per_page: alumnos.data.per_page,
            next_page_url: alumnos.data.next_page_url,
            prev_page_url: alumnos.data.prev_page_url,
            total: alumnos.data.total,
            from: alumnos.data.from,
            to: alumnos.data.to,
        };
    } catch (error) {
        console.error("Error al cargar los alumnos:", error);
    }
};

const eliminarAlumno = async (id) => {
    try {
        const validacion = confirm('Está seguro de que quiere eliminar el registro');
        if (validacion) {
            await axios.delete('/api/alumno/' + id);
            if (items.value.length > 1) {
                await cargarAlumnos(`/api/alumno?page=${pagination.value.current_page}`);
            } else {
                await cargarAlumnos(pagination.value.prev_page_url);
            }
        }
    } catch (error) {
        console.error("Error al cargar los alumnos:", error);
    }
}

onMounted(async () => {
    await cargarAlumnos();
})


</script>

<template>
    <div class="mt-16 mb-6 flex justify-center">
        <router-link :to="{ name: 'Alumno.crear' }"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Añadir alumno
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
                                Nombre y apellidos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Nacimiento
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ciudad Natal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Escuela
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
                                {{ item.nombre }}, {{ item.apellidos }}
                            </th>
                            <td class="px-6 py-4">
                                {{ item.fecha_nacimiento }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.ciudad_natal }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.escuela.nombre }}
                            </td>
                            <td class="px-6 py-4">
                                <router-link :to="{ name: 'Alumno.editar', params: { 'id': item.id } }"
                                    class="font-medium text-blue-600 hover:underline">Editar</router-link>
                                <a @click="eliminarAlumno(item.id)" href="#"
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

                        <button @click="cargarAlumnos(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                            :class="['mr-24 flex items-center justify-center px-3 h-8 text-sm font-medium',
            { 'text-blue-950 bg-slate-200 border-solid border-2 border-blue-950 rounded-s hover:bg-gray-900 hover:text-slate-200': pagination.prev_page_url }]">Anterior</button>
                        <button @click="cargarAlumnos(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                            :class="['flex items-center justify-center px-3 h-8 text-sm font-medium',
            { 'text-blue-950 bg-slate-200 border-solid border-2 border-blue-950 rounded-s hover:bg-gray-900 hover:text-slate-200': pagination.next_page_url }]">Siguiente</button>
                    </div>
                </div>
            </div>
        </div>
        <RouterView />
    </div>
</template>
