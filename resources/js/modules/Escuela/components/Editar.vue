<template>
    <div class="mt-16">
        <form @submit.prevent="guardarCambios" enctype="multipart/form-data" class="mt-8 max-w-xl mx-auto">
            <div v-if="errores" class="mt-4 mb-4">
                <p class="text-red-700 font-semibold" v-for="(error) in errores">
                    {{ error[0] }}
                </p>
            </div>
            <div class="mt-8 flex justify-center" v-if="escuela.logotipo">
                <!-- Comprueba si tiene logotipo y lo muestra, sino no muestra nada -->
                <img class="w-[200px]" :src="escuela.logotipo" alt="">
            </div>
            <div class="mt-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
                <input id="nombre" v-model="escuela.nombre" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Nombre" required />
            </div>
            <div class="mt-4">
                <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 ">Dirección</label>
                <input id="direccion" v-model="escuela.direccion" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Dirección" required />
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Logotipo</label>
                <input @change="imagenSubida"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="file_input" type="file">

                <p class="mt-1 text-sm text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF
                    (MAX. 200x200px y 2MB).</p>
            </div>
            <div class="mt-4">
                <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 ">Teléfono</label>
                <input id="telefono" v-model="escuela.telefono" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Teléfono" required />
            </div>
            <div class="mt-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input id="email" v-model="escuela.email" type="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Email" required />
            </div>
            <div class="mt-4">
                <label for="web" class="block mb-2 text-sm font-medium text-gray-900 ">web</label>
                <input id="web" v-model="escuela.web" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="web" required />
            </div>
            <div class="mt-6 flex justify-between">

                <button @click="volver()" type="button"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancelar</button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Actualizar</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const errores = ref(null);

const id = route.params.id; //Obtenemos el id del elemento a editar
const escuela = ref({}); // datos de la escuela

const imagen = ref(null);

const imagenSubida = (event) => {
    imagen.value = event.target.files[0] || null;
}

const volver = () => {
    router.go(-1);
}

// Cargar los datos de la escuela cuando el componente se monte
onMounted(async () => {
    try {
        const response = await axios.get(`/api/escuela/${id}`);
        escuela.value = response.data;
    } catch (error) {
        console.error("Error al cargar la escuela:", error);
    }
});

// Método para guardar los cambios
const guardarCambios = async () => {
    try {
        const dataToSend = new FormData();
        if (imagen.value) {
            dataToSend.append('logotipo', imagen.value);
        }

        dataToSend.append('nombre', escuela.value.nombre);
        dataToSend.append('direccion', escuela.value.direccion);
        dataToSend.append('telefono', escuela.value.telefono);
        dataToSend.append('email', escuela.value.email);
        dataToSend.append('web', escuela.value.web);

        dataToSend.append('_method', 'PUT');

        await axios.post(`/api/escuela/${id}`, dataToSend);
        alert('Escuela actualizada correctamente');
        router.push({ name: 'Escuelas' })
    } catch (error) {
        errores.value = error.response.data;
    }
};
</script>
