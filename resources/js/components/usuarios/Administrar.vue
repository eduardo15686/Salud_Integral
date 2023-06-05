<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Administración de Usuarios</h5>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in tabla_users">
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.estatus }}</td>
                            <td>{{ item.perfil.nombre_perfil }}</td>
                            <td v-if="item.estatus == 'Activo'"><a v-for="icon in opciones"
                                    style="padding-left: 10px; cursor:pointer;"><i :class="icon.class + ' pointer ml-2'"
                                        :title="icon.text_html" aria-hidden="true"
                                        @click.capture="disparador(icon.function, item)"></i></a></td>
                            <td v-else>
                                <a style="padding-left: 10px; cursor:pointer; font-size: large;">
                                    <i title="Reactivar Especialista" class='ml-2 ti ti-check' aria-hidden="true"
                                        @click=""></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuariolLabel">Nuevo Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNombre"
                                        placeholder="Nombre Completo" v-model="nombre">
                                    <label for="floatingNombre">Nombre Completo</label>
                                </div>
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingCorreo" placeholder="Correo"
                                        v-model="correo">
                                    <label for="floatingCorreo">Correo</label>
                                </div>
                                <div class="form-floating">
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" placeholder="Contraseña"
                                                aria-label="Nombre de usuario del destinatario"
                                                aria-describedby="button-addon2" id="floatingContraseña" v-model="password">
                                            <label for="floatingContraseña">Contraseña</label>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm" type="button"
                                            @click="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">

                                        <div>
                                            <!-- <select v-model="perfil_id" class="form-select">
                                                <option selected>Selecciona un perfil</option>
                                                <option v-for="permiso in perfiles" :value="permiso.id">{{
                                                    permiso.nombre_perfil }}
                                                </option>
                                            </select> -->
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <ul>
                                <li v-for="error in errors"><strong>{{ error[0] }}</strong></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="registrarUsuario()">Registrar
                                Usuario</button>
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
            tabla_users: [],
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

        mostrarPassword() {
            var cambio = document.getElementById("floatingContraseña");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        },

        openModalUsuarioNuevo() {
            $("#modalNuevoUsuario").modal("show");
        },

        async getUsuarios() {
            const thisVue = this;
            await axios.get(thisVue.path_url + `/api/usuarios/getUsuarios`)
                .then(res => {
                    thisVue.tabla_users = res.data;

                })
                .catch(error => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                    console.log(this.errors);
                });
        },

        async registrarUsuario() {
            const thisVue = this;
            const obj = {
                name: this.nombre,
                email: this.correo,
                password: this.password,
                perfil_id: 1
            }
            await axios.post(thisVue.path_url + `/api/usuarios/nuevoUsuario`, obj)
                .then(res => {
                    this.$swal(
                        'Agregar Usuario',
                        res.data.message,
                        'success'
                    );
                    $("#modalNuevoUsuario").modal("hide");
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