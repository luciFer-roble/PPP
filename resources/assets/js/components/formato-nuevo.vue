<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-sm btn-outline-success" @click="create" >NUEVO</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Formato</h5>
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
                                <label>Carrera:</label>
                                <select class="form-control" name="carrera" v-model="carreraselect" :disabled="rol.name==='coord'" >
                                    <option v-for="item in carreras" :key="item.idcarrera" :value="item.idcarrera">{{ item.nombrecarrera }}</option>
                                </select>
                            </div>
                            <div class="formgroup" width="100">
                                <label >Codigo:</label>
                                <input type="text" class="form-control" v-model="id" name="id" >
                            </div>

                            <div class="formgroup">
                                <label >Descripcion:</label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion" >
                            </div>
                            <div class="form-group">
                                <label >Archivo de Formato:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" ref="file" name="archivo" @change="cambiar">
                                        <input type="text" class="custom-file-label btn-block" v-model="archivo">
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text bl" id="">Cargar</span>
                                    </div>
                                </div>
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
        name: "sedes-componente",
        props: {
            rol: {
                type: Object
            }
        },
        data: function () {
            return {
                actualizando: false,
                boton1: 'Guardar',
                errors: [],
                mostrar: false,
                id: '',
                descripcion: '',
                archivo: '',
                file: '',
                carreraselect: '',
                carreras: [],
                carrerauser: ''
            }
        },
        methods:{
            getcarrerauser:function () {
                console.log(this.rol.pivot.user_id);
                axios.get(window.location.origin+'/api/getcarrerauser',{
                        params:{'id':this.rol.pivot.user_id}
                }).then((response)=>{
                    this.carrerauser=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            create:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                axios.get(window.location.origin+'/api/getcarreras'
                ).then((response)=>{
                    this.carreras=response.data;
                    this.carreraselect=this.carreras[0].idcarrera;
                    if(this.rol.name === 'coord'){
                        this.carreraselect = this.carrerauser[0].idcarrera;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },

            cambiar:function () {
                this.archivo = this.$refs.file.files[0].name;
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('id', this.id);
                formData.append('descripcion', this.descripcion);
                formData.append('carrera', this.carreraselect);
                formData.append('archivo', this.file);
                axios.post('/formatos', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
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
            this.getcarrerauser();
        }
    }
</script>

<style scoped>

</style>