<template>
    <table class="table table-bordered p-0 m-0" style="table-layout: fixed">
        <tr>
            <td style="width:  12%" class="p-1 m-0" >{{ estudiante.cedulaestudiante }}</td>
            <td style="width:  16%" class="p-1 m-0" >{{ estudiante.nombresestudiante }}  {{ estudiante.apellidosestudiante }}</td>
            <td style="width:  13%" class="p-1 m-0">{{ facultad }}</td>
            <td style="width:  25%" class="p-1 m-0">{{ carrera }}</td>
            <td style="width:  13%" class="p-1 m-0">{{ estudiante.celularestudiante }}</td>
            <td style="width:  14%" class="p-1 m-0">{{ estudiante.correoestudiante }}</td>
            <td style="width:  6%" class="p-1 m-0" align="center">{{ estudiante.horasestudiante }}</td>
            <td style="width: 19px" v-if="!practicas" class="p-1 m-0"><i @click="verpracticas" class="fa fa-angle-down "></i></td>
            <td style="width: 19px" v-if="practicas" class="p-1 m-0"><i @click="ocultarpracticas" class="fa fa-angle-up "></i></td>
        </tr>
        <tr>
            <td v-show="practicas" colspan="8">
                <table class="table table-bordered p-0 m-1">
                    <thead>
                    <tr>
                        <th class="p-1 m-0">No.</th>
                        <th class="p-1 m-0">Inicio</th>
                        <th class="p-1 m-0">Fin</th>
                        <th class="p-1 m-0">Tipo Proyecto</th>
                        <th class="p-1 m-0">No. Horas</th>
                        <th class="p-1 m-0">Empresa</th>
                        <th class="p-1 m-0">Tipo empresa</th>
                        <th class="p-1 m-0">Sector</th>
                        <th class="p-1 m-0">Tutor A.</th>
                        <th class="p-1 m-0">Tutor E.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in lista">
                        <td class="p-1 m-0">P{{item.idpractica}}</td>
                        <td class="p-1 m-0">{{item.fechainiciopractica}}</td>
                        <td class="p-1 m-0">{{item.fechafinpractica}}</td>
                        <td class="p-1 m-0">{{item.tipopractica}}</td>
                        <td class="p-1 m-0">{{item.horaspractica}}</td>
                        <td class="p-1 m-0">{{item.nombreempresa}}</td>
                        <td class="p-1 m-0">{{item.tipoempresa}}</td>
                        <td class="p-1 m-0">{{item.sectorempresa}}</td>
                        <td class="p-1 m-0">{{item.nombresprofesor+' '+item.apellidosprofesor}}</td>
                        <td class="p-1 m-0">{{item.nombretutore+' '+item.apellidotutore}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</template>

<script>
    export default {
        name: 'reporte1',
        props: {
            estudiante: {
                type: Object
            },
            carrera: String,
            facultad: String,
            nivel: String
        },
        data:()=>({
            lista:[],
            practicas: false
        }),
        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-practicas-por-nivel',{
                    params:{'idestudiante':this.estudiante.idestudiante,
                        'nivel':this.nivel}
                }).then((response)=>{
                    this.lista=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

            },
            verpracticas:function() {
                this.practicas = true;
            },
            ocultarpracticas:function() {
                this.practicas = false;
            }

        },
        created() {
            this.cargardatos();
        }
    }
</script>

<style scoped>

</style>