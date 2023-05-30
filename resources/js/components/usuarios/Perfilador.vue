<template>
    <div class="container container_height fondo-opacidad">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Administración de Perfiles</h5>
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
                            <tr v-for="item in perfiles">
                                <th scope="row">{{ item.id }}</th>
                                <td>{{ item.nombre_perfil }}</td>
                                <td><a v-for="icon in opciones" style="padding-left: 10px;"><i
                                            :class="icon.class + ' pointer ml-2'" :title="icon.text_html" aria-hidden="true"
                                            @click.capture="disparador(icon.function, item)"></i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="nuevoPerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="nuevoPerfilLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="nuevoPerfilLabel">Nuevo Perfil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingEditNombre"
                                        placeholder="Nombre Completo" v-model="nombre">
                                    <label for="floatingEditNombre">Nombre del perfil</label>
                                </div>
                                <br>
                                <div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="guardarPerfil()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Treeselect from 'vue3-treeselect'
import 'vue3-treeselect/dist/vue3-treeselect.css'

export default {
    props: ['opciones', 'opcionesboton'],
    components: { Treeselect },
    data() {
        return {
            value: null,
            options: [{
                id: '1',
                label: 'Level-1',
                children: [{
                    id: '11',
                    label: 'Level-1-1',
                }, {
                    id: '12',
                    label: 'Level-1-2',
                }],
            }, {
                id: '2',
                label: 'Level-2',
            }, {
                id: '3',
                label: 'Level-3',
            }],

            path_url: window.vue_url,
            perfiles: [],
            permisos: [],
            options: [],
            perfilSelected: {},
            value: null,
            nombre: ''
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },
        openModalPerfilNuevo() {
            $('#nuevoPerfil').modal('show');
        },

        async getPerfiles() {
            const thisVue = this;
            await axios.get(thisVue.path_url + `/api/perfiles/getPerfiles`)
                .then(res => {
                    this.perfiles = res.data;
                })
                .catch(error => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                });
        },

        openModalEliminarPerfil(){
            console.log('eliminar')
        },
        openModalEditarPerfil(){
            console.log('editar')
        }

    },
    async mounted() {
        this.getPerfiles();
    }
}
</script>
<style></style>