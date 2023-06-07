<template></template>
<script>
export default {
    props: ['opciones', 'opcionesboton'],

    data() {
        return {
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