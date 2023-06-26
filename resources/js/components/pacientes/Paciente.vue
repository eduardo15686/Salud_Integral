<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h3>Pacientes</h3>
                </div>
            </div>
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
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in pacientes">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.nombre }}</td>
                            <td>{{ item.celular }}</td>
                            <td>{{ item.correo }}</td>
                            <td><a v-for="icon in opciones"
                                    style="padding-right: 10px; cursor:pointer; font-size: large;"><i
                                        :class="icon.class + ' pointer ml-2'" :title="icon.text_html" aria-hidden="true"
                                        @click.capture="disparador(icon.function, item)"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal Nuevo Paciente-->
            <div class="modal fade" id="modalNuevoPaciente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="modalNuevoPacienteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoPacienteLabel">Datos del paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-floating col-md-12">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nombre"
                                        v-model="guardarInfoPaciente.nombre" required name="nombre" />
                                    <label for="floatingInput">Nombre Completo</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <input type="text" class="form-control" v-mask="'###-#######'" maxlength="11"
                                        id="floatingCel" placeholder="Celular Ej. (618-1234567)" v-model="guardarInfoPaciente.celular
                                            " required name="celular" />
                                    <label for="floatingCel">Celular Ej. (618-1234567)</label>
                                </div>

                                <div class="form-floating col-md-6">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" v-model="guardarInfoPaciente.correo" required
                                        name="correo" />
                                    <label for="floatingInput">Correo Electronico</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Selecciona una edad</label>
                                    <select class="form-select" aria-label="Default select example"
                                        v-model="guardarInfoPaciente.edad">
                                        <option v-for="item in edad" :value="item.value">{{ item.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Selecciona un sexo</label>
                                    <select class="form-select" aria-label="Default select example"
                                        v-model="guardarInfoPaciente.sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="guardarPaciente()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Nuevo Paciente-->

            <!-- Modal Editar Paciente-->
            <div class="modal fade" id="modalEditarPaciente" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="modalEditarPacienteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarPacienteLabel">Editar Paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-floating col-md-12">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nombre"
                                        v-model="infoPaciente.nombre" required name="nombre" />
                                    <label for="floatingInput">Nombre Completo</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <input type="text" class="form-control" v-mask="'###-#######'" maxlength="11"
                                        id="floatingCel" placeholder="Celular Ej. (618-1234567)" v-model="infoPaciente.celular
                                            " required name="celular" />
                                    <label for="floatingCel">Celular Ej. (618-1234567)</label>
                                </div>

                                <div class="form-floating col-md-6">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" v-model="infoPaciente.correo" required
                                        name="correo" />
                                    <label for="floatingInput">Correo Electronico</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Selecciona una edad</label>
                                    <select class="form-select" aria-label="Default select example"
                                        v-model="infoPaciente.edad">
                                        <option v-for="item in edad" :value="item.value">{{ item.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Selecciona un sexo</label>
                                    <select class="form-select" aria-label="Default select example"
                                        v-model="infoPaciente.sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="editarPaciente()">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Editar Paciente-->

            <!-- Modal Eliminar Paciente-->
            <div class="modal fade" id="modalEliminarPaciente" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="modalEliminarPacienteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarPacienteLabel">Eliminar Paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <b>Nombre:</b> {{ infoPaciente.nombre }}
                            </div>


                        </div>
                        <button type="button" class="btn btn-danger" @click="eliminarPaciente()">Eliminar</button>
                        <!-- <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" @click="editarPaciente()">Editar</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- End Modal Eliminar Paciente-->
        </div>
    </div>
</template>

<script>
export default {
    props: ['opciones', 'opcionesboton'],

    data() {
        return {
            path_url: window.vue_url,
            this_year: null,

            guardarInfoPaciente: {},
            edad: [],
            pacientes: [],
            infoPaciente: {}

        }

    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        openModalPacienteNuevo() {
            $("#modalNuevoPaciente").modal("show");
        },

        async openModalEditarPaciente(item) {
            const thisVue = this;

            await axios
                .get(
                    thisVue.path_url + "/api/pacientes/getPaciente/" + item.id
                )
                .then((res) => {
                    thisVue.infoPaciente = res.data;
                    $("#modalEditarPaciente").modal("show");
                })

                .catch((error) => { });
        },

        openModalEliminarPaciente(item) {
            this.infoPaciente = item;
            $("#modalEliminarPaciente").modal("show");
        },
        openModalExpediente(item) {
            console.log('expediente', item);
        },
        async getPacientes() {
            const thisVue = this;
            let llenarOptions = [];
            await axios.get(thisVue.path_url + `/api/pacientes/getPacientes`)
                .then(res => {
                    thisVue.pacientes = res.data;
                })
                .catch(error => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                    console.log(this.errors);
                });
        },
        async guardarPaciente() {
            const thisVue = this;
            await axios
                .post(
                    thisVue.path_url + "/api/pacientes/guardarPaciente",
                    thisVue.guardarInfoPaciente
                )
                .then((res) => {
                    this.$swal(
                        'Paciente Guardado',
                        res.data.message,
                        'success'
                    );
                    thisVue.getPacientes();
                    $("#modalNuevoPaciente").modal("hide");
                })

                .catch((error) => { });
        },
        async editarPaciente() {
            const thisVue = this;
            console.log(thisVue.infoPaciente);
            await axios
                .post(
                    thisVue.path_url + "/api/pacientes/editarPaciente",
                    thisVue.infoPaciente
                )
                .then((res) => {
                    this.$swal(
                        'Paciente Editado',
                        res.data.message,
                        'success'
                    );
                    thisVue.getPacientes();
                    $("#modalEditarPaciente").modal("hide");

                })

                .catch((error) => { });
        },

        async eliminarPaciente() {
            const thisVue = this;
            console.log(thisVue.infoPaciente);
            await axios
                .post(
                    thisVue.path_url + "/api/pacientes/eliminarPaciente",
                    thisVue.infoPaciente
                )
                .then((res) => {
                    this.$swal(
                        'Paciente Eliminado',
                        res.data.message,
                        'success'
                    );
                    thisVue.getPacientes();
                    $("#modalEliminarPaciente").modal("hide");

                })

                .catch((error) => { });
        },



        selectEdad() {
            for (let i = 0; i <= 100; i++) {
                this.edad.push({
                    value: i,
                    name: i
                })
            }
        },
    },
    async mounted() {
        this.selectEdad();
        this.getPacientes();
    }
}
</script>
<style></style>