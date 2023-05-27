/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import { VueMaskDirective } from 'v-mask'
app.directive('mask', VueMaskDirective);


import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import Especialista from './components/clientes/Especialista.vue';
app.component('especialista', Especialista);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('cliente', require('./components/clientes/cliente.vue').default);
// Vue.component('prospecto', require('./components/clientes/prospecto.vue').default);
// Vue.component('usuario', require('./components/configuracion/usuario.vue').default);
// Vue.component('amortizacion', require('./components/configuracion/amortizacion.vue').default);
// Vue.component('empresa', require('./components/empresas/empresa.vue').default);
// Vue.component('control-credito', require('./components/control-creditos/control-credito.vue').default);
// Vue.component('validacion-creditos', require('./components/validacion-creditos/validacion-creditos.vue').default);
// Vue.component('seguimientos-pagos', require('./components/seguimientos-pagos/seguimientos-pagos.vue').default);
// Vue.component('lista-pagos', require('./components/lista-pagos/lista-pagos.vue').default);
// Vue.component('lista-retencion', require('./components/lista-retencion/lista-retencion.vue').default);
// Vue.component('creditos-en-covertura', require('./components/creditos-en-covertura/creditos-en-covertura.vue').default);
// Vue.component('creditos-activos', require('./components/creditos-activos/creditos-activos.vue').default);
// Vue.component('consulta-rapida', require('./components/consulta-rapida/consulta-rapida.vue').default);
// Vue.component('compra-deuda', require('./components/compra-deuda/compra-deuda.vue').default);
// Vue.component('modal-eliminar', require('./components/modales/modal-eliminar.vue').default);
// Vue.component('modal-select-creditos', require('./components/modales/modal-select-creditos.vue').default);
// Vue.component('administrar', require('./components/usuarios/administrar.vue').default);
// Vue.component('perfilador', require('./components/usuarios/perfilador.vue').default);
// Vue.component('periodos', require('./components/configuracion/periodos.vue').default);

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
