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
            <div style="text-align:center;">
                <div class="col-md-8" style=" margin:0px auto;">
                    <table class="table table-striped">
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
                                <td><a v-for="icon in opciones"
                                        style="padding-right: 10px; cursor:pointer; font-size: large;"><i
                                            :class="icon.class + ' pointer ml-2'" :title="icon.text_html" aria-hidden="true"
                                            @click.capture="disparador(icon.function, item)"></i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <!-- <Multiselect v-model="value" mode="tags" :groups="true" :close-on-select="false" :searchable="true"
                :create-option="false" :options="options" />
            {{ value }} -->
            <!-- MODALES -->

            <!-- Agregar Categoria servicio nivel 1 -->
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
                                        placeholder="Nombre Completo" v-model="nombre_servicio">
                                    <label for="floatingNombre">Nombre del Servicio</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="nuevoServicio()">Crear
                                Servicio</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Agregar Categoria servicio nivel 2 -->
            <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarCategoria">AGREGAR SERVICIOS A {{ servicioNombre }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNombre"
                                        placeholder="Nombre Completo" v-model="nombre_categoria">
                                    <label for="floatingNombre">Nombre del Servicio</label>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="nuevaCategoria()">Crear
                                Categoria</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Visualizar Servicios de nivel 2 -->
            <div class="modal fade" id="modalTablaCategorias" tabindex="-1" aria-labelledby="modalTablaCategoriasLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTablaCategoriaslLabel">CATEGORIAS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                        <tr v-for="item in tablaCategorias">
                                            <th scope="row">{{ item.id }}</th>
                                            <td>{{ item.text_html }}</td>
                                            <td>
                                                <a style="padding-left: 10px; cursor:pointer; font-size: large;">
                                                    <i class='ml-2 ti ti-plus' aria-hidden="true"
                                                        @click="openModalSubCategoria(item)"></i></a><a
                                                    style="padding-left: 10px; cursor:pointer; font-size: large;">
                                                    <i class='ml-2 ti ti-file' aria-hidden="true"
                                                        @click="openModalTablaSubcategorias(item)"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agregar Categoria servicio nivel 3 -->
            <div class="modal fade" id="modalAgregarSubCategoria" tabindex="-1"
                aria-labelledby="modalAgregarSubCategoriaLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarSubCategoriaLabel">AGREGAR SUBCATEGORIA A {{
                                servicioNombre }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNombre"
                                        placeholder="Nombre Completo" v-model="nombre_subcategoria">
                                    <label for="floatingNombre">Nombre del Servicio</label>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="nuevaSubCategoria()">Agregar
                                Subcategoria</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visualizar Servicios de nivel 3-->
            <div class="modal fade" id="modalTablaSubcategorias" tabindex="-1"
                aria-labelledby="modalTablaSubcategoriasLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTablaSubcategoriaslLabel">SUBCATEGORIAS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                        <tr v-for="item in tablaSubcategorias">
                                            <th scope="row">{{ item.id }}</th>
                                            <td>{{ item.text_html }}</td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect'
export default {
    components: {
        Multiselect,
    },
    props: ['opciones', 'opcionesboton'],
    data() {
        return {
            value: [],
            options: [],
            nombre_servicio: '',
            nombre_categoria: '',
            nombre_subcategoria: '',
            correo: '',
            password: '',
            perfil_id: '',
            path_url: window.vue_url,
            errors: [],
            tablaServicios: [],
            tablaCategorias: [],
            tablaSubcategorias: [],
            userSelected: {},
            perfiles: [],
            servicioNombre: '',
            parent_id: 0,
            parent_subcategoria: 0,
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        openModalAgregarCategoria(item) {
            this.servicioNombre = (item.text_html).toUpperCase();
            this.parent_id = item.id;
            $("#modalAgregarCategoria").modal("show");
        },

        openModalCategorias(item) {
            this.getCategorias(item);
            $("#modalTablaCategorias").modal("show");
        },

        openModalServicioNuevo() {
            $("#modalNuevoServicio").modal("show");
        },

        openModalSubCategoria(item) {
            this.servicioNombre = (item.text_html).toUpperCase();
            this.parent_subcategoria = item.id;
            $("#modalAgregarSubCategoria").modal("show");
            console.log(this.servicioNombre);
        },

        openModalTablaSubcategorias(item) {
            this.getSubcategorias(item);
            $("#modalTablaSubcategorias").modal("show");
        },

        openModalEliminarServicio() {
            console.log('eliminar el servicio');
        },


        async getServicios() {
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

        async getCategorias(item) {
            const thisVue = this;
            await axios.get(thisVue.path_url + `/api/servicios/getCategorias/` + item.id)
                .then(res => {
                    thisVue.tablaCategorias = res.data;
                })
                .catch(error => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                    console.log(this.errors);
                });
        },

        async getSubcategorias(item) {
            const thisVue = this;
            console.log(item.id)
            await axios.get(thisVue.path_url + `/api/servicios/getSubCategorias/` + item.id)
                .then(res => {
                    thisVue.tablaSubcategorias = res.data;
                    console.log(res.data)
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
                nombre: thisVue.nombre_servicio
            }
            await axios.post(thisVue.path_url + `/api/servicios/nuevoServicio`, objeto)
                .then(res => {
                    this.$swal(
                        'Agregar Servicio',
                        res.data.message,
                        'success'
                    );
                    $("#modalNuevoServicio").modal("hide");
                    thisVue.getServicios();
                })
                .catch(error => {

                });
        },

        async nuevaCategoria() {
            const thisVue = this;
            const objeto = {
                parent_id: thisVue.parent_id,
                nombre: thisVue.nombre_categoria
            }
            await axios.post(thisVue.path_url + `/api/servicios/nuevaCategoria`, objeto)
                .then(res => {
                    this.$swal(
                        'Agregar Categoria',
                        res.data.message,
                        'success'
                    );
                    thisVue.nombre_categoria = '';
                })
                .catch(error => {

                });
        },

        async nuevaSubCategoria() {
            const thisVue = this;
            const objeto = {
                parent_id: thisVue.parent_subcategoria,
                nombre: thisVue.nombre_subcategoria
            }
            await axios.post(thisVue.path_url + `/api/servicios/nuevaSubCategoria`, objeto)
                .then(res => {
                    this.$swal(
                        'Agregar Categoria',
                        res.data.message,
                        'success'
                    );
                    thisVue.nombre_subcategoria = '';
                })
                .catch(error => {

                });
        },

        eliminarServicio() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/usuarios/deleteUsuario', thisVue.userSelected)
                .then((res) => {
                    this.$swal(
                        'Eliminar Usuario',
                        res.data.message,
                        'success'
                    );
                    $("#modalEliminarUsuario").modal("hide");
                    thisVue.getServicios();
                })
                .catch((error) => {

                });
        },

    },
    async mounted() {
        await this.getServicios();
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>