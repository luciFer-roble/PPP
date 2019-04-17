<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-outline-success" @click="create" >NUEVO</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Tutor</h5>
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
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>
                            <div class="formgroup">
                                <label>Apellido:</label>
                                <input type="text" class="form-control" v-model="apellido" name="apellido">
                            </div>
                            <div class="formgroup">
                                <label>C&eacute;dula:</label>
                                <input type="text" class="form-control" v-model="cedula" name="cedula">
                            </div>
                            <div class="formgroup">
                                <label>Celular:</label>
                                <input type="text" class="form-control" v-model="celular" name="celular">
                            </div>
                            <div class="formgroup">
                                <label>Correo:</label>
                                <input type="text" class="form-control" v-model="correo" name="correo">
                            </div>

                            <div class="formgroup">
                                <label>Empresa:</label>
                                <select class="form-control" name="empresa" v-model="empresaselect">
                                    <option v-for="item in empresas" :key="item.idempresa" :value="item.idempresa">{{ item.nombreempresa }}</option>
                                </select>
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
        name: "tutores-nuevo",
        props: {
        },
        data: function () {
            return {
                nombre: '',
                apellido: '',
                celular: '',
                correo:'',
                cedula:'',
                empresaselect: '',
                empresas: [],
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
                axios.get(window.location.origin+'/api/getempresas'
                ).then((response)=>{
                    this.empresas=response.data;
                    this.empresaselect=this.empresas[0].idempresa;
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/tutores', {
                    empresa: this.empresaselect,
                    nombre: this.nombre,
                    apellido: this.apellido,
                    cedula: this.cedula,
                    celular: this.celular,
                    correo: this.correo
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