<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-outline-success" @click="create" >NUEVO</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Coordinador</h5>
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
                                <select class="form-control" name="profesor" v-model="carreraselect">
                                    <option v-for="item in carreras" :key="item.idcarrera" :value="item.idcarrera"> {{ item.nombrecarrera }}</option>
                                </select>
                            </div>
                            <div class="formgroup">
                            <label>Profesor</label>
                            <select class="form-control" name="profesor" v-model="profesorselect">
                                <option v-for="item in profesores" :key="item.idprofesor" :value="item.idprofesor">{{ item.nombresprofesor }} {{ item.apellidosprofesor }}</option>
                            </select>
                        </div>
                            <div class="formgroup" width="100">
                                <label>Fecha de Inicio</label>
                                <input type="date" class="form-control" v-model="inicio" name="inicio">
                            </div>
                            <div class="formgroup">
                                <label>Fecha de Fin <span class="text-secondary">(Opcional)</span></label>
                                <input type="date" class="form-control" v-model="fin" name="fin">
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="save" class="btn">{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "carrera-nuevo",
        props: {
        },
        data: function () {
            return {
                inicio: '',
                fin: '',
                carreraselect: '',
                carreras: [],
                profesorselect: '',
                profesores: [],
                actualizando: false,
                boton1: 'Guardar',
                errors: [],
                mostrar: false
            }
        },
        methods:{
            create:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                axios.get(window.location.origin+'/api/getcarrerassincoordinador'
                ).then((response)=>{
                    this.carreras=response.data;
                    this.carreraselect=this.carreras[0].idcarrera;
                }).catch(function (error) {
                    console.log(error);
                });
                axios.get(window.location.origin+'/api/getprofesoresnocoordinadores'
                ).then((response)=>{
                    this.profesores=response.data;
                    this.profesorselect=this.profesores[0].idprofesor;
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/coordinadores', {
                    carrera: this.carreraselect,
                    profesor: this.profesorselect,
                    inicio: this.inicio,
                    fin: this.fin
                })
                    .then(function (response) {
                        //$(this.$refs.modaledit).modal('hide');
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.actualizando = false;
                        this.boton1 = 'Guardar';
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