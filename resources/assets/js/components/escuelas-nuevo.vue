<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-outline-success" @click="create" >NUEVA</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Escuela</h5>
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
                                <label>Id <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="id" name="id">
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
                                <label>Misi&oacute;n </label>
                                <input type="text" class="form-control" v-model="mision" name="mision">
                            </div>
                            <div class="formgroup">
                                <label>Visi&oacute;n </label>
                                <input type="text" class="form-control" v-model="vision" name="vision">
                            </div>
                            <div class="formgroup">
                                <label>Facultad </label>
                                <select class="form-control" name="sede" v-model="facultadselect">
                                    <option v-for="item in facultades" :key="item.idfacultad" :value="item.idfacultad">{{ item.nombrefacultad }}</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label >Titulaci&oacute;n <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control"  v-model="titulacion" name="titulacion">
                            </div>
                            <div class="formgroup">
                                <label >Duraci&oacute;n </label>
                                <input type="text" class="form-control" name="duracion" v-model="duracion">
                            </div>
                            <div class="formgroup">
                                <label>Modalidad </label>
                                <input type="text" class="form-control" name="modalidad" v-model="modalidad">
                            </div>
                            <div class="formgroup">
                                <label >Campo <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" name="campo" v-model="campo">
                            </div>
                            <div class="formgroup">
                                <label >T&iacute;tulo <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control"  name="titulo" v-model="titulo">
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
        name: "escuelas-nuevo",
        props: {
        },
        data: function () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                mision: '',
                vision: '',
                titulacion: '',
                duracion: '',
                modalidad: '',
                campo: '',
                titulo: '',
                facultadselect: '',
                facultades: [],
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
                axios.get(window.location.origin+'/api/getfacultades'
                ).then((response)=>{
                    this.facultades=response.data;
                    this.facultadselect=this.facultades[0].idfacultad;
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/escuelas', {
                    id: this.id,
                    facultad: this.facultadselect,
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    mision: this.mision,
                    vision: this.vision,
                    titulacion: this.titulacion,
                    duracion: this.duracion,
                    modalidad: this.modalidad,
                    campo: this.campo,
                    titulo: this.titulo
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