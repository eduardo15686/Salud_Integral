<template></template>
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