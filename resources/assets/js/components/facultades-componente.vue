<template>
    <tr>
        <td  class="p-0 m-0">{{ facultad.idfacultad }}</td>
        <td  class="p-0 m-0">{{ facultad.nombrefacultad }}</td>
        <td  class="p-0 m-0">{{ facultad.descripcionfacultad }}</td>
        <td  class="p-0 m-0">{{ facultad.misionfacultad }}</td>
        <td  class="p-0 m-0">{{ facultad.visionfacultad }}</td>
        <td  class="p-0 m-0">{{ sede.nombresede }}</td>
        <td  class="p-0 m-0" style="width:7%">

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
                        <h4 class="modal-title center-block">Se eliminara la Facultad {{ facultad.nombrefacultad  }}</h4>
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Facultad</h5>
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
                                <label>Id:</label>
                                <input type="text" class="form-control" v-model="id" name="id" disabled>
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>
                            <div class="formgroup">
                                <label>Descripci&oacute;n:</label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion">
                            </div>
                            <div class="formgroup">
                            <label>Misi&oacute;n:</label>
                            <input type="text" class="form-control" v-model="mision" name="mision">
                        </div>
                            <div class="formgroup">
                                <label>Visi&oacute;n:</label>
                                <input type="text" class="form-control" v-model="vision" name="vision">
                            </div>
                            <div class="formgroup">
                                <label>Sede:</label>
                                <select class="form-control" name="sede" v-model="sedeselect">
                                    <option v-for="item in sedes" :key="item.idsede" :value="item.idsede">{{ item.nombresede }}</option>
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
        name: "facultades-componente",
        props: {
            facultad: {
                type: Object
            },

            sede: {
                type: Object
            }
        },
        data: function () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                mision: '',
                vision: '',
                sedeselect: '',
                sedes: [],
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
                axios.get(window.location.origin+'/api/getsedes'
                ).then((response)=>{
                    this.sedes=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.id = this.facultad.idfacultad;
                this.nombre =this.facultad.nombrefacultad;
                this.descripcion = this.facultad.descripcionfacultad;
                this.mision = this.facultad.misionfacultad;
                this.vision = this.facultad.visionfacultad;
                this.sedeselect = this.facultad.idsede;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/facultades/'+this.facultad.idfacultad, {
                    sede: this.sedeselect,
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    mision: this.mision,
                    vision: this.vision
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
                axios.delete('/facultades/'+this.facultad.idfacultad)
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