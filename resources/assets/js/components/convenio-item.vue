<template>
    <tr v-show="!borrado" class="pt-0 pb-0 mt-0 mb-0">
        <td class="pt-0 pb-0 mt-0 mb-0">{{ convenio.idconvenio }}</td>
        <td class="pt-0 pb-0 mt-0 mb-0">{{ sede }}</td>
        <td class="pt-0 pb-0 mt-0 mb-0">{{ empresa }}</td>
        <td class="pt-0 pb-0 mt-0 mb-0">{{ convenio.descripcionconvenio }}</td>
        <td class="pt-0 pb-0 mt-0 mb-0">{{ convenio.fechainicioconvenio }}</td>
        <td class="pt-0 pb-0 mt-0 mb-0">{{ convenio.fechafinconvenio}}</td>
        <td class="p-0 m-0"><button class="btn btn-link " :title="convenio.archivoconvenio" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
            <span class="text-secondary">{{ convenio.archivoconvenio }}</span>
        </button></td>
        <td class="p-0 m-0">
            <div class="row">
                <div class="col-sm1">
                    <button  type="button" class="btn btn-link" @click="edit">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </div>
            </div>

        </td>
        <td class="p-0 m-0">
            <div class="row">
                <div class="col-sm1">
                    <button type="submit" class="btn btn-link" @click="confirm">
                        <i class="text-danger fa fa-fw fa-trash-alt" ></i>
                    </button>
                </div>
            </div>

        </td>
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaldelete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title center-block">Se eliminara el convenio {{ convenio.descripcionconvenio  }}</h4>
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Formato</h5>
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
                                <select class="form-control" name="empresa"  v-model="empresaselect" >
                                    <option v-for="item in empresas" :key="item.idempresa" :value="item.idempresa">{{ item.nombreempresa }}</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sede</label>
                                <select class="form-control" name="sede" v-model="sedeselect" >
                                    <option v-for="item in sedes" :key="item.idsede" :value="item.idsede">{{ item.descripcionsede }}</option>
                                </select>
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
                                <label >Archivo del Formato</label>
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="update" class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        props: {
            convenio: {
                type: Object
            },
            sede: String,
            empresa: String
        },
        data:()=>({
            borrado: false,
            id:'',
            descripcion: '',
            inicio: '',
            fin: '',
            empresaselect:'',
            sedeselect: '',
            file: '',
            archivo: '',
            excel: false,
            pdf: false,
            doc: false,
            actualizando: false,
            boton1: 'Actualizar',
            boton2: 'Eliminar',
            errors: [],
            mostrar: false,
            empresas: [],
            sedes:[]
        }),
        methods:{
            cambiar:function () {
                this.archivo = this.$refs.file.files[0].name;
            },
            descargar:function () {
                axios({
                    url: '/convenios/'+this.convenio.idconvenio+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.convenio.archivoconvenio); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                       // window.open('/formatos/'+this.formato.idformato+'/descargar/');

            })
                    .catch(function (error) {
                        console.log(error);
                    });

            },

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
                axios.get(window.location.origin+'/api/getempresas'
                ).then((response)=>{
                    this.empresas=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                this.id = this.convenio.idconvenio;
                this.descripcion = this.convenio.descripcionconvenio;
                this.archivo = this.convenio.archivoconvenio;
                this.empresaselect = this.convenio.idempresa;
                this.sedeselect = this.convenio.idsede;
                this.inicio = this.convenio.fechainicioconvenio;
                this.fin = this.convenio.fechafinconvenio;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('id', this.id);
                formData.append('descripcion', this.descripcion);
                formData.append('archivo', this.file);
                formData.append('inicio', this.inicio);
                formData.append('fin', this.fin);
                formData.append('empresa', this.empresaselect);
                formData.append('sede', this.sedeselect);
                formData.append('_method', 'put');
                axios.post('/convenios/'+this.id, formData,
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
                        this.boton1 = 'Actualizar';
                        module.status = error.response.data.status;
                        this.errors = error.response.data;
                        this.mostrar = true;
                    });


            },
            borrar:function () {
                this.actualizando = true;
                this.boton2 = 'Borrando';
                axios.delete('/sedes/'+this.sede.idsede)
                    .then(function (response) {
                        //$(this.$refs.modaledit).modal('hide');
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        module.status = error.response.data.status;
                    });


            },
        },

        mounted(){
            if(this.convenio.archivoconvenio.split('.')[1] === 'xlsx' || this.convenio.archivoconvenio.split('.')[1] === 'XLSX'){
                this.excel = true;
                this.pdf = false;
                this.doc = false;
            }
            if(this.convenio.archivoconvenio.split('.')[1] === 'pdf' || this.convenio.archivoconvenio.split('.')[1] === 'PDF'){
                this.excel = false;
                this.pdf = true;
                this.doc = false;
            }
            if(this.convenio.archivoconvenio.split('.')[1] === 'doc' || this.convenio.archivoconvenio.split('.')[1] === 'docx'){
                this.excel = false;
                this.pdf = false;
                this.doc = true;
            }
        }
    }
</script>

<style scoped>

</style>