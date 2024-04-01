<script setup>
import Nav from './components/Nav.vue';

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
// initialize components based on data attribute selectors
onMounted(async () => {
    initFlowbite();
})
</script>

<template>
    <main>
        <Nav />
        <RouterView />
    </main>
</template>
