<template>
    <tr>
        <td class="p-0 m-0">{{ carrera.nombrecarrera }}</td>
        <td class="m-0 p-0" style="width: 35%;"><button  @click="verprofesor(coordinador.idprofesor)" class="btn btn-link  m-0 p-0" >{{ profesor.nombresprofesor+' '+profesor.apellidosprofesor }}</button></td>
        <td class="p-0 m-0">{{ coordinador.fechainiciocoordinador }}</td>
        <td class="p-0 m-0">{{ coordinador.fechafincoordinador }}</td>

        <td class="p-0 m-0" style="width: 4%" >
            <div class="col" align="center">
                    <span   class="btn text-primary p-0 m-0">
                        <i  class="fa fa-pencil-alt" title="Modificar Coordinador" @click="edit"></i>
                    </span>
            </div>

        </td>


        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" ref="modalprofesor">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">{{profesor.apellidosprofesor+' '+profesor.nombresprofesor }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Escuela:</strong> {{ profesor.nombreescuela }}<br>
                            <strong>Celular:</strong> {{ profesor.celularprofesor }}<br>
                            <strong>Correo Electronico:</strong> {{ profesor.correoprofesor }}<br>
                            <strong>Oficina:</strong> {{ profesor.oficinaprofesor }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Coordinador Atual
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
                            <div class="formgroup">
                                <label>Carrera</label>
                                <input type="text" class="form-control" v-model="carre" name="carrera" disabled />
                            </div>
                            <div class="formgroup">
                                <label>Profesor</label>
                                <input type="text" class="form-control" v-model="nombre" name="profesor" disabled/>
                            </div>
                            <div class="formgroup" width="100">
                                <label>Fecha de Inicio</label>
                                <input type="date" class="form-control" v-model="inicio" name="inicio">
                            </div>
                            <div class="formgroup">
                                <label>Fecha de Fin</label>
                                <input type="date" class="form-control" v-model="fin" name="fin">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="update" class="btn " >{{ boton1 }}</button>
                        <button type="button"  v-bind:class="{ disabled: finalizando, 'btn-danger': finalizando, 'btn-danger' : !finalizando }"  class="btn " @click="finalize" >{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        name: "coordinadores-componente",
        props: {
            carrera: {
                type: Object
            },

            profesor: {
                type: Object
            },
            coordinador: {
                type: Object
            }
        },
        data: function () {
            return {
                cambio:'',
                inicio: '',
                fin: '',
                profesorselect: '',
                profesores: [],
                carreraselect: '',
                carreras: [],
                actualizando: false,
                boton1: 'Actualizar',
                boton2: 'Finalizar',
                boton3:'Guardar',
                errors: [],
                mostrar: false,
                nombre: '',
                carre: '',
                profesor2: Object,
                finalizando: false
            }
        },
        methods:{
            verprofesor:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getprofesor',{
                    params:{'id':id}
                }).then((response)=>{
                    this.profesor2=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalprofesor).modal('show');
            },
            edit:function () {

                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                this.carre = this.carrera.nombrecarrera;
                this.nombre = this.profesor.nombresprofesor+' '+this.profesor.apellidosprofesor;
                this.inicio = this.coordinador.fechainiciocoordinador;
                this.fin = this.coordinador.fechafincoordinador;
                $(this.$refs.modaledit).modal('show');
            },
            finalize:function () {

                this.actualizando = true;
                this.boton2 = 'Finalizando';
                axios.put('/coordinadores/'+this.coordinador.idcoordinador+'/finalize', {
                    profesor: this.profesorselect,
                    carrera:this.carre,
                    inicio: this.inicio,
                    fin: this.fin
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
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/coordinadores/'+this.coordinador.idcoordinador, {
                    profesor: this.profesorselect,
                    carrera:this.carre,
                    inicio: this.inicio,
                    fin: this.fin
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


            }

        },
        created() {

        }
    }
</script>

<style scoped>

</style>