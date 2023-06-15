<template>
    <div class="card">
        <div class="card-body">
            <h3>Crear Agenda</h3>
            <br>
            <div class="row row_margin">
                <div class="col-md-2">
                    <label>Año</label>
                    <input v-model="this_year" class="form-control" type="number" placeholder="Año">
                </div>
                <div class="col-md-3">
                    <label>Semana</label>
                    <select class="form-select" v-model="valorSemana" aria-label="Default select example"
                        @change="obtenerDias()">
                        <option v-for="(item, index) in semanas" :value="item.value">{{ item.nombre }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Tiempo que dura la sesion</label>
                    <select class="form-select" v-model="getTiempoConsulta" aria-label="Default select example">
                        <option v-for="(item, index) in tiempoConsulta" :value="item.value">{{ item.nombre }}</option>
                    </select>
                </div>
            </div>
            <div class="row" style="text-align: center;">
                <div v-if="mostratFecha == false" class="col-md-12">
                    <h5 style="margin-top: 10px;">Selecciona una semana</h5>
                </div>
                <div v-else class="col-md-12">
                    <h5 style="margin-top: 30px;"><b>Semana {{ valorSemana }}</b> del {{ primerDia }} al {{ ultimoDia }}
                    </h5>
                </div>

            </div>
            <div class="row" v-for="(item, index) in dias" style="margin-top: 20px;" :name="item.dia">
                <div class="col-md-1">
                    <p style="margin-top: 10px;"><b>{{ item.dia }}</b></p>
                </div>
                <div class="row col-md-5">
                    <div class="col-md-5">
                        <select class="form-select" aria-label="Default select example" v-model="item.primeraHora">
                            <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                        </select>
                    </div>
                    a
                    <div class="col-md-5">
                        <select class="form-select" aria-label="Default select example" v-model="item.segundaHora">
                            <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" @click="nuevoHorario()">+</button>
                    </div>
                </div>
                <div v-if="agregarHorario == true" class="row col-md-5">
                    <div class="col-md-5">
                        <select class="form-select" aria-label="Default select example" v-model="item.primeraHora">
                            <option v-for="(horaUno, index) in horas" :value="horaUno">{{ horaUno }}</option>
                        </select>
                    </div>
                    a
                    <div class="col-md-5">
                        <select class="form-select" aria-label="Default select example" v-model="item.segundaHora">
                            <option v-for="(horaDos, index) in horas" :value="horaDos">{{ horaDos }}</option>
                        </select>
                    </div>
                </div>
                <div v-else class="col-md-5">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" @click="guardarHorario(item)"
                        :id="item.dia">Guardar</button>
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
            semanas: [],
            valorSemana: 0,
            primerDia: '',
            ultimoDia: '',
            mostratFecha: false,
            dias: [],
            horas: [],
            tiempoConsulta: [],
            getTiempoConsulta: 0,
            agregarHorario: false
        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },
        nuevoHorario() {
            this.agregarHorario = true;
        },
        guardarHorario(item) {
            const thisVue = this;
            const btncompra = document.getElementById(item.dia);
            console.log(btncompra)
            btncompra.disabled = true;
            let obj = {
                primera: item.primeraHora,
                segunda: item.segundaHora,
                fecha: item.datos,
                tiempoConsulta: thisVue.getTiempoConsulta,
                dia: item.dia
            }
            if (thisVue.getTiempoConsulta == 0) {
                console.log('asegurate de ingresar tu tiempo de consulta')
            } else {
                axios.post(thisVue.path_url + '/api/agendas/generarAgenda', obj)
                    .then((res) => {

                    })
                    .catch((error) => {

                    });
            }
        },

        obtenerDias() {
            const thisVue = this;
            let obj = {
                year: thisVue.this_year,
                semana: thisVue.valorSemana
            }
            axios.post(thisVue.path_url + '/api/agendas/obtenerDias', obj)
                .then((res) => {
                    thisVue.dias[0] = {
                        dia: 'Lunes',
                        datos: res.data[0],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[1] = {
                        dia: 'Martes',
                        datos: res.data[1],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[2] = {
                        dia: 'Miercoles',
                        datos: res.data[2],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[3] = {
                        dia: 'Jueves',
                        datos: res.data[3],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[4] = {
                        dia: 'Viernes',
                        datos: res.data[4],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[5] = {
                        dia: 'Sabado',
                        datos: res.data[5],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.dias[6] = {
                        dia: 'Domingo',
                        datos: res.data[6],
                        primeraHora: '00:00',
                        segundaHora: '00:00'
                    };
                    thisVue.mostratFecha = true;

                    const mesPrimerDia = res.data[0].split("-");
                    const monthName = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    const numeroMes1 = mesPrimerDia[1];
                    thisVue.primerDia = mesPrimerDia[0] + ' de ' + monthName[numeroMes1 - 1] + ' del ' + mesPrimerDia[2];

                    const mesUltimoDia = res.data[6].split("-");
                    const numeroMes2 = mesUltimoDia[1];
                    thisVue.ultimoDia = mesUltimoDia[0] + ' de ' + monthName[numeroMes2 - 1] + ' del ' + mesUltimoDia[2];
                })
                .catch((error) => {

                });
        },

        getSemanas() {
            const thisVue = this;
            axios.get(thisVue.path_url + '/api/agendas/getSemanas')
                .then((res) => {
                    thisVue.semanas = res.data;

                })
                .catch((error) => {

                });
        },

        getHoras() {
            const thisVue = this;
            axios.get(thisVue.path_url + '/api/agendas/getHoras')
                .then((res) => {
                    thisVue.horas = res.data;
                })
                .catch((error) => {

                });

            axios.get(thisVue.path_url + '/api/agendas/tiempoConsulta')
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
        this.getSemanas();
        this.getHoras();
    }
}
</script>
<style></style>