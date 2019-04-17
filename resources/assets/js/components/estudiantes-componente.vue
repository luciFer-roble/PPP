<template>
    <tr v-bind:class="{ 'fondogris': isactivo==='false' }">
        <td class="p-0 m-0" >{{ estudiante.cedulaestudiante }}</td>
        <td class="p-0 m-0" >{{ estudiante.nombresestudiante }} {{ estudiante.apellidosestudiante }} </td>
        <td class="p-0 m-0">{{ estudiante.tipoestudiante }}</td>
        <td class="p-0 m-0">{{ estudiante.celularestudiante }}</td>
        <td  class="p-0 m-0">{{ estudiante.correoestudiante }}</td>
        <td style="min-width: 100px" class="p-0 m-0">{{ carrera.nombrecarrera }}</td>
        <td class="p-0 m-0" align="center" v-if="estudiante.horasestudiante > 0 && rol.name !== 'tut' && isactivo === 'true'">
            <button title="Ver Practicas" @click="verpracticas(estudiante.idestudiante)"   class="btn btn-link text-success p-0 m-0">{{estudiante.horasestudiante}}</button></td>
        <td class="p-0 m-0" align="center" v-if="estudiante.horasestudiante > 0 && rol.name !== 'tut' && isactivo === 'false'">
            <button title="Inactivo" @click="verpracticas(estudiante.idestudiante)"   class="btn btn-link text-warning p-0 m-0">{{estudiante.horasestudiante}}</button></td>
        <td  class="p-0 m-0" align="center" v-if="estudiante.horasestudiante === null && rol.name !== 'tut'" >
            <span   title="inactivo" class="text-danger p-0 m-0 ">0</span></td>
        <td v-if="rol.name === 'coord' " class="p-0 m-0" align="center">
                    <span   class="btn btn-link p-0 m-0">
                        <i  class="fa fa-fw fa-pencil-alt" @click="edit"></i>
                    </span>        
        </td>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Estudiante
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group" v-if="mostrar">
                            <div class="alert alert-danger" style="opacity: 0.7 !important;">
                                <ul v-for="error in errors">
                                    <li>{{ error[0]  }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="formgroup" width="100">
                                <label>C&eacute;dula:</label>
                                <input type="text" class="form-control" v-model="cedula" name="cedula">
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombres:</label>
                                <input type="text" class="form-control" v-model="nombres" name="nombres">
                            </div>
                            <div class="formgroup">
                                <label>Apellidos:</label>
                                <input type="text" class="form-control" v-model="apellidos" name="apellidos">
                            </div>
                            <div class="formgroup">
                                <label>Fecha de Nacimiento:</label>
                                <input type="text" class="form-control" v-model="fechanacimiento" name="fechanacimiento">
                            </div>
                            <div class="formgroup">
                                <label>Tipo Estudiante:</label>
                                <input type="text" class="form-control" v-model="tipo" name="tipo">
                            </div>
                            <div class="formgroup">
                                <label>Celular:</label>
                                <input type="text" class="form-control" v-model="celular" name="celular">
                            </div>
                            <div class="formgroup">
                                <label>Correo:</label>
                                <input type="text" class="form-control" v-model="correo" name="correo">
                            </div><!--
                            
                            <div class="formgroup">
                                <label>Carrera:</label>
                                <select class="form-control" name="empresa" v-model="carreraselect">
                                    <option v-for="item in carreras" :key="item.idcarrera" :value="item.idcarrera">{{ item.nombrecarrera }}</option>
                                </select>
                            </div>-->
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="update" class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        name: "estudiantes-componente",
        props: {
            estudiante: {
                type: Object
            },

            carrera: {
                type: Object
            },
            rol: {
                type: Object
            },
            isactivo: {
                type: String
            }
        },
        data: function () {
            return {
                nombres: '',
                apellidos: '',
                celular: '',
                correo: '',
                tipo:'',
                fechanacimiento:'',
                genero:'',
                carrera1:'',
                cedula:'',
                /*empresaselect: '',
                empresas: [],*/
                actualizando: false,
                boton1: 'Actualizar',
                boton2: 'Borrar',
                errors: [],
                mostrar: false
            }
        },
        methods:{
            verpracticas:function (id) {
                    window.location.href = '/practicas/'+id+'/list3';
        },
            edit:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                this.cedula=this.estudiante.cedulaestudiante;
                this.nombres =this.estudiante.nombresestudiante;
                this.apellidos = this.estudiante.apellidosestudiante;
                this.celular = this.estudiante.celularestudiante;
                this.correo = this.estudiante.correoestudiante;
                this.tipo = this.estudiante.tipoestudiante;
                this.fechanacimiento = this.estudiante.fechanacimientoestudiante;
                this.carrera1 = this.estudiante.idcarrera;
                this.genero=this.estudiante.generoestudiante;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/estudiantes/'+this.estudiante.idestudiante, {
                    carrera: this.carrera1,
                    cedula: this.cedula,
                    nombres: this.nombres,
                    apellidos: this.apellidos,
                    celular: this.celular,
                    correo: this.correo,
                    tipo: this.tipo,
                    fechanacimiento: this.fechanacimiento,
                    genero: this.genero
                })
                    .then(function (response) {
                        //$(this.$refs.modaledit).modal('hide');
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.actualizando = false;
                        this.boton1 = 'Actualizar';
                        module.status = error.response.data.status;
                        this.errors = error.response.data;
                        this.mostrar = true;
                    });


            },
            borrar:function () {
                this.actualizando = true;
                this.boton2 = 'Borrando';
                axios.delete('/tutores/'+this.tutore.idtutore)
                    .then(function (response) {
                        //$(this.$refs.modaledit).modal('hide');
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        module.status = error.response.data.status;
                    });


            },

        },
        created() {

        }
    }
</script>

<style scoped>

    .fondogris{
        background-color: #EDEFF2 !important;
    }
</style>