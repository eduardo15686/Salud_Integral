<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h1>Perfil</h1>
                </div>
                <div class="col-md-4">
                    <div v-for="icon in opcionesboton" class="col-auto">
                        <!-- <button type="button" class="btn btn-primary float-end mb-2 ms-2" style="background-color: #a1b6a7"
                            @click.capture="disparador(icon.function)">
                            <i :class="icon.class + ' pointer me-2'" aria-hidden="true"></i>{{ icon.text_html }}
                        </button> -->
                        <div v-if="banderaBoton != false" style="text-align: end;">
                            <button type="button" class="btn btn-secondary" style="background-color: #a1b6a7"
                                @click="addDatosEspecialista">
                                Agregar Información
                            </button>
                        </div>
                        <div v-else style="text-align: end;">
                            <button type="button" class="btn btn-secondary" style="background-color: #a1b6a7"
                                @click="editarDatosEspecialista">
                                Editar Información
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br />
            <div class="row" v-if="banderaBoton != false">
                <div class="col-md-8">
                    <p>Por favor asegurese de primero ingresar su información.</p>
                    <div class="col-md-8"></div>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombreCompleto" v-model="infoEspecialista.nombre"
                            disabled>
                        <label for="nombreCompleto">Nombre del Especialista</label>
                    </div>
                    <div class="form-floating mb-3">
                        <money3 type="text" class="form-control" id="montoDeposito" v-model="infoEspecialista.deposito"
                            v-bind="config" disabled></money3>
                        <label for="montoDeposito">Monto de Solicitud del Deposito</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="celular" v-mask="'###-#######'"
                            v-model="infoEspecialista.celular" disabled>
                        <label for="celular">Número de Contacto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="correo" v-model="infoEspecialista.correo" disabled>
                        <label for="correo">Correo Electronico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="correo" v-model="infoEspecialista.correo" disabled>
                        <label for="correo">Correo Electronico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="descripcion" v-model="infoEspecialista.descripcion"
                            disabled>
                        <label for="descripcion">Descripción</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="servicios" v-model="infoEspecialista.id_servicio"
                            disabled>
                        <label for="servicios">Servicios</label>
                    </div>
                </div>
                <div class="col-md-6"
                    style=" display: flex; justify-content: center; align-items: center; flex-direction: column;">
                    <img id="imagenPerfil" :src="imagenPerfil" style="width: 70%;" />
                    <p>Foto de Perfil</p>
                </div>
            </div>
            <!-- Modal Registrar Datos Especialista-->
            <div class="modal fade modal-lg" id="datosEspecialista" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="datosEspecialistaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="datosEspecialistaLabel">
                                Agregar Datos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h3>Datos Personales</h3>
                                <div class="form-floating col-md-4">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nombre"
                                        v-model="guardarEspecialista.nombre" />
                                    <label for="floatingInput">Nombre</label>
                                </div>
                                <div class="form-floating col-md-4">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Paterno"
                                        v-model="guardarEspecialista.paterno" />
                                    <label for="floatingInput">Apellido Paterno</label>
                                </div>
                                <div class="form-floating col-md-4">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Materno"
                                        v-model="guardarEspecialista.materno" />
                                    <label for="floatingInput">Apellido Materno</label>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCel"
                                            placeholder="Titulo/Especialidad" v-model="guardarEspecialista.titulo" />
                                        <label for="floatingCel">Titulo/Especialidad</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" v-mask="'###-#######'" maxlength="11"
                                            id="floatingCel" placeholder="Celular Ej. (618-1234567)" v-model="
                                                guardarEspecialista.celular
                                            " />
                                        <label for="floatingCel">Celular Ej. (618-1234567)</label>
                                    </div>
                                </div>
                                <div class="form-floating col-md-5">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" v-model="guardarEspecialista.correo" />
                                    <label for="floatingInput">Correo Electronico</label>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="formFileSm" class="form-label">Foto de Perfil</label>
                                    <input class="form-control form-control" id="formFileSm" type="file"
                                        @change="obtenerImagen" />
                                </div>
                                <div class="col-md-4" style="text-align: center">
                                    <div class="circular--landscape">
                                        <img :src="imagen" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h3>Información de Consulta</h3>

                            </div>
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <div class="form-floating mb-3">
                                        <money3 type="text" class="form-control" id="floatingInput"
                                            v-model="guardarEspecialista.deposito" v-bind="config"></money3>
                                        <label for="floatingInput">Monto de Solicitud de Deposito</label>
                                    </div>
                                </div>
                                <div class="form-floating col-md-6">
                                    <select class="form-select" aria-label="Default select example" id="selectOptions">
                                        <option selected>Selecciona una Opción</option>
                                        <option value="1">Psicoterapia Clínica</option>
                                        <option value="2">Terapia Familiar</option>
                                        <option value="3">Tanatología </option>
                                    </select>
                                    <label for="selectOptions">Servicios</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-12">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                                        v-model="guardarEspecialista.descripcion"></textarea>
                                    <label for="floatingTextarea">Descripción/Información
                                        Adicional</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cerrar
                            </button>
                            <button type="button" class="btn btn-primary float-end mb-2 ms-2"
                                style="background-color: #a1b6a7" @click="guardarInfoEspecialista()">
                                Guardar Información
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Registrar Datos Especialista -->
        </div>
    </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'

import { Money3Component, } from 'v-money3'

export default {
    components: {
        Multiselect, money3: Money3Component
    },
    props: ["opciones", "opcionesboton"],
    data() {
        return {
            amount: 0,
            config: {
                masked: false,
                prefix: '$',
                suffix: '',
                thousands: ',',
                decimal: '.',
                precision: 2,
                disableNegative: false,
                disabled: false,
                min: null,
                max: null,
                allowBlank: false,
                minimumNumberOfCharacters: 0,
                shouldRound: true,
                focusOnRight: false,
            },

            path_url: window.vue_url,
            guardarEspecialista: {
                deposito: 0,
            },
            infoEspecialista: {

            },
            imagenMiniatura: "",
            product: {
                imagen: "",
            },
            imagenPerfil: "",
            banderaBoton: false,

        };
    },
    methods: {
        disparador(funcion, obj = null) {
            this[funcion](obj);
        },

        async obtenerDatos() {

            const thisVue = this;

            await axios
                .get(thisVue.path_url + "/api/especialista/obtenerFoto")
                .then((res) => {
                    thisVue.imagenPerfil = res.data;
                })

                .catch((error) => { });
            await axios
                .get(thisVue.path_url + "/api/especialista/getInfoEspecialista")
                .then((res) => {
                    thisVue.infoEspecialista = res.data;
                    thisVue.banderaBoton = Object.entries(res.data).length === 0;
                    thisVue.infoEspecialista.nombre = res.data.titulo + ' ' + res.data.nombre + ' ' + res.data.apellido_pat + ' ' + res.data.apellido_mat;

                })

                .catch((error) => { });
        },

        addDatosEspecialista() {
            $("#datosEspecialista").modal("show");
        },
        editarDatosEspecialista() {
            console.log('editar informacion del especialista')
        },

        async guardarInfoEspecialista() {
            const thisVue = this;
            let formData = new FormData();

            formData.append("imagen", thisVue.product.imagen);

            await axios
                .post(
                    thisVue.path_url + "/api/especialista/updateFoto",
                    formData
                ).then((res) => {
                }).catch((error) => { });

            await axios
                .post(
                    thisVue.path_url + "/api/especialista/guardarEspecialista",
                    thisVue.guardarEspecialista
                )
                .then((res) => {
                    this.obtenerDatos();
                    $("#datosEspecialista").modal("hide");
                })

                .catch((error) => { });
        },

        obtenerImagen(e) {
            const thisVue = this;
            let file = e.target.files[0];
            thisVue.product.imagen = file;

            thisVue.cargarImagen(file);
        },

        cargarImagen(file) {
            const thisVue = this;
            let reader = new FileReader();

            reader.onload = (e) => {
                thisVue.imagenMiniatura = e.target.result;
            };
            reader.readAsDataURL(file);
        },


    },
    mounted() {
        this.obtenerDatos();
    },
    computed: {
        imagen() {
            return this.imagenMiniatura;
        },
    },
};
</script>
<style>
.circular--landscape {
    display: inline-block;
    position: relative;
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 50%;
}

.circular--landscape img {
    width: auto;
    height: 100%;
    margin-left: 0px;
}
</style>
