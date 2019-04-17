<template>
    <table class="table table-bordered p-0 m-0" style="table-layout: fixed">
        <!--<thead>
        <tr style="">
            <th  style="width:  12%" class="p-1 m-0">Identificacion</th>
            <th  style="width:  16%" class="p-1 m-0">Apellidos y Nombres</th>
            <th  style="width:  13%" class="p-1 m-0">Unidad Academica</th>
            <th  style="width:  25%" class="p-1 m-0">Carrera</th>
            <th  style="width:  13%" class="p-1 m-0">Celular</th>
            <th  style="width:  14%" class="p-1 m-0">Correo</th>
            <th  colspan="2"  style="width:  7.318912295584146%;" class="p-1 m-0">Horas</th>
        </tr>
        </thead>-->
        <tr style="background-color: white">
            <th  style="width:  12%; background-color:  #688ebe ; color: white; text-align: center" class="p-1 m-0">Estudiante: </th>
            <td style="width:  8%" class="p-1 m-0" >{{ estudiante.cedulaestudiante }}</td>
            <td style="width:  16%" class="p-1 m-0" >{{ estudiante.nombresestudiante }}  {{ estudiante.apellidosestudiante }}</td>
            <td style="width:  13%" class="p-1 m-0">{{ facultad }}</td>
            <td style="width:  25%" class="p-1 m-0">{{ carrera }}</td>
            <td style="width:  13%" class="p-1 m-0">{{ estudiante.celularestudiante }}</td>
            <td style="width:  14%" class="p-1 m-0">{{ estudiante.correoestudiante }}</td>
            <td style="width:  10%" class="p-1 m-0" align="center">Horas: {{ estudiante.horasestudiante }}</td>
            <td style="width: 19px" v-if="!practicas" class="p-1 m-0"><i @click="verpracticas" class="fa fa-angle-down "></i></td>
            <td style="width: 19px" v-if="practicas" class="p-1 m-0"><i @click="ocultarpracticas" class="fa fa-angle-up "></i></td>
        </tr>
        <tr>
            <td v-show="practicas" colspan="9" class="p-0 m-0">
                <table class="table table-bordered p-0 m-0">
                    <thead>
                    <tr style="background-color: #F2F2F2">
                        <th class="p-1 m-0">Practica</th>
                        <th class="p-1 m-0">Fecha Inicio</th>
                        <th class="p-1 m-0">Fecha Fin</th>
                        <th class="p-1 m-0">Tipo Proyecto</th>
                        <th class="p-1 m-0">No. Horas</th>
                        <th class="p-1 m-0">Empresa</th>
                        <th class="p-1 m-0">Tipo empresa</th>
                        <th class="p-1 m-0">Sector</th>
                        <th colspan="2" class="p-1 m-0">Tutor Academico</th>
                        <th class="p-1 m-0">Tutor Empresarial</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in lista">
                        <td class="p-1 m-0">P{{index+1}}</td>
                        <td class="p-1 m-0">{{item.fechainiciopractica}}</td>
                        <td class="p-1 m-0">{{item.fechafinpractica}}</td>
                        <td class="p-1 m-0">{{item.tipopractica}}</td>
                        <td class="p-1 m-0">{{item.horaspractica}}</td>
                        <td class="p-1 m-0">{{item.nombreempresa}}</td>
                        <td class="p-1 m-0">{{item.tipoempresa}}</td>
                        <td class="p-1 m-0">{{item.sectorempresa}}</td>
                        <td colspan="2" class="p-1 m-0">{{item.nombresprofesor+' '+item.apellidosprofesor}}</td>
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
        name: 'estudiante-item',
        props: {
            estudiante: {
                type: Object
            },
            carrera: String,
            facultad: String
        },
        data:()=>({
            lista:[],
            practicas: false
        }),
        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-practicas-por-estudiante',{
                    params:{'id':this.estudiante.idestudiante}
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