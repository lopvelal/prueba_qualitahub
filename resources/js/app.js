import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'
import { createPinia } from 'pinia'
import router from './router'

const app = createApp(App);

const pinia = createPinia();
app.use(pinia);

// Ahora que el estado inicial está listo, monta la aplicación
app.use(router);
app.mount('#app');
