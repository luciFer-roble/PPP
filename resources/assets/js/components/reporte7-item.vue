<template>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th colspan="8"><span class="text-xl">REGISTRO PRACTICAS PRE PROFESIONALES</span><span class="float-right btn btn-light"><i class="fa fa-download text-info" @click="descargar">&nbsp;Descargar</i></span></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>PRIMER APELLIDO</td>
                <td>SEGUNDO APELLIDO</td>
                <td>PRIMER NOMBRE</td>
                <td>SEGUNDO NOMBRE</td>
                <td>CEDULA</td>
                <td>USUARIO PUCE</td>
            </tr>
            <tr>
                <td>{{ nombre1 }}</td>
                <td>{{ nombre2 }}</td>
                <td>{{ apellido1 }}</td>
                <td>{{ apellido2 }}</td>
                <td>{{ estudiante.cedulaestudiante}}</td>
                <td>{{ estudiante.idestudiante}}</td>
            </tr>
        </tbody>
    </table>
    <table v-for="(practica, index) in practicas" class="table table-bordered " >
        <tbody>
        <tr>
            <td colspan="7">PRACTICA No. {{ index+1 }}</td>
        </tr>
        <tr>
            <td>PRACTICA</td>
            <td>TIPO</td>
            <td>PERFIL</td>
            <td>EMPRESA</td>
            <td>DESDE</td>
            <td>HASTA</td>
            <td>HORAS</td>
        </tr>
        <tr>
            <td>{{ index+1 }}</td>
            <td><input class="form-control border-0" type="text" v-model="practica.tipopractica"/></td>
            <td><input  class="form-control border-0" type="text" v-model="practica.sectorempresa" @change="add(practica.sectorempresa)"/></td>
            <td><input class="form-control border-0" type="text" v-model="practica.nombreempresa"/></td>
            <td><input class="form-control border-0" type="text" v-model="practica.fechainiciopractuica"/></td>
            <td><input class="form-control border-0" type="text" v-model="practica.fechafinpractica"/></td>
            <td><input class="form-control border-0" type="text" v-model="practica.horaspractica"/></td>
        </tr>
        </tbody>
    </table>
        <table class="table table-bordered">
            <tr>
                <td colspan="10">TOTAL HORAS</td>
                <td style="width: 15.4%">{{suma}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "reporte7-item",
        props: {
            estudiante: {
                type: Object
            }
        },
        data:()=>({
            practicas: [],
            perfiles:[],
            cont: 0,
            nombre1:'',
            nombre2:'',
            apellido1:'',
            apellido2:'',
            suma:0,
            perfil:''
        }),
        methods:{
            add: function (sector) {
                this.perfiles.push(sector);
            },
            getpracticas: function () {
                axios.get(window.location.origin+'/api/consultar-practicas-por-estudiante',{
                    params:{'id':this.estudiante.idestudiante}
                }).then((response)=>{
                    this.practicas=response.data;
                    for(var i=0; i<Object.keys(this.practicas).length; i++){
                        this.suma += parseInt(this.practicas[i].horaspractica);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            descargar:function () {
                let formData = {
                    perfiles: this.perfiles
                };
                //formData.append('perfiles', this.perfiles);
                axios({
                    url: '/reportes/'+this.estudiante.idestudiante+'/descarga7',
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
            this.nombre1 = this.estudiante.nombresestudiante.split(' ')[0];
            this.nombre2 = this.estudiante.nombresestudiante.split(' ')[1];
            this.apellido1 = this.estudiante.apellidosestudiante.split(' ')[0];
            this.apellido2 = this.estudiante.apellidosestudiante.split(' ')[1];
        }
    }
</script>

<style scoped>

</style>