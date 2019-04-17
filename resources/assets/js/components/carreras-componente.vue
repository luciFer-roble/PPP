<template>
    <tr>
        <td class="p-0 m-0">{{ carrera.idcarrera }}</td>
        <td class="p-0 m-0">{{ carrera.nombrecarrera }}</td>
        <td class="p-0 m-0">{{ carrera.descripcioncarrera }}</td>
        <td class="p-0 m-0">{{ escuela.nombreescuela }}</td>
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
                        <h4 class="modal-title center-block">Se Eliminar&aacute; la Carrera {{ carrera.nombrecarrera }}</h4>
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Carrera
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
                                <label>Id</label>
                                <input type="text" class="form-control" v-model="id" name="id" disabled>
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>
                            <div class="formgroup">
                                <label>Descripci&oacute;n <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion">
                            </div>
                            
                            <div class="formgroup">
                                <label>Escuela</label>
                                <select class="form-control" name="escuela" v-model="escuelaselect">
                                    <option v-for="item in escuelas" :key="item.idescuela" :value="item.idescuela">{{ item.nombreescuela }}</option>
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
        name: "carreras-componente",
        props: {
            carrera: {
                type: Object
            },

            escuela: {
                type: Object
            }
        },
        data: function () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                escuelaselect: '',
                escuelas: [],
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
                axios.get(window.location.origin+'/api/getescuelas'
                ).then((response)=>{
                    this.escuelas=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.id = this.carrera.idcarrera;
                this.nombre =this.carrera.nombrecarrera;
                this.descripcion = this.carrera.descripcioncarrera;
                this.escuelaselect = this.carrera.idescuela;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/carreras/'+this.carrera.idcarrera, {
                    escuela: this.escuelaselect,
                    nombre: this.nombre,
                    descripcion: this.descripcion
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
                axios.delete('/carreras/'+this.carrera.idcarrera)
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