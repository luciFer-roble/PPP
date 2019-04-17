<template>
    <div class="table-responsive" >
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="gris" colspan="5"><h6>INFORME DE FINALIZACIÓN DE ACTIVIDADES DE VINCULACIÓN CON LA COLECTIVIDAD</h6></th>
                <th><span class="float-right btn btn-light"><i class="fa fa-download text-info" @click="descargar">&nbsp;Descargar</i></span></th>
            </tr>
            </thead>
            <tbody>
            <tr><td colspan="6"></td></tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Nombre y Apellido Completod del Docente:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="nombrecompleto"/></td>
            </tr>
            <tr><td colspan="6"></td></tr>
            <tr>
                <td style="width: 15%" class="pt-1 mt-0 pb-0 mb-0 gris">Carrera:</td>
                <td style="width: 35%" class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="text" v-model="carrera"/></td>
                <td style="width: 17%" class="pt-1 mt-0 pb-0 mb-0 gris">Cedula:</td>
                <td style="width: 33%" class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="text" v-model="cedula"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris">Email:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="text" v-model="correo"/></td>
                <td class="pt-1 mt-0 pb-0 mb-0 gris">Telefono:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="text" v-model="celular"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris">Fecha de Inicio:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="date" v-model="inicio"/></td>
                <td class="pt-1 mt-0 pb-0 mb-0 gris">Fecha de Finalizacion:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="2"><input class="form-control border-0" type="date" v-model="fin"/></td>
            </tr>
            <tr><td colspan="6"></td></tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Nombre del Proyecto, curso, evento o actividad:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="proyecto"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Actividad realizada:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="actividad"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Tipo de Vinculacion:</td>
                <td class="p-0 m-0" colspan="4"><select class="form-control border-0" v-model="tipo">
                    <option value="Responsable de Practicas pre Profesionales">Responsable de Practicas pre Profesionales</option>
                </select></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Organizacion Contraparte:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="organizacion"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Docente responsable de la Unidad:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="responsable"/></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Docente Tutor del Proyecto:</td>
                <td class="pt-0 mt-0 pb-0 mb-0" colspan="4"><input class="form-control border-0" type="text" v-model="tutor"/></td>
            </tr>
            <tr><td colspan="6"></td></tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="1">No.</td>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="4">Nombre de los Estudiantes Tutorados</td>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="1">Evaluacion de Desempeno</td>
            </tr>
            <tr v-for="(estudiante, index) in estudiantes">
                <td class="pt-1 mt-0 pb-0 mb-0" colspan="1">{{ index+1 }}</td>
                <td class="pt-1 mt-0 pb-0 mb-0" colspan="4">{{ estudiante.nombresestudiante+' '+estudiante.apellidosestudiante }}</td>
                <td class="p-0 m-0" colspan="1"><select class="form-control" v-model="evaluacion[index]" @change="evaluar(index, evaluacion[index])" >
                    <option value="Muy Bueno">Muy Bueno</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Regular">Regular</option>
                    <option value="Insuficiente">Insuficiente</option>
                </select></td>
            </tr>

            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="9">Detalle de Actividades<span class="float-right btn btn-link p-0 m-0"><i class="fa fa-plus" @click="nueva"></i></span></td>
            </tr>
            <tr>
                <td style="width: 5%" class="pt-1 mt-0 pb-0 mb-0 gris" colspan="1">No.</td>
                <td style="width: 10%" class="pt-1 mt-0 pb-0 mb-0 gris" colspan="1">Fecha</td>
                <td style="width: 45%" class="pt-1 mt-0 pb-0 mb-0 gris" colspan="4">Actividad</td>
                <td style="width: 7%" class="pt-1 mt-0 pb-0 mb-0 gris" colspan="1">Horas</td>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="2">Observaciones</td>
            </tr>

            <tr v-for="(item, index) in actividades">
                <td class="pt-1 mt-0 pb-0 mb-0" colspan="1">{{ index+1 }}</td>
                <td class="p-0 m-0" colspan="1"><input class="form-control border-0" type="date" v-model="item.fechaactividad" @blur="insertar(item.idactividad, item.fechaactividad, item.descripcionactividad, item.horasactividad, item.comentarioactividad)"/></td>
                <td class="p-0 m-0" colspan="4"><input class="form-control border-0" type="text" v-model="item.descripcionactividad" @blur="insertar(item.idactividad, item.fechaactividad, item.descripcionactividad, item.horasactividad, item.comentarioactividad)" /></td>
                <td class="p-0 m-0" colspan="1"><input class="form-control border-0" type="text" v-model="item.horasactividad" @blur="insertar(item.idactividad, item.fechaactividad, item.descripcionactividad, item.horasactividad, item.comentarioactividad)" /></td>
                <td class="p-0 m-0" colspan="2"><input class="form-control border-0" type="text" v-model="item.comentarioactividad" @blur="insertar(item.idactividad, item.fechaactividad, item.descripcionactividad, item.horasactividad, item.comentarioactividad)" /></td>
            </tr>
            <tr>
                <td class="pt-1 mt-0 pb-0 mb-0 gris" colspan="6">Total Horas Cumplidas:</td>
                <td class="p-0 m-0" colspan="1"><input type="text" class="form-control border-0" v-model="suma"></td>
                <td class="pt-1 mt-0 pb-0 mb-0" colspan="2"></td>
            </tr>
            <tr><td colspan="9"></td></tr>
            <tr>
                <td colspan="9" class="pt-1 mt-0 pb-0 mb-0 gris">
                    Descripción y reflexiones de los aprendizajes obtenidos durante la vinculación:
                </td>
            </tr>
            <tr>
                <td class="p-0 m-0" colspan="9"><textarea class="form-control border-0"  v-model="reflexiones" cols="" rows="6"></textarea></td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "reporte9-item",
        props: {
            profesor: {
                type: Object
            },
            carrera: {
                type: String
            }
        },
        data:()=>({
            actividades: [],
            estudiantes: [],
            nombre1:'',
            nombre2:'',
            apellido1:'',
            apellido2:'',
            nombrecompleto:'',
            suma:0,
            cedula:'',
            correo:'',
            celular:'',
            inicio:'',
            fin:'',
            proyecto:'',
            actividad:'',
            tipo:'Responsable de Practicas pre Profesionales',
            organizacion:'',
            responsable:'',
            tutor:'',
            evaluacion:[],
            reflexiones:''
        }),
        methods:{
            evaluar:function (i, value) {
                this.evaluacion[i] = value;
            },
            getpracticas: function () {
                axios.get(window.location.origin+'/api/consultar-estudiantes-por-profesor',{
                    params:{'id':this.profesor.idprofesor}
                }).then((response)=>{
                    this.estudiantes=response.data;
                    for(var i=0; i<Object.keys(this.estudiantes).length; i++){
                        this.evaluacion.push('Muy Bueno');
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getactividades: function () {
                axios.get(window.location.origin+'/api/consultar-actividades-por-profesor',{
                    params:{'id':this.profesor.idprofesor}
                }).then((response)=>{
                    this.actividades=response.data;
                    this.suma=0;
                    console.log('hola');
                    for(var i=0; i<Object.keys(this.actividades).length; i++){
                        this.suma += parseInt(this.actividades[i].horasactividad);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            nueva: function () {
                axios.get('/actividades/'+this.profesor.idprofesor+'/create/from'
                ).then((response)=>{
                    console.log(response.data);
                    this.getactividades();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            insertar:function (act, par1, par2, par3, par4) {
                axios.put('/actividades/'+act, {
                    fecha: par1,
                    descripcion: par2,
                    comentario: par4,
                    estado: false,
                    horas: par3
                })
                    .then((response)=> {
                        console.log(response);
                        this.getactividades();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            descargar:function () {
                let formData = {
                    nombrecompleto:this.nombrecompleto,
                    carrera: this.carrera,
                    cedula:this.cedula,
                    correo:this.correo,
                    celular:this.celular,
                    inicio:this.inicio,
                    fin:this.fin,
                    proyecto:this.proyecto,
                    actividad:this.actividad,
                    tipo:this.tipo,
                    organizacion:this.organizacion,
                    responsable:this.responsable,
                    tutor:this.tutor,
                    evaluaciones: this.evaluacion,
                    reflexiones: this.reflexiones
                };
                //formData.append('perfiles', this.perfiles);
                axios({
                    url: '/reportes/'+this.profesor.idprofesor+'/descarga9',
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
            this.getactividades();
            this.nombre1 = this.profesor.nombresprofesor.split(' ')[0];
            this.nombre2 = this.profesor.nombresprofesor.split(' ')[1];
            this.apellido1 = this.profesor.apellidosprofesor.split(' ')[0];
            this.apellido2 = this.profesor.apellidosprofesor.split(' ')[1];
            this.nombrecompleto = this.profesor.nombresprofesor+' '+this.profesor.apellidosprofesor;
            this.cedula = this.profesor.idprofesor;
            this.correo = this.profesor.correoprofesor;
            this.celular = this.profesor.celularprofesor;
        }
    }
</script>

<style scoped>
.gris{
    background-color: #C2C7D0;
}
</style>