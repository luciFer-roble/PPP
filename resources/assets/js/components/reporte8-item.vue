<template>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="5"><span class="text">LÍNEAS DE PRÁCTICAS PRE PROFESIONALES EN FUNCIÓN DEL PERFIL PROFESIONAL Y LAS AREAS DE FORMACIÓN</span>
                    <span class="float-right btn btn-light"><i class="fa fa-download text-info" @click="descargar">&nbsp;Descargar</i></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td>PRACTICA 1</td>
                <td>PRACTICA 2</td>
                <td>PRACTICA 3</td>
                <td>PRACTICA 4</td>
            </tr>
            <tr>
                <td>Desarrollo de Soluciones Informaticas</td>
                <td><input value="0" type="checkbox" @click="ponertrue('0')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('1')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('2')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('3')"/></td>
            </tr>
            <tr>
                <td>Gestion de Tics</td>
                <td><input value="0" type="checkbox" @click="ponertrue('4')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('5')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('6')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('7')"/></td>
            </tr>
            <tr>
                <td>bases de datos</td>
                <td><input value="0" type="checkbox" @click="ponertrue('8')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('9')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('10')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('11')"/></td>
            </tr>
            <tr>
                <td>Redes y Comunicaciones</td>
                <td><input value="0" type="checkbox" @click="ponertrue('12')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('13')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('14')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('15')"/></td>
            </tr>
            <tr>
                <td>Seguridad de la Informacion</td>
                <td><input value="0" type="checkbox" @click="ponertrue('16')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('17')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('18')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('19')"/></td>
            </tr>
            <tr>
                <td>Mantenimiento y soporte tecnico</td>
                <td><input value="0" type="checkbox" @click="ponertrue('20')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('21')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('22')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('23')"/></td>
            </tr>
            <tr>
                <td>Gestion de proyectos</td>
                <td><input value="0" type="checkbox" @click="ponertrue('24')"/></td>
                <td><input value="1" type="checkbox" @click="ponertrue('25')"/></td>
                <td><input value="2" type="checkbox" @click="ponertrue('26')"/></td>
                <td><input value="3" type="checkbox" @click="ponertrue('27')"/></td>
            </tr>
            <tr>
                <td>Aplicaciones Matematicas</td>
                <td><input value="28" type="checkbox" @click="ponertrue('28')"/></td>
                <td><input value="29" type="checkbox" @click="ponertrue('29')"/></td>
                <td><input value="30" type="checkbox" @click="ponertrue('30')"/></td>
                <td><input value="31" type="checkbox" @click="ponertrue('31')"/></td>
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
            }
        },
        data:()=>({
            practicas: [],
            cont: 0,
            nombre1:'',
            nombre2:'',
            apellido1:'',
            apellido2:'',
            suma:0,
            check: []
        }),
        methods:{
            ponertrue:function (i) {
                this.check[i] = true;
                console.log(i);
            },
            ponerfalse:function (i) {
                this.check[i] = false;
                console.log('ponerfalse');
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
                    checks: this.check
                };
                //formData.append('perfiles', this.perfiles);
                axios({
                    url: '/reportes/'+this.estudiante.idestudiante+'/descarga8',
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
            for (let i = 0 ; i < 32; i++){
                this.check.push(false);
            }
        }
    }
</script>

<style scoped>

</style>