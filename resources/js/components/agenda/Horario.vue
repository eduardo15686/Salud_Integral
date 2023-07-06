<template>
    <div class="card">
        <div class="card-body">
            <h3>Horario</h3>
            <br>

            <div v-if="editarHorario == true" style="text-align: end;">
                <button type="button" class="btn btn-primary" @click="btnEditarHorario()">Editar Horario</button>
            </div>
            <div v-else style="text-align: end;">
                <button type="button" class="btn btn-primary" @click="ventanaHorario()">Crear Horario</button>
            </div>

            <div v-if="crearHorario == true">
                <div class="row row_margin">
                    <div class="col-md-3">
                        <label>Tiempo que dura la sesion</label>
                        <select class="form-select" v-model="getTiempoConsulta" aria-label="Default select example">
                            <option v-for="(item, index) in tiempoConsulta" :value="item.value">{{ item.nombre }}</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="text-align: center;">
                </div>
                <div class="row" v-for="(item, index) in dias" style="margin-top: 20px;" :name="item.dia">
                    <div class="col-md-1">
                        <p style="margin-top: 10px;"><b>{{ item.dia }}</b></p>
                    </div>
                    <div class="row col-md-5">
                        <div class="col-md-5">
                            <select class="form-select" aria-label="Default select example" v-model="item.inicio_mat">
                                <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                            </select>
                        </div>
                        a
                        <div class="col-md-5">
                            <select class="form-select" aria-label="Default select example" v-model="item.final_mat">
                                <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" @click="nuevoHorario()">+</button>
                        </div>
                    </div>
                    <div v-if="agregarHorario == true" class="row col-md-5">
                        <div class="col-md-5">
                            <select class="form-select" aria-label="Default select example" v-model="item.inicio_vesp">
                                <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                            </select>
                        </div>
                        a
                        <div class="col-md-5">
                            <select class="form-select" aria-label="Default select example" v-model="item.final_vesp">
                                <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                            </select>
                        </div>
                    </div>
                    <div v-else class="col-md-5">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" @click="guardarHorario(item)" :id="item.dia"
                            hidden>Guardar</button>
                    </div>
                </div>
                <div class="row">
                    <div style="text-align: end;">
                        <button type="button" class="btn btn-primary" @click="generarHorario()"
                            id="guardarHorarioFinal">Guardar Horario</button>
                    </div>
                </div>

            </div>

            <div v-if="ventanaEditarHorario == true">
                <div class="row row_margin">
                    <div class="col-md-3">
                        <label>Tiempo que dura la sesion</label>
                        <select class="form-select" v-model="tiempoConsultaEditar" aria-label="Default select example">
                            <option v-for="(item, index) in tiempoConsulta" :value="item.value">{{ item.nombre }}</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="text-align: center;">

                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="row" style="text-align: center;">
                    </div>
                    <div class="row" v-for="(item, index) in editarDias" style="margin-top: 20px;" :name="item.dia">
                        <div class="col-md-1">
                            <p style="margin-top: 10px;"><b>{{ item.dia }}</b></p>
                        </div>
                        <div class="row col-md-5">
                            <div class="col-md-5">
                                <select class="form-select" aria-label="Default select example" v-model="item.inicio_mat">
                                    <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                                </select>
                            </div>
                            a
                            <div class="col-md-5">
                                <select class="form-select" aria-label="Default select example" v-model="item.final_mat">
                                    <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary" disabled>/</button>
                            </div>
                        </div>
                        <div class="row col-md-5">
                            <div class="col-md-5">
                                <select class="form-select" aria-label="Default select example" v-model="item.inicio_vesp">
                                    <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                                </select>
                            </div>
                            a
                            <div class="col-md-5">
                                <select class="form-select" aria-label="Default select example" v-model="item.final_vesp">
                                    <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" @click="modificarHorario(item)" :id="item.dia"
                                hidden>Guardar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div style="text-align: end;">
                            <button type="button" class="btn btn-primary" @click="generarHorarioModificado()"
                                id="guardarHorarioFinal">Guardar Horario</button>
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
            path_url: window.vue_url,
            this_year: null,
            //guardarHorario: {},
            semanas: [],
            valorSemana: 0,
            mostratFecha: false,
            dias: [],
            editarDias: [],
            horas: [],
            tiempoConsulta: [],
            getTiempoConsulta: 0,
            agregarHorario: false,
            crearHorario: false,
            editarHorario: false,
            ventanaEditarHorario: false,
            tiempoConsultaEditar: '',
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },
        nuevoHorario() {
            this.agregarHorario = true;
        },
        btnEditarHorario() {
            const thisVue = this;
            thisVue.ventanaEditarHorario = true;
        },
        ventanaHorario() {
            const thisVue = this;
            thisVue.crearHorario = true;

        },
        generarHorario() {
            document.getElementById("Lunes").click();
            document.getElementById("Martes").click();
            document.getElementById("Miercoles").click();
            document.getElementById("Jueves").click();
            document.getElementById("Viernes").click();
            document.getElementById("Sabado").click();
            document.getElementById("Domingo").click();
        },

        generarHorarioModificado() {
            document.getElementById("0").click();
            document.getElementById("1").click();
            document.getElementById("2").click();
            document.getElementById("3").click();
            document.getElementById("4").click();
            document.getElementById("5").click();
            document.getElementById("6").click();
        },

        modificarHorario(item) {
            const thisVue = this;
            const btncompra = document.getElementById('guardarHorarioFinal');
            let obj = {
                id: item.id,
                inicio_mat: item.inicio_mat,
                final_mat: item.final_mat,
                inicio_vesp: item.inicio_vesp,
                final_vesp: item.final_vesp,
                tiempoConsulta: thisVue.tiempoConsultaEditar,
                dia: item.value
            }
            console.log(obj)
            if (thisVue.tiempoConsultaEditar == 0) {
                this.$swal(
                    'Error',
                    'Asegúrate de ingresar el tiempo de consulta',
                    'error'
                );
                console.log('asegurate de ingresar tu tiempo de consulta')
            } else {
                axios.post(thisVue.path_url + '/api/horario/modificarHorario', obj)
                    .then((res) => {
                        btncompra.disabled = true;
                    })
                    .catch((error) => {

                    });
                this.$swal(
                    'Horario Editado',
                    'El horario se guardó de manera exitosa',
                    'success'
                );
            }
        },

        guardarHorario(item) {
            const thisVue = this;
            const btncompra = document.getElementById('guardarHorarioFinal');
            let obj = {
                inicio_mat: item.inicio_mat,
                final_mat: item.final_mat,
                inicio_vesp: item.inicio_vesp,
                final_vesp: item.final_vesp,
                tiempoConsulta: thisVue.getTiempoConsulta,
                dia: item.value
            }
            console.log(obj)
            if (thisVue.getTiempoConsulta == 0) {
                this.$swal(
                    'Error',
                    'Asegúrate de ingresar el tiempo de consulta',
                    'error'

                );
                console.log('asegurate de ingresar tu tiempo de consulta')
            } else {
                axios.post(thisVue.path_url + '/api/horario/generarHorario', obj)
                    .then((res) => {
                        btncompra.disabled = true;
                    })
                    .catch((error) => {

                    });
                this.$swal(
                    'Horario Guardado',
                    'El horario se guardó de manera exitosa',
                    'success'

                );
                thisVue.crearHorario = false;
            }
        },

        obtenerDias() {
            const thisVue = this;
            let obj = {
                year: thisVue.this_year,
                semana: thisVue.valorSemana
            }
            axios.get(thisVue.path_url + '/api/horario/obtenerDias')
                .then((res) => {
                    thisVue.dias = res.data;
                })
                .catch((error) => {

                });
        },

        getHorario() {
            const thisVue = this;
            let obj = {
                year: thisVue.this_year,
                semana: thisVue.valorSemana
            }
            axios.get(thisVue.path_url + '/api/horario/getHorario')
                .then((res) => {
                    if (res.data[1] != 0) {
                        thisVue.editarHorario = true;
                    };
                    thisVue.editarDias = res.data[0];
                    thisVue.tiempoConsultaEditar = res.data[0][0].tiempo;
                })
                .catch((error) => {

                });
        },

        getHoras() {
            const thisVue = this;
            axios.get(thisVue.path_url + '/api/horario/getHoras')
                .then((res) => {
                    thisVue.horas = res.data;
                })
                .catch((error) => {

                });

            axios.get(thisVue.path_url + '/api/horario/tiempoConsulta')
                .then((res) => {
                    thisVue.tiempoConsulta = res.data;
                })
                .catch((error) => {

                });
        },
    },
    async mounted() {
        const d = new Date();
        this.this_year = d.getFullYear();
        this.getHoras();
        this.obtenerDias();
        this.getHorario();
    }
}
</script>
<style></style>