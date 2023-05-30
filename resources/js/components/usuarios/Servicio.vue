<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Administración de Servicios</h5>
            <div class="row row_margin">
                <div class="col-md-12">
                    <div v-for="icon in opcionesboton" class="col-auto">
                        <button type="button" class="btn btn-success float-end mb-2 ms-2"
                            @click.capture="disparador(icon.function)">
                            <i :class="icon.class + ' pointer me-2'" aria-hidden="true"></i>{{ icon.text_html }}
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in tablaServicios">
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.text_html }}</td>
                            <td><a v-for="icon in opciones" style="padding-left: 10px;"><i
                                        :class="icon.class + ' pointer ml-2'" :title="icon.text_html" aria-hidden="true"
                                        @click.capture="disparador(icon.function, item)"></i></a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modalNuevoServicio" tabindex="-1" aria-labelledby="modalNuevoServicioLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoServiciolLabel">Nuevo Servicio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNombre"
                                        placeholder="Nombre Completo" v-model="nombre">
                                    <label for="floatingNombre">Nombre del Servicio</label>
                                </div>
                            </form>
                            <ul>
                                <li v-for="error in errors"><strong>{{ error[0] }}</strong></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="nuevoServicio()">Crear
                                Servicio</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarUsuarioLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarUsuarioLabel">Eliminar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar al usuario <b>{{ userSelected.name }}</b>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" @click="eliminarUsuario()">Eliminar
                                Usuario</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['opciones', 'opcionesboton'],

    data() {
        return {
            nombre: '',
            correo: '',
            password: '',
            perfil_id: '',
            path_url: window.vue_url,
            errors: [],
            tablaServicios: [],
            userSelected: {},
            perfiles: [],
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        openModalEliminarUsuario(item) {
            this.userSelected = item;
            $("#modalEliminarUsuario").modal("show");
        },
        openModalEditarServicio(){
            console.log('editar servicio')
        },

        mostrarPassword() {
            var cambio = document.getElementById("floatingContraseña");
            console.log(cambio);
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        },

        openModalServicioNuevo() {
            $("#modalNuevoServicio").modal("show");
        },

        async getUsuarios() {
            const thisVue = this;
            await axios.get(thisVue.path_url + `/api/servicios/getServicios`)
                .then(res => {
                    thisVue.tablaServicios = res.data;
                })
                .catch(error => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                    console.log(this.errors);
                });
        },

        async nuevoServicio() {
            const thisVue = this;
            const objeto = {
                nombre: thisVue.nombre
            }
            await axios.post(thisVue.path_url + `/api/servicios/nuevoServicio`, objeto)
                .then(res => {
                    this.$swal(
                        'Agregar Servicio',
                        res.data.message,
                        'success'
                    );
                    $("#modalNuevoServicio").modal("hide");
                    thisVue.getUsuarios();
                })
                .catch(error => {

                });
        },

        eliminarUsuario() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/usuarios/deleteUsuario', thisVue.userSelected)
                .then((res) => {
                    this.$swal(
                        'Eliminar Usuario',
                        res.data.message,
                        'success'
                    );
                    $("#modalEliminarUsuario").modal("hide");
                    thisVue.getUsuarios();
                })
                .catch((error) => {

                });
        },

    },
    async mounted() {
        await this.getUsuarios();
    }
}
</script>
<style></style>