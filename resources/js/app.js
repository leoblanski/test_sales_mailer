import './bootstrap';
import { createApp } from 'vue';

import VueRouter from 'vue-router'
import App from './view/App.vue'
import router from './routers'

const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
app.component('app', App);


app.use(router).mount('#app');
