/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import VueMask from '@devindex/vue-mask'; // <-- ADD THIS LINE

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Pagination from 'v-pagination-3';




/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

app.use(VueMask);  // <-- ADD THIS LINE
app.use(VueSweetalert2);

app.component('pagination', Pagination);


import Especialista from './components/clientes/Especialista.vue';
app.component('especialista', Especialista);

import Administrar from './components/usuarios/Administrar.vue';
app.component('administrar', Administrar);

import Perfilador from './components/usuarios/Perfilador.vue';
app.component('perfilador', Perfilador);

import Servicios from './components/usuarios/Servicio.vue';
app.component('servicios', Servicios);

import Horario from './components/agenda/Horario.vue';
app.component('horario', Horario);

import Password from './components/clientes/Password.vue';
app.component('password', Password);

import ProcesoCitas from './components/Inicio.vue';
app.component('generar-cita', ProcesoCitas);

import ProcesoCitaId from './components/InicioId.vue';
app.component('cita-id', ProcesoCitaId);

import Agenda from './components/agenda/Agenda.vue';
app.component('agenda', Agenda);

import Pacientes from './components/pacientes/Paciente.vue';
app.component('pacientes', Pacientes);

import Principal from './components/Principal.vue';
app.component('principal', Principal);



// Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
