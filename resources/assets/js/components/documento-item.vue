    <template>
    <tr v-show="!borrado">
        <td class="p-0 m-0 pl-1">{{ formato.idtipodocumento }}</td>
        <td v-if="rol.name === 'admin' || rol.name === 'prof'" class="p-0 m-0 pl-1">{{ formato.nombrecarrera }}</td>
        <td class="p-0 m-0 pl-1">{{ descripcionn }}</td>
        <td class="p-0 m-0 pl-0" style="width:7%"><button class="btn btn-link " :title="formato.archivoformato" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
            <span class="text-secondary">{{ formato.archivoformato }}</span>
        </button></td>
        <td class="p-0 m-0" style="width: 7%" v-if="rol.name==='coord' || rol.name==='admin'">
            <div class="row p-0 m-0">
                <div class="col" align="center">
                    <span   class="btn btn-link p-0 m-0">
                        <i  class="fa fa-fw fa-pencil-alt" @click="edit"></i>
                    </span>
                </div>
                <div class="col">
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
                        <h4 class="modal-title center-block">Se eliminara el formato {{ descripcionn  }}</h4>
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
                            <div class="formgroup" width="100">
                                <label >Id:</label>
                                <input type="text" class="form-control" v-model="id" name="id"  readonly>
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
            formato: {
                type: Object
            },
            rol: {
                type: Object
            },
            descripcionn: String
        },
        data:()=>({
            borrado: false,
            excel: false,
            pdf: false,
            doc: false,
            actualizando: false,
            boton1: 'Actualizar',
            boton2: 'Eliminar',
            errors: [],
            mostrar: false,
            id: '',
            descripcion: '',
            archivo: '',
            file: ''
        }),
        methods:{
            cambiar:function () {
              this.archivo = this.$refs.file.files[0].name;
            },
            descargar:function () {
                axios({
                    url: '/formatos/'+this.formato.idformato+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.formato.archivoformato); //or any other extension
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
                this.id = this.formato.idtipodocumento;
                this.descripcion = this.descripcionn;
                this.archivo = this.formato.archivoformato;
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
                formData.append('_method', 'put')
                axios.post('/formatos/'+this.id, formData,
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
                axios.delete('/formatos/'+this.formato.idformato)
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
            if(this.formato.archivoformato.split('.')[1] === 'xlsx'){
                this.excel = true;
                this.pdf = false;
                this.doc = false;
            }
            if(this.formato.archivoformato.split('.')[1] === 'pdf'){
                this.excel = false;
                this.pdf = true;
                this.doc = false;
            }
            if(this.formato.archivoformato.split('.')[1] === 'doc' || this.formato.archivoformato.split('.')[1] === 'docx'){
                this.excel = false;
                this.pdf = false;
                this.doc = true;
            }
        }
    }
</script>

<style scoped>

</style>