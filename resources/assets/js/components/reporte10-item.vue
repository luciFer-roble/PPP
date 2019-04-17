<template>
    <div class="table-responsive">
        <table class="table table-bordered pb-0 mb-0">
            <thead>
            <tr>
                <th colspan="2"><span class="text-xl">SEGUIMIENTO DE PRACTICAS PREPROFESIONALES</span><span class="float-right btn btn-light"><i class="fa fa-download text-info" @click="descargar">&nbsp;Descargar</i></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="pt-1 pb-0">CARRERA: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="carrera"></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">PERIODO ACADEMICO: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="periodo"></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered pb-0 mb-0">
            <thead>
            <tr>
                <th colspan="4" class="pt-1 pb-1"><span>DATOS GENERALES</span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="pt-1 pb-1" colspan="4"><span>DATOS DEL ESTUDIANTE</span></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Nombre: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="nombrescompletos"></td>
                <td class="pt-1 pb-0">Cedula: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="cedula"></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Direccion: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="direccion"></td>
                <td class="pt-1 pb-0">Correo: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="correo"></td>
            </tr>
            <tr>
                <td colspan="4" class="pt-1 pb-1"><span class="text-bold">DATOS DE LA EMPRESA / INSTITUCIÓN DONDE REALIZÓ LA PRÁCTICA</span></td>
            </tr>
            </tbody>
        </table>
        <table v-for="(practica, index) in practicas" class="table table-bordered pb-0 mb-0">
            <tbody>
            <tr>
                <td class="pt-1 pb-1" colspan="2"><span class="text-bold">Practica No. {{ index+1 }}</span></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Nombre: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="practica.nombreempresa"></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Direccion: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="practica.direccionempresa"></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <td colspan="4" class="text-bold pt-1 pb-1">DURACION</td>
            </thead>
            <tbody  v-for="(practica, index) in practicas">
            <tr>
                <td colspan="4" class="text-bold pt-1 pb-1"><span>Practica No. {{ index+1 }}</span></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Fecha Inicio: </td>
                <td class="p-0"><input class="form-control border-0" type="date" v-model="practica.fechainiciopractica"></td>
                <td class="pt-1 pb-0">Fecha Finalizacion: </td>
                <td class="p-0"><input class="form-control border-0" type="date" v-model="practica.fechafinpractica"></td>
            </tr>
            <tr>
                <td class="pt-1 pb-0">Horario Establecido: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="practica.horariopractica"></td>
                <td class="pt-1 pb-0">Numero de Horas: </td>
                <td class="p-0"><input class="form-control border-0" type="text" v-model="practica.horaspractica"></td>
            </tr>
            <tr>
                <td colspan="4" class="text-bold pt-1 pb-1" ><span>Objetivo de la Practica</span></td>
            </tr>
            <tr rowspan="3">
                <td class="p-0" colspan="4"><input class="form-control border-0" type="text" v-model="practica.descripcionpractica"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "reporte7-item",
        props: {
            estudiante: {
                type: Object
            },
            carrera: {
                type: String
            }
        },
        data:()=>({
            practicas: [],
            carrera:'',
            periodo:'',
            nombrescompletos:'',
            cedula:'',
            direccion:'',
            correo:'',
            suma:0
        }),
        methods:{
            getpracticas: function () {
                axios.get(window.location.origin+'/api/consultar-practicas-por-estudiante',{
                    params:{'id':this.estudiante.idestudiante}
                }).then((response)=>{
                    this.practicas=response.data;
                    for(var i=0; i<Object.keys(this.practicas).length; i++){
                        this.suma += parseInt(this.practicas[i].horaspractica);
                        this.periodo = this.practicas[i].idperiodoacademico;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            descargar:function () {
                let formData = {
                };
                //formData.append('perfiles', this.perfiles);
                axios({
                    url: '/reportes/'+this.estudiante.idestudiante+'/descarga10',
                    method: 'POST',
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    responseType: 'blob'
                })
                //axios.post('/reportes/'+this.estudiante.idestudiante+'/descarga7',formData)
                    .then((response) =>{
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'prueba.xlsx'); //or any other extension
                        document.body.appendChild(link);
                        link.click();
                    }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        created() {
            this.getpracticas();
            this.cedula = this.estudiante.cedulaestudiante;
            this.direccion = this.estudiante.direccionestudiante;
            this.correo = this.estudiante.correoestudiante;
            this.nombrescompletos = this.estudiante.nombresestudiante+' '+this.estudiante.apellidosestudiante;
        }
    }
</script>

<style scoped>

</style>