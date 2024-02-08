import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { Pinia } from 'pinia';
createApp(App).use(Pinia).use(router).mount('#app');
