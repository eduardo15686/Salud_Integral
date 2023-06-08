<template>
    <div class="card">
        <div class="card-body">
            <h3>Cambio de contraseña</h3>
            <br>
            <div class="row row_margin">
                <div class="form-floating">
                    <input type="password" class="form-control" id="contraseñaActual" placeholder="Password"
                        v-model="password.old_password">
                    <label for="contraseñaActual">Contraseña Actual</label>
                </div>

                <div class="form-floating" style="margin-top: 25px;">
                    <input type="password" class="form-control" id="nuevaContraseña" placeholder="Password"
                        v-model="password.new_password">
                    <label for="nuevaContraseña">Nueva Contraseña</label>
                </div>

                <div class="form-floating" style="margin-top: 25px;">
                    <input type="password" class="form-control" id="repetirContraseña" placeholder="Password"
                        v-model="password.new_password_confirmation">
                    <label for="repetirContraseña">Repetir Nueva Contraseña</label>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <button type="button" class="btn btn-primary" style="float: right;" @click="updatePassword()">Cambiar
                    Contraseña</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['opciones', 'opcionesboton'],

    data() {
        return {
            path_url: window.vue_url,
            password: {},
        }
    },
    methods: {

        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        clear() {
            this.password.new_password_confirmation = '';
            this.password.new_password = '';
            this.password.old_password = '';
        },

        async updatePassword() {
            const thisVue = this;
            await axios
                .post(thisVue.path_url + "/api/especialista/updatePassword", thisVue.password)
                .then((res) => {
                    this.$swal(
                        'Contraseña Cambiada',
                        'La contraseña se cambio de manera correcta',
                        'success'
                        
                    );
                    thisVue.clear();
                })

                .catch((error) => {
                    console.log(error.response.data.errors)
                });
        },
    },
    async mounted() {
    }
}
</script>
<style></style>