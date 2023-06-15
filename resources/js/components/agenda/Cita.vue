<template>
    <div class="card">
        <div class="card-body">
            <h3>Agenda</h3>
        </div>
    </div>
</template>
<script>
export default {
    props: ['opciones', 'opcionesboton'],

    data() {
        return {
            path_url: window.vue_url,
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },
    },
    async mounted() {
        
    }
}
</script>
<style></style>