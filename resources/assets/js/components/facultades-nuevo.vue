<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-outline-success" @click="create" >NUEVA</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Facultad</h5>
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
                                <input type="text" class="form-control" v-model="id" name="id">
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="save" class="btn">{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "facultades-nuevo",
        props: {
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
                axios.get(window.location.origin+'/api/getsedes'
                ).then((response)=>{
                    this.sedes=response.data;
                    this.sedeselect=this.sedes[0].idsede;
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/facultades', {
                    id: this.id,
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