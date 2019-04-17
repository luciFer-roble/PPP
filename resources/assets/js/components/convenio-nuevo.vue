<template>





    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-sm btn-outline-success" @click="create" >NUEVO</button>
        </div>
        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe3" aria-hidden="true" ref="modalconvenio">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Anadir Convenio</h5>
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
                                <label>Empresa</label>
                                <select class="form-control" name="empresa"  v-model="empresaselect">
                                    <option v-for="item in empresas" :key="item.idempresa" :value="item.idempresa">{{ item.nombreempresa }}</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sede</label>
                                <select class="form-control" name="sede" v-model="sedeselect">
                                    <option v-for="item in sedes" :key="item.idsede" :value="item.idsede">{{ item.descripcionsede }}</option>
                                </select>
                            </div>
                            <div class="formgroup" width="100">
                                <label >Codigo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="id" name="id" >
                            </div>

                            <div class="formgroup">
                                <label >Descripcion <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion" >
                            </div>
                            <div class="formgroup">
                                <label >Fecha de Inicio</label>
                                <input type="date" class="form-control" v-model="inicio" name="inicio" >
                            </div>
                            <div class="formgroup">
                                <label >Fecha de Finalización</label>
                                <input type="date" class="form-control" v-model="fin" name="fin" >
                            </div>
                            <div class="form-group">
                                <label >Archivo de Formato</label>
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="saveconvenio" class="btn">{{ boton2 }}</button>
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
                boton2: 'Guardar',
                errors: [],
                mostrar: false,
                id: '',
                descripcion: '',
                archivo: '',
                file: '',
                empresaselect: '',
                sedeselect: '',
                empresas: [],
                sedes: [],
                carrerauser: '',
                inicio: '',
                fin: ''
            }
        },
        methods:{

            create:function () {
                axios.get(window.location.origin+'/api/getsedes'
                ).then((response)=>{
                    this.sedes=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                axios.get(window.location.origin+'/api/getempresas'
                ).then((response)=>{
                    this.empresas=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.empresaselect = this.empresas[0].idempresa;
                this.sedeselect = this.sedes[0].idsede;
                $(this.$refs.modalconvenio).modal('show');
            },
            cambiar:function () {
                this.archivo = this.$refs.file.files[0].name;
            },
            saveconvenio:function () {
                this.actualizando = true;
                this.boton2 = 'Guardando';
                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('id', this.id);
                formData.append('descripcion', this.descripcion);
                formData.append('empresa', this.empresaselect);
                formData.append('sede', this.sedeselect);
                formData.append('archivo', this.file);
                formData.append('inicio', this.inicio);
                formData.append('fin', this.fin);
                axios.post('/convenios', formData,
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
                        this.boton2 = 'Guardar';
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