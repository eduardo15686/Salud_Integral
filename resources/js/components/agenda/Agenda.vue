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
                <div class="col-md-5" style="text-align: start;">
                    <button type="button" class="btn btn-primary" style="margin: 5px;" @click="openModalEspecial()">Agregar
                        Horario Especial</button>
                    <!-- <button type="button" class="btn btn-primary" style="margin: 5px;" @click="whatsapp()">WhatsApp</button> -->
                </div>
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
                <div v-else class="col-md-7" style="text-align: center;">
                    <button type="button" class="btn btn-danger" style="margin: 5px;"
                        @click="modalEliminarAgenda()">Eliminar
                        Agenda</button>
                </div>
                <div class="col-md-1">
                    <button class='btn btn-outline-dark' @click="aumentarContador()"><i
                            class="ti ti-arrow-right"></i></button>
                </div>
            </div>
            <div class="row">
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
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
                        <button v-if="item.proceso == 'Especial'" type="button" class="btn btn-success"
                            style="width:80px;height:40px; background-color: #cca9dd; border-color: #cca9dd;"
                            @click="horaEspecial(item)">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
            </div>


            <!-- Modal Aparatada-->
            <div class="modal fade" id="modalHoraApartada" tabindex="-1" aria-labelledby="modalHoraApartadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #ffca6d;">
                            <h4 class="modal-title" id="modalHoraApartada">Hora Solicitada</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>
                            <br>
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
                                    <p><b>¿Qué busca solucionar el prospecto?:</b> {{ nombreEspecialidad }}</p>
                                    <div class="mb-3">
                                        <label class="form-label">Problema del prospecto:</label>
                                        <textarea class="form-control" rows="3" v-model="infoProspecto.comentarios"
                                            disabled></textarea>
                                    </div>
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
            <div class="modal fade" id="modalHoraDisponible" tabindex="-1" aria-labelledby="modalHoraDisponibleLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #65e9d1;">
                            <h4 class="modal-title" id="modalHoraDisponible">Hora Disponible</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>
                            <br>
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
                                <div class="col-md-4" style="text-align: center;">
                                    <p>Inhabilitar hora</p>
                                    <button type="button" class="btn btn-dark"
                                        @click="inhabilitarHora()">Inhabilitar</button>
                                </div>
                                <!-- <div class="col-md-2">
                                    <p>Sesión especial</p>
                                    <button type="button" class="btn btn-success"
                                        style="background-color: #cca9dd; border-color: #cca9dd;">Especial</button>
                                </div> -->
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
            <div class="modal fade modal-lg" id="modalHoraAgendada" tabindex="-1" aria-labelledby="modalHoraAgendadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #fcb29f;">
                            <h4 class="modal-title" id="modalHoraAgendada">Hora Agendada</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">Paciente</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">Próxima Cita</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#documentos" type="button" role="tab" aria-controls="documentos"
                                        aria-selected="false">Enviar Documento</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">
                                    <div class="row" style="text-align: center; margin-bottom: 20px;">
                                        <h4><b>{{ infoPaciente.nombre }}</b></h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                        </div>
                                    </div>

                                    <br>
                                    <div style="text-align: center;">
                                        <h5 style="font-size: large;">Historial Clínico</h5>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tareas
                                                Asignadas</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                                placeholder="Tareas asignadas al paciente esta sesión"
                                                v-model="infoHistorial.tareas"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label">Observaciones</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                placeholder="Observaciones de la sesión"
                                                v-model="infoHistorial.observaciones"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <label for="formFileSm" class="form-label">Agregar Imagenes/Documentos</label>
                                        <div v-for="(item, index) in listaCondiones" :key="index"
                                            style="display: flex; padding-bottom: 10px;">
                                            <div class="col-md-5" style="display: flex;margin-right: 10px;">
                                                <input class="form-control form-control" id="formFileSm" type="file"
                                                    @change="seleccionarArchivo" />
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="floatingInput"
                                                        placeholder="Nombre" style="height: 43px;" v-model="nombreArchivo">
                                                    <label for="floatingInput">Nombre del Archivo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-1" v-if="(listaCondiones.length - 1) == index">
                                                <div class="form-floating form-floating"
                                                    style="display: flex;justify-content: center;flex-flow: column;align-items: center;">
                                                    <button title="Agregar fila" @click="AlterListCondicionTab('+')"
                                                        style="padding-top: 0px; padding-bottom: 0px;width: 70%;border: 0;    margin-bottom: 5px;"
                                                        type="button" class="btn btn-success  btn-sm">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                    <button title="Borrar fila" @click="AlterListCondicionTab('-')"
                                                        style="padding-top: 0px; padding-bottom: 0px;width: 70%;border: 0;"
                                                        type="button" class="btn btn-danger  btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary" :id="index"
                                                    @click="guardarArchivo(index)">Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            @click="openModalCancelarCita()">Cancelar
                                            Cita</button>
                                        <button type="button" class="btn btn-success"
                                            @click="guardarHistorialClinico()">Guardar
                                            Información</button>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                    aria-labelledby="profile-tab" tabindex="0">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Fecha de la próxima cita</p>
                                            <div style="margin-bottom: 20px;">
                                                <input id="startDate" class="form-control" type="date"
                                                    v-model="fechaProximaCita" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Hora de la consulta</p>
                                            <select class="form-select" aria-label="Default select example"
                                                v-model="horaProximaCita">
                                                <option v-for="(item, index) in horas" :value="item">{{ item }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="text-align: end;">
                                            <button type="button" class="btn btn-primary" @click="proximaCita">Generar
                                                Cita</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab"
                                    tabindex="0">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect"
                                                    aria-label="Floating label select example" v-model="envioArchivo">
                                                    <option v-for="(item, index) in archivosEspecialista" :value="item">{{
                                                        item.nombre }}
                                                    </option>

                                                </select>
                                                <label for="floatingSelect">Seleccionar Archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="text-align: end;">
                                            <button type="button" class="btn btn-primary" @click="mostrarDivArchivos">Nuevo
                                                Archivo</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div v-show="mostrarArchivo" class="row">
                                        <div class="col-md-6">
                                            <input class="form-control form-control" id="formFileSm" type="file"
                                                @change="seleccionarArchivoEnvio" />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="floatingInput"
                                                    placeholder="Nombre" style="height: 43px;" v-model="nombreArchivoEnvio">
                                                <label for="floatingInput">Nombre del Archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-primary" id="archivoEnvio"
                                                @click="guardarArchivoEnvio(index)">Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" style="text-align: end;">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success" @click="enviarArchivoWhats">Enviar
                                                por WhatsApp</button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success">Enviar por Correo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Agendada-->

            <!-- Modal Agendada EDITAR-->
            <div class="modal fade" id="modalHoraAgendadaEditar" tabindex="-1"
                aria-labelledby="modalHoraAgendadaEditarLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #fcb29f;">
                            <h4 class="modal-title" id="modalHoraAgendadaEditar">Hora Agendada</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row" style="text-align: center; margin-bottom: 20px;">
                                <h4><b>{{ infoPaciente.nombre }}</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>

                            <br>
                            <div style="text-align: center;">
                                <h5 style="font-size: large;">Historial Clínico</h5>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tareas Asignadas</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                        placeholder="Tareas asignadas al paciente esta sesión"
                                        v-model="infoExpediente.tareas"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Observaciones de la sesión"
                                        v-model="infoExpediente.observaciones"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" @click="editarExpediente()">Editar
                                Expediente</button>
                            <!-- <button type="button" class="btn btn-danger" @click="openModalCancelarCita()">Cancelar
                                Cita</button> -->
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Agendada EDITAR-->

            <!-- Modal Especial-->
            <div class="modal fade" id="modalHoraEspecial" tabindex="-1" aria-labelledby="modalHoraEspecialLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #dec7e9;">
                            <h4 class="modal-title" id="modalHoraEspecial">Horario Especial</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="text-align: center; margin-bottom: 20px;">
                                <h4><b>{{ infoPaciente.nombre }}</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <p><b>Nombre del Paciente:</b> {{ infoPaciente.nombre }}</p> -->
                                <p><b>Tiempo de Consulta:</b> {{ infoHorario.tiempo }} minutos</p>
                            </div>
                            <br>
                            <div style="text-align: center;">
                                <h5 style="font-size: large;">Historial Clínico</h5>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tareas Asignadas</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                        placeholder="Tareas asignadas al paciente esta sesión"
                                        v-model="infoHistorial.tareas"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Observaciones de la sesión"
                                        v-model="infoHistorial.observaciones"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click="openModalCancelarCita()">Cancelar
                                Cita</button>
                            <button type="button" class="btn btn-success" @click="guardarHistorialClinico()">Guardar
                                Información</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Especial-->

            <!-- Modal Especial Editar-->
            <div class="modal fade" id="modalHoraEspecialEditada" tabindex="-1"
                aria-labelledby="modalHoraEspecialEditadaLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #dec7e9;">
                            <h4 class="modal-title" id="modalHoraEspecialEditada">Horario Especial</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="text-align: center; margin-bottom: 20px;">
                                <h4><b>{{ infoPaciente.nombre }}</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <p><b>Nombre del Paciente:</b> {{ infoPaciente.nombre }}</p> -->
                                <p><b>Tiempo de Consulta:</b> {{ infoHorario.tiempo }} minutos</p>
                            </div>
                            <br>
                            <div style="text-align: center;">
                                <h5 style="font-size: large;">Historial Clínico</h5>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tareas Asignadas</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                        placeholder="Tareas asignadas al paciente esta sesión"
                                        v-model="infoExpediente.tareas"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Observaciones de la sesión"
                                        v-model="infoExpediente.observaciones"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" @click="editarExpediente()">Editar
                                Expediente</button>
                            <!-- <button type="button" class="btn btn-danger" @click="openModalCancelarCita()">Cancelar
                                Cita</button> -->
                        </div>

                    </div>
                </div>
            </div><!-- End Modal Especial Editar-->


            <!-- Modal Inhabilitada-->
            <div class="modal fade" id="modalHoraInhabilitada" tabindex="-1" aria-labelledby="modalHoraInhabilitadaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #747c87;">
                            <h4 class="modal-title" id="modalHoraInhabilitada" style="color: white;">Hora Inhabilitada</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" @click="habilitarHora">Habilitar
                            Hora</button>
                    </div>
                </div>
            </div><!-- End Modal Inhabilitada-->


            <!-- Modal Horario Especial-->
            <div class="modal fade" id="modalHorarioEspecial" tabindex="-1" aria-labelledby="modalHorarioEspecialLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHorarioEspecialLabel">Agendar Horario Especial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Selecciona un paciente</p>
                                    <select class="form-select" aria-label="Default select example"
                                        v-model="infoPaciente.id">
                                        <option v-for="(item, index) in pacientes" :value="item.id">{{ item.nombre }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Fecha de consulta</p>
                                    <div style="margin-bottom: 20px;">
                                        <input id="startDate" class="form-control" type="date" v-model="fechaCita" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p>Hora de la consulta</p>
                                    <select class="form-select" aria-label="Default select example" v-model="horaConsulta">
                                        <option v-for="(item, index) in horas" :value="item">{{ item }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <p>Tiempo de consulta</p>
                                    <select class="form-select" v-model="getTiempoConsulta"
                                        aria-label="Default select example">
                                        <option v-for="(item, index) in tiempoConsulta" :value="item.value">{{ item.nombre
                                        }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" @click="agendarHoraEspecial()">Agendar</button>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div><!--End Modal Horario Especial-->

            <!-- Modal Agendada-->
            <div class="modal fade" id="modalCancelarCita" tabindex="-1" aria-labelledby="modalCancelarCitaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #fcb29f;">
                            <h4 class="modal-title" id="modalCancelarCita">Cancelar Cita</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="text-align: center; margin-bottom: 20px;">
                                <h4><b>{{ infoPaciente.nombre }}</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Fecha:</b> {{ agendarProspecto.fecha }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Hora:</b> {{ agendarProspecto.hora }}</p>
                                </div>
                            </div>

                            <br>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success">Cerrar</button>
                            <button type="button" class="btn btn-danger" @click="cancelarCita()">Cancelar
                                Cita</button>
                        </div>

                    </div>
                </div>
            </div><!-- End Modal Agendada-->

            <!-- Modal Eliminar-->
            <div class="modal fade" id="modalEliminarAgenda" tabindex="-1" aria-labelledby="modalEliminarAgendaLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #fcb29f;">
                            <h4 class="modal-title" id="modalEliminarAgenda">Eliminar agenda de la semana</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que desea eliminar la agenda de esta semana?<br>(<b>{{ mesInicialEstablecido }}</b>
                                al <b>{{ mesFinalEstablecido }}</b>)</p>
                            <br>
                            <p style="font-size: small;">Al aceptar se eliminarán las citas que se hayan cargado
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success">Cerrar</button>
                            <button type="button" class="btn btn-danger" @click="eliminarAgenda()">Eliminar
                                Agenda</button>
                        </div>

                    </div>
                </div>
            </div><!-- End Modal Eliminar-->
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
            tiempoConsulta: [],
            getTiempoConsulta: 0,
            mesInicialEstablecido: '',
            mesFinalEstablecido: '',
            infoProspecto: {},
            infoPaciente: {},
            infoHistorial: {},
            infoPacienteHistorial: {},
            infoHorario: {},
            horaProximaCita: '',
            idPaciente: 0,
            agendarProspecto: {},
            pacientes: {},
            fechaCita: this.day,
            fechaProximaCita: this.day,
            horas: [],
            horaConsulta: '',
            nombreEspecialidad: '',
            infoExpediente: [],
            listaCondiones: [
                {
                    idCondicion: '',
                },
            ],
            product: {
                imagen: "",
            },
            product2: {
                imagen: "",
            },
            nombreArchivo: '',
            nombreArchivoEnvio: '',
            mostrarArchivo: false,
            archivosEspecialista: {},
            envioArchivo: {},
        }
    },
    methods: {

        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        openModalCancelarCita() {
            $("#modalCancelarCita").modal("show");
        },

        mostrarDivArchivos() {
            this.mostrarArchivo = true;
        },

        enviarArchivoWhats() {
            const thisVue = this;
            let ruta = this.envioArchivo.ruta;
            let rutaArchivo = window.location.hostname + '/storage' + ruta.substring(6); // "M"
            // console.log(this.envioArchivo.nombre);
            console.log(rutaArchivo);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://api.ultramsg.com/instance62942/messages/document",
                "method": "POST",
                "headers": {},
                "data": {
                    "token": "j9yrhy3r3l9f33ma",
                    "to": 6181839836,
                    "filename": this.envioArchivo.nombre,
                    "document": rutaArchivo,
                    "caption": "document caption"
                }
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
            });
            //console.log(this.envioArchivo);
        },
        seleccionarArchivo(e) {
            const thisVue = this;
            thisVue.product = {
                imagen: "",
            };
            let file = e.target.files[0];
            thisVue.product.imagen = file;
            thisVue.nombreArchivo = thisVue.product.imagen.name;
        },
        seleccionarArchivoEnvio(e) {
            const thisVue = this;
            thisVue.product2 = {
                imagen: "",
            };
            let file = e.target.files[0];
            thisVue.product2.imagen = file;
            thisVue.nombreArchivoEnvio = thisVue.product2.imagen.name;
        },

        async proximaCita() {
            const thisVue = this;
            let obj = {
                paciente_id: thisVue.infoPaciente.id,
                hora: thisVue.horaProximaCita,
                fecha: thisVue.fechaProximaCita,
                tiempo: thisVue.infoPacienteHistorial.tiempo
            }
            axios.post(thisVue.path_url + '/api/agendas/agendarProximaCita', obj)
                .then((res) => {
                    this.$swal(
                        'Próximo Cita',
                        'Cita generada con éxito.',
                        'success'
                    );
                })
                .catch((error) => {
                });
        },
        async guardarArchivo(index) {
            const thisVue = this;
            let formData = new FormData();
            formData.append("imagen", thisVue.product.imagen);
            formData.append("paciente_id", thisVue.infoPacienteHistorial.paciente.id);
            formData.append("agenda_id", thisVue.infoPacienteHistorial.id);
            formData.append("nombre", thisVue.nombreArchivo);
            formData.append("fecha", thisVue.infoPacienteHistorial.fecha);
            if (thisVue.product.imagen == '') {
                this.$swal(
                    'Archvios',
                    'Asegurate de seleccionar un archivo antes de guardar',
                    'warning'

                );
            } else {
                document.getElementById(index).disabled = true;
            }
            await axios
                .post(
                    thisVue.path_url + "/api/archivos/updateArchivo",
                    formData
                ).then((res) => {

                }).catch((error) => { });
        },

        async guardarArchivoEnvio(index) {
            const thisVue = this;
            let formData = new FormData();
            formData.append("imagen", thisVue.product2.imagen);
            formData.append("nombre", thisVue.nombreArchivoEnvio);
            if (thisVue.product2.imagen == '') {
                this.$swal(
                    'Archivos',
                    'Asegurate de seleccionar un archivo antes de guardar',
                    'warning'
                );

            } else {
                //document.getElementById(index).disabled = true;
                await axios.post(thisVue.path_url + "/api/envios/updateArchivo", formData
                ).then((res) => {
                    thisVue.mostrarArchivo = false;
                    this.$swal(
                        'Archivos',
                        'Archivo guardado de manera correcta',
                        'success'
                    );
                    thisVue.getArchivos();
                }).catch((error) => { });
            }

        },

        async getArchivos() {
            const thisVue = this;
            await axios
                .get(
                    thisVue.path_url + "/api/envios/getArchivos"
                )
                .then((res) => {

                    thisVue.archivosEspecialista = res.data;
                })

                .catch((error) => { })

        },
        AlterListCondicionTab(sign) {
            if (sign == '+') {
                this.listaCondiones.push({ idCondicion: '' });
            } else if (sign == '-') {
                (this.listaCondiones.length > 1) && (this.listaCondiones.pop());
            }
        },

        cancelarCita() {
            const thisVue = this;
            let obj = {
                id: thisVue.agendarProspecto.id,
                paciente_id: thisVue.infoPaciente.id
            }
            axios.post(thisVue.path_url + '/api/agendas/cancelarCita', obj)
                .then((res) => {
                    thisVue.verAgenda();
                    this.$swal(
                        'Cancelada',
                        'La cita se cancelo de manera exitosa',
                        'success'
                    );
                    $("#modalHoraAgendada").modal("hide");
                    $("#modalHoraEspecial").modal("hide");
                    $("#modalHoraEspecialEditada").modal("hide");
                    $("#modalHoraAgendadaEditar").modal("hide");
                    $("#modalCancelarCita").modal("hide");
                    thisVue.agendarProspecto = {};
                    thisVue.infoPaciente = {};

                })
                .catch((error) => {
                });
        },
        openModalEspecial() {
            $("#modalHorarioEspecial").modal("show");
        },
        guardarHistorialClinico() {
            const thisVue = this;
            thisVue.infoExpediente = [];
            thisVue.infoHistorial.paciente_id = thisVue.infoPacienteHistorial.paciente.id;
            thisVue.infoHistorial.agenda_id = thisVue.infoPacienteHistorial.id;
            thisVue.infoHistorial.fecha = thisVue.infoPacienteHistorial.fecha;
            axios.post(thisVue.path_url + '/api/expedientes/guardarExpediente', thisVue.infoHistorial)
                .then((res) => {
                    this.$swal(
                        'Expediente Guardado',
                        'El expediente se guardo de manera correcta, encontraras la información en "Pacientes"',
                        'success'

                    );
                    thisVue.verAgenda();
                    $("#modalHoraAgendada").modal("hide");
                    $("#modalHoraEspecial").modal("hide");
                })
                .catch((error) => {
                });
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
            thisVue.agendarProspecto = item;
            thisVue.agendarProspecto.hora = thisVue.agendarProspecto.hora.substring(0, 5);
            thisVue.infoPaciente = item.paciente;
            thisVue.infoPacienteHistorial = item;

            axios.post(thisVue.path_url + '/api/expedientes/verificarExpediente', item)
                .then((res) => {
                    if (res.data.length != 0) {
                        thisVue.infoExpediente = res.data[0];
                        $("#modalHoraAgendadaEditar").modal("show");
                    } else {
                        $("#modalHoraAgendada").modal("show");
                    }
                })
                .catch((error) => {
                });
        },

        async guardarArchivo(index) {
            const thisVue = this;
            let formData = new FormData();
            formData.append("imagen", thisVue.product.imagen);
            formData.append("paciente_id", thisVue.infoPacienteHistorial.paciente.id);
            formData.append("agenda_id", thisVue.infoPacienteHistorial.id);
            formData.append("nombre", thisVue.nombreArchivo);
            formData.append("fecha", thisVue.infoPacienteHistorial.fecha);
            if (thisVue.product.imagen == '') {
                this.$swal(
                    'Archvios',
                    'Asegurate de seleccionar un archivo antes de guardar',
                    'warning'

                );
            } else {
                document.getElementById(index).disabled = true;
            }
            await axios
                .post(
                    thisVue.path_url + "/api/archivos/updateArchivo",
                    formData
                ).then((res) => {

                }).catch((error) => { });
        },
        horaEspecial(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            thisVue.agendarProspecto.hora = thisVue.agendarProspecto.hora.substring(0, 5);
            thisVue.infoPaciente = item.paciente;
            thisVue.infoPacienteHistorial = item;
            axios.post(thisVue.path_url + '/api/expedientes/verificarExpediente', item)
                .then((res) => {
                    if (res.data.length != 0) {
                        thisVue.infoExpediente = res.data[0];
                        $("#modalHoraEspecialEditada").modal("show");
                    } else {
                        $("#modalHoraEspecial").modal("show");
                    }
                })
                .catch((error) => {
                });
        },
        horaApartada(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            thisVue.agendarProspecto.hora = thisVue.agendarProspecto.hora.substring(0, 5);
            thisVue.infoProspecto = item.prospecto;
            //thisVue.nombreEspecialidad = item.prospecto.servicios.alt_html;
            //console.log(item.prospecto);
            $("#modalHoraApartada").modal("show");
        },
        horaDisponible(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            thisVue.agendarProspecto.hora = thisVue.agendarProspecto.hora.substring(0, 5);
            $("#modalHoraDisponible").modal("show");
        },
        horaInhabilitada(item) {
            const thisVue = this;
            thisVue.agendarProspecto = item;
            thisVue.agendarProspecto.hora = thisVue.agendarProspecto.hora.substring(0, 5);
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
                    this.$swal(
                        'Prospecto Agendado',
                        'Nombre: ' + thisVue.agendarProspecto.prospecto.nombre + ' <br> ' +
                        'Fecha: ' + thisVue.agendarProspecto.fecha + ' <br> ' +
                        'Hora: ' + thisVue.agendarProspecto.hora.substring(0, 5) + ' <br> ',
                        'success'

                    );
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

        editarExpediente() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/expedientes/editarExpediente', thisVue.infoExpediente)
                .then((res) => {
                    this.$swal(
                        'Expediente Editado',
                        'El expediente se edito de manera correcta, encontraras la información en "Pacientes"',
                        'success'

                    );
                    thisVue.verAgenda();
                    $("#modalHoraAgendadaEditar").modal("hide");
                })
                .catch((error) => {
                });
        },
        agendarHoraEspecial() {
            const thisVue = this;

            let obj = {
                paciente_id: thisVue.infoPaciente.id,
                hora: thisVue.horaConsulta,
                fecha: thisVue.fechaCita,
                tiempo: thisVue.getTiempoConsulta

            }
            axios.post(thisVue.path_url + '/api/agendas/agendarHoraEspecial', obj)
                .then((res) => {
                    thisVue.verAgenda();
                    $("#modalHorarioEspecial").modal("hide");
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
                    this.$swal(
                        'Solicitud Rechazada',
                        '',
                        'info'

                    );
                    thisVue.verAgenda();
                    $("#modalHoraApartada").modal("hide");
                })
                .catch((error) => {

                });

        },
        modalEliminarAgenda() {
            $("#modalEliminarAgenda").modal("show");

        },
        eliminarAgenda() {
            const thisVue = this;
            let obj = {
                lunes: thisVue.recorrerLunes,
                martes: thisVue.recorrerMartes,
                miercoles: thisVue.recorrerMiercoles,
                jueves: thisVue.recorrerJueves,
                viernes: thisVue.recorrerViernes,
                sabado: thisVue.recorrerSabado,
                domingo: thisVue.recorrerDomingo,
            };
            axios.post(thisVue.path_url + '/api/agendas/eliminarAgenda', obj)
                .then((res) => {
                    this.$swal(
                        'Agenda',
                        'Se elimino la Agenda de la semana',
                        'success'

                    );
                    thisVue.verAgenda();
                    $("#modalEliminarAgenda").modal("hide");
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
                    if (res.data == 'vacio') {
                        this.$swal(
                            'Horario',
                            'Asegurate de tener un horario cargado antes de crear una agenda',
                            'error'

                        );
                        thisVue.verAgenda();
                    } else {
                        this.$swal(
                            'Agenda Generada',
                            'Del ' + thisVue.mesInicialEstablecido + ' al ' + thisVue.mesFinalEstablecido,
                            'success'

                        );
                        thisVue.verAgenda();
                    }


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
                    //console.log(res.data[8]);
                    if (res.data[8] != 0) {
                        thisVue.btngenerarAgenda = false;
                    }

                    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];

                    const mesActualInicial = res.data[7][0].split('-');
                    const mesActualFinal = res.data[7][6].split('-');


                    if (mesActualInicial[1] <= 9) {
                        thisVue.mesInicialEstablecido = mesActualInicial[0] + ' de ' + meses[mesActualInicial[1].substring(1, 2) - 1] + ' del ' + mesActualInicial[2];
                    } else {
                        thisVue.mesInicialEstablecido = mesActualInicial[0] + ' de ' + meses[mesActualInicial[1] - 1] + ' del ' + mesActualInicial[2];
                    }

                    if (mesActualFinal[1] <= 9) {
                        thisVue.mesFinalEstablecido = mesActualFinal[0] + ' de ' + meses[mesActualFinal[1].substring(1, 2) - 1] + ' del ' + mesActualFinal[2];
                    } else {
                        thisVue.mesFinalEstablecido = mesActualFinal[0] + ' de ' + meses[mesActualFinal[1] - 1] + ' del ' + mesActualFinal[2];
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
        whatsapp() {
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("Authorization", "Bearer EAACHT52FUeUBO5pZBLapfd78UGZBfUgVDanF6OgeV6ef0fvrUxBHkIYOGARuncWSznTk2VeydnxMZCjyxkHbFsELoNhWPEBvXXGC7umHoLDGiEDgKuNBV6gAFrMIkLpZC0RRAGKQkNgIqsgE46dkMx5ZCDo8Wn6cUpxK3ZAhCu5EMmXuYZBcxu4gZAnArZCQWjtK0k95ZCeSivuTHo7h8Un3cbRXYwHIJ6ODqolhEZD");

            var raw = JSON.stringify({
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "526181839836",
                "type": "document",
                "document": {
                    "link": "http://financieratest.duckdns.org/storage/clientes/21ac66362457a220d29c3373ea302b67/archivos_firmas/C1D43S9IKbVxSufCclsu5qF9z3dobBvan2XBSmRY.pdf",
                    "caption": "Anexo A como esuhda jhsbdhsak hfkjsahf kshfkasjfn bufabskfsa nejbfjsbf jbgfajf"
                }
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            fetch("https://graph.facebook.com/v17.0/125273537336410/messages", requestOptions)
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
        }
    },
    async mounted() {
        let date = new Date();
        let day = date.getDate();
        this.getPacientes();
        this.verAgenda();
        this.getHoras();
        this.getArchivos();
    }
}
</script>
<style></style>