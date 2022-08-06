import './bootstrap';
import { createApp } from 'vue';
import VueRouter from 'vue-router'
import App from './view/App.vue'
import router from './routers'
import Loader from './components/Loader.vue'

const app = createApp({});

app.component('app', App);
app.component('loader', Loader);

app.use(router).mount('#app');
