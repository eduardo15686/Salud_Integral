<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h3>Agenda</h3>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <h4><b>{{ mesInicialEstablecido }}</b> al <b>{{ mesFinalEstablecido }}</b></h4>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-7">
                    <button type="button" class="btn btn-success" style="margin: 5px;" disabled>Disponible</button>
                    <button type="button" class="btn btn-warning" style="margin: 5px;" disabled>Solicitada</button>
                    <button type="button" class="btn btn-danger" style="margin: 5px;" disabled>Agendada</button>
                    <button type="button" class="btn btn-dark" style="margin: 5px;" disabled>Inactiva</button>
                    <button type="button" class="btn btn-success"
                        style="margin: 5px; background-color: #cca9dd; border-color: #cca9dd;" disabled>Especial</button>
                </div>
            </div>
            <!-- <div class="row">

                <div v-if="btngenerarAgenda == true" class="col-md-6">
                    <button type="button" class="btn btn-success" style="margin: 5px;" @click="generarAgenda()">Generar
                        Agenda</button>
                </div>
                <div v-else class="col-md-7"></div>
            </div> -->
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <button class='btn btn-outline-dark' @click="disminuirContador()"><i
                            class="ti ti-arrow-left"></i></button>
                </div>
                <div v-if="btngenerarAgenda == true" class="col-md-7" style="text-align: center;">
                    <button type="button" class="btn btn-success" style="margin: 5px;" @click="generarAgenda()">Generar
                        Agenda</button>
                </div>
                <div v-else class="col-md-7"></div>
                <div class="col-md-1">
                    <button class='btn btn-outline-dark' @click="aumentarContador()"><i
                            class="ti ti-arrow-right"></i></button>
                </div>
            </div>

            <div v-if="btngenerarAgenda == false" class="row">
                <div class="col-md-3"></div>

                <div class="col-md-1" style="text-align: center;">
                    <p><b>Lunes</b></p>
                    <p style="font-size: x-small;"> {{ fechas[0] }}</p>
                    <div v-for="(item, index) in recorrerLunes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Martes</b></p>
                    <p style="font-size: x-small;"> {{ fechas[1] }}</p>
                    <div v-for="(item, index) in recorrerMartes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Miércoles</b></p>
                    <p style="font-size: x-small;"> {{ fechas[2] }}</p>
                    <div v-for="(item, index) in recorrerMiercoles" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Jueves</b></p>
                    <p style="font-size: x-small;"> {{ fechas[3] }}</p>
                    <div v-for="(item, index) in recorrerJueves" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)"> {{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Viernes</b></p>
                    <p style="font-size: x-small;"> {{ fechas[4] }}</p>
                    <div v-for="(item, index) in recorrerViernes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Sabado</b></p>
                    <p style="font-size: x-small;"> {{ fechas[5] }}</p>
                    <div v-for="(item, index) in recorrerSabado" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Domingo</b></p>
                    <p style="font-size: x-small;"> {{ fechas[6] }}</p>
                    <div v-for="(item, index) in recorrerDomingo" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;" @click="horaDisponible(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;" @click="horaApartada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;" @click="horaAgendada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;" @click="horaInhabilitada(item)">{{ item.hora.substring(0, 5)
                            }}</button>
                    </div>
                </div>
            </div>

            <div v-else class="row"></div>
            <!-- Modal Aparatada-->
            <div class="modal fade" id="modalHoraApartada" tabindex="-1" aria-labelledby="modalHoraApartadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHoraApartada">Información del prospecto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Datos de contacto</h5>
                                    <p><b>Nombre:</b> {{ infoProspecto.nombre }}</p>
                                    <p><b>Correo:</b> {{ infoProspecto.correo }}</p>
                                    <p><b>Teléfono:</b> {{ infoProspecto.celular }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Información adicional</h5>
                                    <p><b>Edad:</b> {{ infoProspecto.edad }}</p>
                                    <p><b>Sexo:</b> {{ infoProspecto.sexo }}</p>
                                    <p><b>Modalidad:</b> {{ infoProspecto.modalidad }}</p>
                                    <p><b>¿Primera vez en terapia?:</b> {{ infoProspecto.primera_vez }}</p>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-6" style="text-align: center;">
                                    <!-- <p style="font-size: small;">Al 'ACEPTAR' se le enviara un correo de confirmación al
                                        prospecto y su cita sera agendada.
                                    </p> -->
                                    <!-- <button type="button" class="btn btn-primary"
                                        @click="aceptarProspecto()">Aceptar</button> -->
                                </div>
                                <div class="row col-md-6" style="text-align: center;">
                                    <!-- <p style="font-size: small;">Al 'RECHAZAR'se le enviara un correo al prospecto
                                        informandole
                                        que no puede ser agendado en dicha fecha y hora.
                                    </p> -->
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary"
                                            @click="aceptarProspecto()">Aceptar</button>
                                    </div>
                                    <div class="col-md-6"><button type="button" class="btn btn-danger"
                                            @click="rechazarProspecto()">Rechazar</button></div>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div><!-- End Modal Aparatada-->

            <!-- Modal Disponible-->
            <div class="modal fade modal-lg" id="modalHoraDisponible" tabindex="-1"
                aria-labelledby="modalHoraDisponibleLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHoraDisponible">Hora Disponible</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Selecciona un paciente</p>

                                    <select class="form-select" aria-label="Default select example"
                                        v-model="infoPaciente.id">
                                        <option v-for="(item, index) in pacientes" :value="item.id">{{ item.nombre }}
                                        </option>

                                    </select>
                                    <div style="text-align: end; margin-top: 25px;">
                                        <button type="button" class="btn btn-success"
                                            @click="agendarPaciente">Agendar</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p>Inhabilitar hora</p>
                                    <button type="button" class="btn btn-dark"
                                        @click="inhabilitarHora()">Inhabilitar</button>
                                </div>
                                <div class="col-md-2">
                                    <p>Sesion especial</p>
                                    <button type="button" class="btn btn-success"
                                        style="background-color: #cca9dd; border-color: #cca9dd;">Especial</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div><!-- End Modal Disponible-->

            <!-- Modal Agendada-->
            <div class="modal fade" id="modalHoraAgendada" tabindex="-1" aria-labelledby="modalHoraAgendadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHoraAgendada">Información del paciente</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p><b>Nombre:</b> {{ infoPaciente.nombre }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- End Modal Agendada-->

            <!-- Modal Inhabilitada-->
            <div class="modal fade" id="modalHoraInhabilitada" tabindex="-1" aria-labelledby="modalHoraInhabilitadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHoraInhabilitada">Habilitar Hora</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12" style="text-align: end;">
                                    <button type="button" class="btn btn-success" @click="habilitarHora">Habilitar
                                        Hora</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Inhabilitada-->
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
            path_url: window.vue_url,

            recorrerLunes: {},
            recorrerMartes: {},
            recorrerMiercoles: {},
            recorrerJueves: {},
            recorrerViernes: {},
            recorrerSabado: {},
            recorrerDomingo: {},
            btngenerarAgenda: true,
            contador: 0,
            fechas: {},
            mesInicialEstablecido: 0,
            mesFinalEstablecido: 0,
            infoProspecto: {},
            infoPaciente: {},
            agendarProspecto: {},
            pacientes: {},

        }
    },
    methods: {

        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },
        aumentarContador() {
            const thisVue = this;
            thisVue.contador = thisVue.contador + 1;
            thisVue.verAgenda();
        },
        disminuirContador() {
            const thisVue = this;
            thisVue.contador = thisVue.contador - 1;
            thisVue.verAgenda();
        },
        horaAgendada(item) {
            const thisVue = this;
            thisVue.infoPaciente = item.paciente;
            $("#modalHoraAgendada").modal("show");
        },
        horaApartada(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            thisVue.infoProspecto = item.prospecto;
            $("#modalHoraApartada").modal("show");
        },
        horaDisponible(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            $("#modalHoraDisponible").modal("show");
        },
        horaInhabilitada(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            $("#modalHoraInhabilitada").modal("show");
        },
        inhabilitarHora() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/agendas/inhabilitarHora', thisVue.agendarProspecto)
                .then((res) => {
                    thisVue.verAgenda();
                    $("#modalHoraDisponible").modal("hide");
                })
                .catch((error) => {
                });
        },
        habilitarHora() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/agendas/habilitarHora', thisVue.agendarProspecto)
                .then((res) => {
                    thisVue.verAgenda();
                    $("#modalHoraInhabilitada").modal("hide");
                })
                .catch((error) => {
                });
        },
        aceptarProspecto() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/agendas/aceptarProspecto', thisVue.agendarProspecto)
                .then((res) => {
                    console.log(res.data);
                    thisVue.verAgenda();
                    $("#modalHoraApartada").modal("hide");
                })
                .catch((error) => {
                });
        },
        agendarPaciente() {
            const thisVue = this;
            let obj = {
                id: thisVue.agendarProspecto.id,
                paciente_id: thisVue.infoPaciente.id
            }
            console.log(obj);
            axios.post(thisVue.path_url + '/api/agendas/agendarPaciente', obj)
                .then((res) => {
                    thisVue.verAgenda();
                    $("#modalHoraDisponible").modal("hide");
                    thisVue.agendarProspecto = {};
                    thisVue.infoPaciente = {};

                })
                .catch((error) => {
                });
        },
        rechazarProspecto() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/agendas/rechazarProspecto', thisVue.agendarProspecto)
                .then((res) => {
                    thisVue.verAgenda();
                    $("#modalHoraApartada").modal("hide");
                })
                .catch((error) => {

                });

        },
        generarAgenda() {
            const thisVue = this;
            let obj = {
                contador: thisVue.contador
            };
            axios.post(thisVue.path_url + '/api/agendas/generarAgenda', obj)
                .then((res) => {
                    thisVue.verAgenda();
                })
                .catch((error) => {

                });
        },
        verAgenda() {
            const thisVue = this;
            thisVue.btngenerarAgenda = true;
            let obj = {
                contador: thisVue.contador
            };
            axios.post(thisVue.path_url + '/api/agendas/verAgenda', obj)
                .then((res) => {
                    thisVue.recorrerLunes = res.data[0];
                    thisVue.recorrerMartes = res.data[1];
                    thisVue.recorrerMiercoles = res.data[2];
                    thisVue.recorrerJueves = res.data[3];
                    thisVue.recorrerViernes = res.data[4];
                    thisVue.recorrerSabado = res.data[5];
                    thisVue.recorrerDomingo = res.data[6];
                    thisVue.fechas = res.data[7];

                    if (res.data[0].length != 0 || res.data[1].length != 0 || res.data[2].length != 0
                        || res.data[3].length != 0 || res.data[4].length != 0 || res.data[5].length != 0 || res.data[6].length != 0) {
                        thisVue.btngenerarAgenda = false;
                    }

                    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];

                    const mesActualInicial = res.data[7][0].split('-');
                    const mesActualFinal = res.data[7][6].split('-');


                    if (mesActualInicial[1] <= 9) {
                        thisVue.mesInicialEstablecido = mesActualInicial[0] + ' de ' + meses[mesActualInicial[1].substring(1, 2) - 1] + ' del ' + mesActualInicial[2];
                    } else {
                        thisVue.mesInicialEstablecido = mesActualInicial[0] + ' de ' + meses[mesActualInicial[1] - 1] + 'del' + mesActualInicial[2];
                    }

                    if (mesActualFinal[1] <= 9) {
                        thisVue.mesFinalEstablecido = mesActualFinal[0] + ' de ' + meses[mesActualFinal[1].substring(1, 2) - 1] + ' del ' + mesActualFinal[2];
                    } else {
                        thisVue.mesFinalEstablecido = mesActualFinal[0] + ' de ' + meses[mesActualFinal[1] - 1] + 'del' + mesActualFinal[2];
                    }
                })

                .catch((error) => {

                });
        },
        getPacientes() {
            const thisVue = this;
            axios.get(thisVue.path_url + '/api/agendas/getPacientes')
                .then((res) => {
                    thisVue.pacientes = res.data;
                })

                .catch((error) => {

                });
        },
    },
    async mounted() {
        this.getPacientes();
        this.verAgenda();

    }
}
</script>
<style></style>