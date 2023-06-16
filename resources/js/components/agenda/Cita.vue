<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h3>Agenda</h3>
                </div>
                <div class="col-md-6">
                    <h3>Aqui se muestra la semana</h3>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" style="margin: 5px;" disabled>Disponible</button>
                    <button type="button" class="btn btn-warning" style="margin: 5px;" disabled>Solicitada</button>
                    <button type="button" class="btn btn-danger" style="margin: 5px;" disabled>Agendada</button>
                    <button type="button" class="btn btn-dark" style="margin: 5px;" disabled>Inactiva</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <!-- <button type="button" class="btn btn-success" style="margin: 5px;" @click="generarAgenda()">Generar Agenda</button> -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Lunes</b></p>
                    <div v-for="(item, index) in recorrerLunes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Martes</b></p>
                    <div v-for="(item, index) in recorrerMartes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Miércoles</b></p>
                    <div v-for="(item, index) in recorrerMiercoles" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Jueves</b></p>
                    <div v-for="(item, index) in recorrerJueves" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Viernes</b></p>
                    <div v-for="(item, index) in recorrerViernes" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Sabado</b></p>
                    <div v-for="(item, index) in recorrerSabado" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Hola'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <p><b>Domingo</b></p>
                    <div v-for="(item, index) in recorrerDomingo" style="padding: 2px;">
                        <button v-if="item.proceso == 'Disponible'" type="button" class="btn btn-success"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Apartada'" type="button" class="btn btn-warning"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Agendada'" type="button" class="btn btn-danger"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Hola'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
                        <button v-if="item.proceso == 'Inactiva'" type="button" class="btn btn-dark"
                            style=" width:80px;height:40px;">{{ item.hora.substring(0, 5) }}</button>
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

            recorrerLunes: {},
            recorrerMartes: {},
            recorrerMiercoles: {},
            recorrerJueves: {},
            recorrerViernes: {},
            recorrerSabado: {},
            recorrerDomingo: {},
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        generarAgenda() {
            const thisVue = this;
            axios.post(thisVue.path_url + '/api/agendas/generarAgenda')
                .then((res) => {
                    thisVue.verAgenda();
                })
                .catch((error) => {

                });
        },
        verAgenda() {
            const thisVue = this;
            axios.get(thisVue.path_url + '/api/agendas/verAgenda')
                .then((res) => {
                    thisVue.recorrerLunes = res.data[0];
                    thisVue.recorrerMartes = res.data[1];
                    thisVue.recorrerMiercoles = res.data[2];
                    thisVue.recorrerJueves = res.data[3];
                    thisVue.recorrerViernes = res.data[4];
                    thisVue.recorrerSabado = res.data[5];
                    thisVue.recorrerDomingo = res.data[6];
                })
                .catch((error) => {

                });
        },
    },
    async mounted() {
        //this.generarAgenda();
        this.verAgenda();

    }
}
</script>
<style></style>