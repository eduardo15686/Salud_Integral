<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h1>Perfil</h1>
                </div>
                <div class="col-md-4">
                    <div v-for="icon in opcionesboton" class="col-auto">
                        <button
                            type="button"
                            class="btn btn-primary float-end mb-2 ms-2"
                            style="background-color: #a1b6a7"
                            @click.capture="disparador(icon.function)"
                        >
                            <i
                                :class="icon.class + ' pointer me-2'"
                                aria-hidden="true"
                            ></i
                            >{{ icon.text_html }}
                        </button>
                    </div>
                </div>
            </div>

            <br />
            <div class="row">
                <div class="col-md-8">
                    <h3>Información</h3>
                    <div class="col-md-8"></div>
                </div>
                <div class="col-md-4" style="text-align: center">
                    <img :src="imagenPerfil" class="img-thumbnail" />
                    <h2>Foto de perfil</h2>
                </div>
            </div>

            <!-- Modal Registrar Datos Especialista-->
            <div
                class="modal fade modal-lg"
                id="datosEspecialista"
                data-bs-backdrop="static"
                tabindex="-1"
                aria-labelledby="datosEspecialistaLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="datosEspecialistaLabel">
                                Modal title
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h3>Datos Personales</h3>
                                <div class="form-floating col-md-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="Nombre"
                                        v-model="guardarEspecialista.nombre"
                                    />
                                    <label for="floatingInput">Nombre</label>
                                </div>
                                <div class="form-floating col-md-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="Paterno"
                                        v-model="guardarEspecialista.paterno"
                                    />
                                    <label for="floatingInput"
                                        >Apellido Paterno</label
                                    >
                                </div>
                                <div class="form-floating col-md-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="Materno"
                                        v-model="guardarEspecialista.materno"
                                    />
                                    <label for="floatingInput"
                                        >Apellido Materno</label
                                    >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="floatingCel"
                                            placeholder="Titulo/Especialidad"
                                            v-model="guardarEspecialista.titulo"
                                        />
                                        <label for="floatingCel"
                                            >Titulo/Especialidad</label
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-mask="'###-#######'"
                                            id="floatingCel"
                                            placeholder="Celular Ej. (618-1234567)"
                                            v-model="
                                                guardarEspecialista.celular
                                            "
                                        />
                                        <label for="floatingCel"
                                            >Celular Ej. (618-1234567)</label
                                        >
                                    </div>
                                </div>
                                <div class="form-floating col-md-5">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="name@example.com"
                                        v-model="guardarEspecialista.correo"
                                    />
                                    <label for="floatingInput"
                                        >Correo Electronico</label
                                    >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="formFileSm" class="form-label"
                                        >Foto de Perfil</label
                                    >
                                    <input
                                        class="form-control form-control"
                                        id="formFileSm"
                                        type="file"
                                        @change="obtenerImagen"
                                    />
                                </div>
                                <div
                                    class="col-md-3"
                                    style="text-align: center"
                                >
                                    <button
                                        @click="guardarImagen()"
                                        type="button"
                                        class="btn btn-success"
                                        style="
                                            display: block;
                                            padding: 0.5rem 1rem;
                                            width: 150px;
                                            margin: 0 auto;
                                            margin-top: 28px;
                                        "
                                    >
                                        Guardar Imagen
                                    </button>
                                </div>
                                <div
                                    class="col-md-3"
                                    style="text-align: center"
                                >
                                    <div class="circular--landscape">
                                        <img :src="imagen" />
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-floating col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Leave a comment here"
                                        id="floatingTextarea"
                                    ></textarea>
                                    <label for="floatingTextarea"
                                        >Descripción/Información
                                        Adicional</label
                                    >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <h3>Información de Consulta</h3>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary float-end mb-2 ms-2"
                                style="background-color: #a1b6a7"
                                @click="guardarInfoEspecialista()"
                            >
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
export default {
    props: ["opciones", "opcionesboton"],
    data() {
        return {
            path_url: window.vue_url,
            guardarEspecialista: {},
            imagenMiniatura: "",
            product: {
                imagen: "",
            },
            imagenPerfil: "",
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
                    console.log(res.data.imagenPerfil[0].imagen_path);
                    imagenPerfil = res.data.imagenPerfil[0].imagen_path;
                })

                .catch((error) => {});
        },

        addDatosEspecialista() {
            console.log("se debe abrir la modal");
            $("#datosEspecialista").modal("show");
        },

        async guardarInfoEspecialista() {
            const thisVue = this;
            console.log(thisVue.guardarEspecialista);
            await axios
                .post(
                    thisVue.path_url + "/api/especialista/guardarEspecialista",
                    thisVue.guardarEspecialista
                )
                .then((res) => {
                    $("#datosEspecialista").modal("hide");
                    console.log(res);
                })

                .catch((error) => {});
        },

        obtenerImagen(e) {
            const thisVue = this;
            let file = e.target.files[0];
            console.log(file);
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

        async guardarImagen() {
            const thisVue = this;
            let formData = new FormData();

            formData.append("imagen", thisVue.product.imagen);

            await axios
                .post(
                    thisVue.path_url + "/api/especialista/updateFoto",
                    formData
                )
                .then((res) => {
                    console.log(res.data);
                })

                .catch((error) => {});
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
