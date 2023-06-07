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
                <div v-if="mostratFecha == false" class="col-md-6">
                    <h5 style="margin-top: 30px;">Selecciona una semana</h5>
                </div>
                <div v-else class="col-md-7">
                    <h5 style="margin-top: 30px;"><b>Semana {{ valorSemana }}</b> del {{ primerDia }} al {{ ultimoDia }}</h5>
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
            mostratFecha: false

        }
    },
    methods: {
        disparador(funcion, obj = null,) {
            this[funcion](obj);
        },

        obtenerDias() {
            const thisVue = this;
            let obj = {
                year: thisVue.this_year,
                semana: thisVue.valorSemana
            }
            axios.post(thisVue.path_url + '/api/agendas/obtenerDias', obj)
                .then((res) => {
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
    },
    async mounted() {
        const d = new Date();
        this.this_year = d.getFullYear();
        this.getSemanas()
    }
}
</script>
<style></style>