<template>
    <div class="row">

        <div class="col-md-3">

        </div>
        <div v-if="procesoCita == true" class="col-md-6">

            <div class="card" style="background-color: azure; text-align: left;">
                <FormWizard @on-complete="onComplete" color="#bbd3c9" next-button-text="Siguiente"
                    back-button-text="Anterior" finish-button-text="Finalizar" @on-change="vamosSiguente">
                    <TabContent title="Registro" icon="fa fa-user">
                        <div class="tab-pane" id="informacion">
                            <h3 style="text-align: center;">REGISTRO DE CITA</h3>
                            <div class="row" style="text-align: center">
                                <h5 style="padding: 25px">Vamos a crear tu cita personal y asignarte el mejor psicólogo
                                    acorde a tus necesidades. En solo unos sencillos pasos...</h5>
                                <div>
                                    <img src="http://saludintegraltest.duckdns.org/principal/assets/img/registro.png"
                                        width="150" height="150">
                                    <p style="padding: 25px">Agradeciendo que llene el formulario de manera correcta para
                                        ofrecerle el mejor servicio que se merece.</p>

                                </div>
                            </div>
                        </div>
                    </TabContent>
                    <TabContent title="¿Qué buscas solucionar?" icon="fa-solid fa-question">
                        <div class="row">
                            <div class="form-floating col-md-5">
                                <label class="form-label">Que buscas solucionar con la terapia</label>
                                <Multiselect v-model="servicioSeleccionado" :searchable="true" :create-option="false"
                                    :options="options" @select="getNuevaLista()" />

                            </div>
                            <div class="form-floating col-md-6" style="margin-left: 25px;">

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Ingresa la
                                        descripción</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                                        v-model="generarCita.comentario"></textarea>
                                </div>
                                <p style="font-size: smaller;">Si no encontraste lo que buscabas, ingresa una breve
                                    descripción de lo que buscas
                                    solucionar.</p>
                            </div>
                        </div>
                    </TabContent>
                    <TabContent title="Terapeutas" icon="fa-solid fa-user-doctor">

                        <div class="row">
                            <div class="col-md-9" style="text-align: center;">
                                <h4>{{ fechaCompleta }}</h4>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 20px;">
                                <label for="startDate">Selecciona una fecha:</label>
                                <input id="startDate" class="form-control" @change="getEspecialistas(item)" type="date"
                                    v-model="fechaCita" />

                            </div>
                        </div>

                        <div class="card">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- <div v-if="item.foto == null" style="margin-left: 10px;">
                                        <img :src="path_url + 'assets/images/logos/perfil.png'"
                                            style="height: 60px; width: 60px; background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;">
                                    </div>
                                    <div v-else>
                                        <img :src="path_url + 'storage/' + (item.foto.imagen_path).substring(6)"
                                            style="height: 60px; width: 60px; background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;">
                                    </div> -->
                                    <div class="card-body" style="margin-left: 10px;">
                                        <h4 class="card-title">{{ especialista.titulo }} {{ especialista.nombre }}
                                            {{ especialista.apellido_pat }}
                                            {{ especialista.apellido_mat }}</h4>
                                        <!-- <h5>{{ item.especialidad }}</h5> -->
                                        <p class="card-text">{{ especialista.descripcion }}</p>
                                    </div>
                                </div>

                                <!-- <div v-if="item.contador_mañana != 0 || item.contador_tarde != 0" class="row col-md-4"
                                    style="text-align: center;">
                                    <div class="col-md-6">
                                        <div v-for="(horas, index) in item.horario_mañana" style="padding-bottom: 5px;">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                v-on:click="obtenerHora(horas)">{{ horas.hora.substring(0, 5) }}</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div v-for="(horas, index) in item.horario_tarde" style="padding-bottom: 5px;">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                v-on:click="obtenerHora(horas)">{{ horas.hora.substring(0, 5) }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="row col-md-4" style="text-align: center;">
                                    <i class="fa-regular fa-calendar-xmark"></i>
                                    <p>Este calendario ya tiene todas sus horas cubiertas</p>
                                </div> -->

                            </div>

                        </div>

                    </TabContent>
                    <TabContent title="Sobre ti" icon="fa-regular fa-address-card">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <p><b>¿Cuál es tu rango de edad?</b></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="edad" value="Menos de 18"
                                            v-model="generarCita.edad">
                                        <label class="form-check-label" for="edad">
                                            Menos de 18
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="edad" value="18-25"
                                            v-model="generarCita.edad">
                                        <label class="form-check-label" for="edad">
                                            18-25
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="edad" value="26 - 35"
                                            v-model="generarCita.edad">
                                        <label class="form-check-label" for="edad">
                                            26-35
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="edad" value="36 - 45"
                                            v-model="generarCita.edad">
                                        <label class="form-check-label" for="edad">
                                            36-45
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="edad" value="Más de 45"
                                            v-model="generarCita.edad">
                                        <label class="form-check-label" for="edad">
                                            Más de 45
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <p><b>¿Es tu primera vez en terapia?</b></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="primera_vez" value="Si"
                                            v-model="generarCita.primera_vez">
                                        <label class="form-check-label" for="primera_vez">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="primera_vez" value="No"
                                            v-model="generarCita.primera_vez">
                                        <label class="form-check-label" for="primera_vez">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <p><b>Sexo</b></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" value="Femenino"
                                            v-model="generarCita.sexo">
                                        <label class="form-check-label" for="sexo">
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" value="Masculino"
                                            v-model="generarCita.sexo">
                                        <label class="form-check-label" for="sexo">
                                            Masculino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" value="Otro"
                                            v-model="generarCita.sexo">
                                        <label class="form-check-label" for="sexo">
                                            Otro
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-sm-6">
                                        <p><b>¿Qué modalidad buscas?</b></p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="modalidad"
                                                v-model="generarCita.modalidad" value="Presencial">
                                            <label class="form-check-label" for="modalidad">
                                                Presencial
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="modalidad"
                                                v-model="generarCita.modalidad" value="En Línea">
                                            <label class="form-check-label" for="modalidad">
                                                En línea
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row" style="text-align: center;">
                            <p><b>¿Qué buscas solucionar con la terapia?</b></p>
                        </div> -->
                    </TabContent>
                    <TabContent title="Datos de Contacto" icon="fa-regular fa-address-book">
                        <div class="row">
                            <h5 class="info-text">Datos del paciente</h5>
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <label for="floatingInput">Nombre Completo</label>
                                        <input type="text" name="nombre" class="form-control" id="floatingInput"
                                            placeholder="Nombre Completo" v-model="generarCita.nombre">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingInput">Correo Electrónico</label>
                                        <input type="email" name="correo" class="form-control" id="floatingInput"
                                            placeholder="Correo Electrónico" v-model="generarCita.correo">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingInput">Teléfono</label>
                                        <input type="text" name="celular" class="form-control" id="floatingInput"
                                            placeholder="Teléfono" v-model="generarCita.celular">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <ul>
                            <li v-for="error in errors" style="background-color: red;"><strong>{{ error[0] }}</strong></li>
                        </ul> -->
                    </TabContent>
                </FormWizard>
                <div v-if="bandera != false"
                    style="text-align: center; background-color:#f8d7da; border-radius: 10px; padding-bottom: 25px;">
                    <ul>
                        <p style="color: #9c413d;"><strong>ASEGURATE DE INGRESAR TODOS LOS DATOS DEL FORMULARIO</strong></p>
                        <li v-for="error in errors" style="color: #9c413d;">{{ error[0] }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div v-else class="col-md-6">
            <div class="card" style="background-color: azure; text-align: left;">
                <div class="tab-pane" id="informacion">
                    <h3 style="text-align: center;">SOLICITUD ENVIADA</h3>
                    <div class="row" style="text-align: center">
                        <h5 style="padding: 25px">Su solicitud a sido enviada al terapeuta, el se comunicara con usted lo
                            antes posible para confirmar su cita. </h5>
                        <div>
                            <img src="principal/assets/img/registro.png" width="150" height="150">
                            <p style="padding: 25px">Gracias por su tiempo.</p>

                        </div>
                        <div style="text-align: center;">
                            <input type='button' onclick="location.href='/'" class='btn btn-fill btn-danger btn-wd'
                                value='Aceptar' />
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect'
import { FormWizard, TabContent } from "vue3-form-wizard";
import "vue3-form-wizard/dist/style.css";


export default {
    components: {
        FormWizard,
        TabContent,
        Multiselect
    },
    data() {
        return {

            path_url: window.vue_url,
            options: [],
            servicioSeleccionado: 0,
            especialista: {},
            generarCita: {},
            nuevoHorario: [],
            fechaCita: 0,
            mesActual: '',
            fechaCompleta: '',
            procesoCita: true,
            contador: 0,
            nuevaLista: [],
            bandera: false,
            errors: []
        }
    },
    methods: {
        obtenerHora(horas) {
            this.generarCita.hora_cita = horas.id;
        },

        vamosSiguente() {
            const thisVue = this;
            this.contador = this.contador + 1;
            // if (this.contador == 2) {
            // if (this.nuevaLista.length == 0) {
            //     this.nuevaLista = this.especialistas;
            //     //console.log(this.nuevaLista, 'entramos a sigueinte');
            // }
            // }
        },

        onComplete() {
            const thisVue = this;
            thisVue.generarCita.servicios_id = thisVue.servicioSeleccionado;
            axios.post(thisVue.path_url + '/api/citas/agendarCita', thisVue.generarCita)
                .then((res) => {
                    thisVue.procesoCita = false;
                })
                .catch((error) => {
                    this.errors = JSON.parse(
                        JSON.stringify(error.response.data.errors)
                    );
                    thisVue.bandera = true;

                });
        },

        obtenerCita() {
            const thisVue = this;
            var URLactual = window.location;
            
            console.log(URLactual.href.split('/'));

            //editor
            axios.get(thisVue.path_url + '/api/citas/agendarCitaId')
                .then((res) => {

                })
                .catch((error) => {

                });
        }

    },

    async mounted() {
        this.obtenerCita();

        let date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        if (month < 10) {
            this.fechaCita = (`${year}-0${month}-${day}`)
            if (day < 10) {
                this.fechaCita = (`${year}-0${month}-0${day}`)
            }
        } else {
            this.fechaCita = (`${year}-${month}-${day}`)
            if (day < 10) {
                this.fechaCita = (`${year}-0${month}-0${day}`)
            }
        }
    }
}
</script>
<style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css");
</style>