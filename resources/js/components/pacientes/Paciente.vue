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
            pacientes: []

        }

    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        openModalPacienteNuevo() {
            $("#modalNuevoPaciente").modal("show");
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
                    $("#modalNuevoPaciente").modal("hide");
                })

                .catch((error) => { });
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