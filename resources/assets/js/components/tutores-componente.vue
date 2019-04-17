<template>
    <tr>
        <td class="p-0 m-0">{{ empresa.nombreempresa }}</td>
        <td class="p-0 m-0">{{ tutore.nombretutore }}</td>
        <td class="p-0 m-0">{{ tutore.apellidotutore }}</td>
        <td class="p-0 m-0">{{ tutore.celulartutore }}</td>
        <td class="p-0 m-0">{{ tutore.correotutore }}</td>

        <td class="p-0 m-0" style="width: 7%">

            <div class="row p-0 m-0"  >
                <div class="col"  >
                    <span   class="btn btn-link p-0 m-0">
                        <i  class="fa fa-fw fa-pencil-alt" @click="edit"></i>
                    </span>
                </div>

                <div class="col" >
                    <span   class="btn text-danger p-0 m-0">
                        <i  class="fa fa-fw fa-trash-alt" @click="confirm"></i>
                    </span>
                </div>
            </div>

        </td>


        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaldelete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title center-block">Se eliminara el Tutor {{ tutore.nombretutore }}</h4>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando}" >Cancelar</a>
                        <button type="button"  @click="borrar" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-danger' : !actualizando }" class="btn">{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Tutor
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
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>
                            <div class="formgroup">
                                <label>Apellido:</label>
                                <input type="text" class="form-control" v-model="apellido" name="apellido">
                            </div>
                            <div class="formgroup">
                                <label>Celular:</label>
                                <input type="text" class="form-control" v-model="celular" name="celular">
                            </div>
                            <div class="formgroup">
                                <label>Correo:</label>
                                <input type="text" class="form-control" v-model="correo" name="correo" disabled>
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="update" class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        name: "tutore-componente",
        props: {
            empresa: {
                type: Object
            },

            tutore: {
                type: Object
            }
        },
        data: function () {
            return {
                nombre: '',
                apellido: '',
                celular: '',
                correo: '',
                empresaselect: '',
                empresas: [],
                actualizando: false,
                boton1: 'Actualizar',
                boton2: 'Borrar',
                errors: [],
                mostrar: false
            }
        },
        methods:{
            edit:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                axios.get(window.location.origin+'/api/getempresas'
                ).then((response)=>{
                    this.empresas=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.nombre =this.tutore.nombretutore;
                this.apellido = this.tutore.apellidotutore;
                this.celular = this.tutore.celulartutore;
                this.correo = this.tutore.correotutore;
                this.empresaselect = this.tutore.idempresa;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/tutores/'+this.tutore.idtutore, {
                    empresa: this.empresaselect,
                    nombre: this.nombre,
                    apellido: this.apellido,
                    celular: this.celular,
                    correo: this.correo
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

</style>