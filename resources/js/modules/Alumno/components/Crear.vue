<template>
    <div>
        <form @submit.prevent="guardarCambios" class="mt-8 max-w-xl mx-auto">
            <div v-if="errores" class="mt-4 mb-4">
                <p class="text-red-700 font-semibold" v-for="(error) in errores">
                    {{ error[0] }}
                </p>
            </div>
            <div class="mt-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
                <input id="nombre" v-model="alumno.nombre" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Nombre" required />
            </div>
            <div class="mt-4">
                <label for="apellidos" class="block mb-2 text-sm font-medium text-gray-900 ">Apellidos</label>
                <input id="apellidos" v-model="alumno.apellidos" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Apellidos" required />
            </div>
            <div class="mt-4">
                <label for="fecha_nacimiento"
                    class="block mb-2 text-sm font-medium text-gray-900 ">fecha_nacimiento</label>
                <input id="fecha_nacimiento" v-model="alumno.fecha_nacimiento" type="date"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="fecha_nacimiento" required />
            </div>
            <div class="mt-4">
                <label for="ciudad_natal" class="block mb-2 text-sm font-medium text-gray-900 ">Ciudad natal</label>
                <input id="ciudad_natal" v-model="alumno.ciudad_natal" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ciudad natal" required />
            </div>
            <div class="mt-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Escuela</label>
                <select id="countries" v-model="alumno.escuela_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option v-for="escuela in escuelas" :key="escuela.id" :value="escuela.id">
                        {{ escuela.nombre }}
                    </option>
                </select>
            </div>
            <div class="mt-10 flex justify-between">
                <button @click="volver()" type="button"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancelar</button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Añadir</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const escuelas = ref();

const errores = ref({});

// Estado reactivo para el alumno
const alumno = ref({
    escuela_id: 1
});

const obtenerEscuelas = async () => {
    try {
        const response = await axios.get(`/api/escuelas`);
        escuelas.value = response.data;
    } catch (error) {
        console.error("Error al cargar las escuelas:", error);
    }
}

const volver = () => {
    router.go(-1);
}

onMounted(async () => {
    await obtenerEscuelas();
})

// Método para guardar los cambios
const guardarCambios = async () => {
    try {
        await axios.post('/api/alumno', alumno.value);
        alert('Alumno añadido correctamente');
        router.push({ name: 'Alumnos' })
    } catch (error) {
        errores.value = error.response.data;
    }
};
</script>
