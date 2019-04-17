<template>
    <div>
    <table class="table table-bordered p-0 m-0" style="table-layout: fixed">
    <tr style="background-color: white">
        <th  style="width:  14%; background-color:  #007bff ; color: white; text-align: center" class="p-1 m-0">{{ empresa.nombreempresa }}</th>
        <td  style="width:  18%"class="p-1 m-0">{{ empresa.direccionempresa }}</td>
        <td  style="width:  14%"class="p-1 m-0">{{ empresa.tipoempresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.sectorempresa }}</td>
        <td  style="width:  10%" class="p-1 m-0">{{ empresa.telefonoempresa }}</td>
        <td  style="width:  10%; background-color: mintcream"class="p-1 m-0">{{ empresa.responsableempresa }}</td>
        <td align="center" style="width: 2.2%; vertical-align: middle"class="p-0 m-0" v-if="convenio"><button class="btn btn-link p-0 m-0" :title="convenio" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
        </button></td>
        <td align="center" style="width: 2.2%; vertical-align: middle"class="p-0 m-0" v-if="!convenio && (rol.name==='coord')"><button class="btn btn-link p-0 m-0" @click="agregar_convenio" title="AÑADIR CONVENIO" ><i class="fa fa-plus"></i></button></td>
        <td align="center" style="width: 2.2%; vertical-align: middle"class="p-0 m-0" v-if="!convenio && (rol.name==='est' || rol.name==='prof')"><span class="btn text-secondary p-0 m-0" title="SIN CONVENIO" ><i class="fas fa-times"></i></span></td>
        <td align="center" style="width: 2.2%; vertical-align: middle" class="p-0 m-0" v-if="rol.name==='coord' " ><button class="btn btn-link p-0 m-0" @click="edit" title="EDITAR"><i class="text-info fa fa-pencil-alt"></i></button></td>
        <td align="center" style="width: 2.2%; vertical-align: middle" class="p-0 m-0" v-if="rol.name==='coord' "><button class="btn btn-link p-0 m-0" @click="agregartutor" title="AÑADIR TUTOR"><i class=" text-info fas fa-user-plus"></i></button></td>
        <td align="center" style="width: 1%; vertical-align: middle" v-if="!tutores && (rol.name==='coord' || rol.name==='prof')" class="p-0 m-0"><i @click="vertutores" class="fa fa-angle-down p-0 m-0 "></i></td>
        <td align="center" style="width: 1%; vertical-align: middle" v-if="tutores && (rol.name==='coord' || rol.name==='prof')" class="p-0 m-0"><i @click="ocultartutores" class="fa fa-angle-up p-0 m-0 "></i></td>
    </tr>
    <tr>
        <td v-if="llena" v-show="tutores" :colspan="colu" class="p-0 m-0">
            <table class="table table-bordered p-0 m-0">
                <thead>
                <tr style="background-color: #F2F2F2">
                    <td class="pt-0 mt-0 pb-0 mb-0" align="center" style="height: 2px" colspan="4">Tutores</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in lista">
                    <td style="width: 2%" class="p-1 m-0" >{{ (index+1)+'. ' }}</td>
                    <td class="p-1 m-0">{{item.nombretutore+' '+item.apellidotutore}}</td>
                    <td class="p-1 m-0">Tel: {{item.celulartutore}}</td>
                    <td class="p-1 m-0">Email: {{item.correotutore}}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </table>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Empresa</h5>
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
                                <label>Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>

                            <div class="formgroup">
                                <label>Direcci&oacute;n</label>
                                <input type="text" class="form-control" v-model="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label>Tipo</label>
                                <select v-model="tipo" name="tipo" class="form-control">
                                    <option value="Publica">Publica</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Sin fines de lucro">Sin fines de lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sector</label>
                                <select v-model="sector" name="sector" class="form-control">
                                    <option value="Primario">PRIMARIO (Agricultura, Ganadería, Pesca, Minería)</option>
                                    <option value="Secundario">SECUNDARIO (Industria, Construcción)</option>
                                    <option value="Terciario">TERCIARIO (Comercio, Servicios)</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Tel&eacute;fono 1</label>
                                <input type="text" class="form-control" v-model="telefono" name="telefono">
                            </div>
                            <div class="formgroup">
                                <label>Tel&eacute;fono 2 <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" v-model="telefono2" name="telefono2">
                            </div>
                            <div class="formgroup">
                                <label>Responsable <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" v-model="responsable" name="responsable">
                            </div>
                            <div class="formgroup">
                                <label>Tel. Responsable <span class="text-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" v-model="telefono3" name="telefono3">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  @click="update" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }"  class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" ref="modaltutore">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Nuevo Tutor</h5>
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
                            <div class="formgroup" width="100%">
                                <label>Empresa:</label>
                                <input type="text" class="form-control" :value="empresa.nombreempresa" name="empresa" disabled>
                            </div>
                            <div class="formgroup" width="100%">
                                <label>C&eacute;dula:</label>
                                <input type="text" class="form-control" v-model="cedula" name="cedula">
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombretutor" name="nombre">
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
                                <input type="text" class="form-control" v-model="correo" name="correo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  @click="save" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }"  class="btn " >{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe3" aria-hidden="true" ref="modalconvenio">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Añadir Convenio</h5>
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
                                <label>Empresa:</label>
                                <select class="form-control" name="empresa"  v-model="empresaselect"  :disabled="rol.name==='coord'">
                                    <option v-for="item in empresas" :key="item.idempresa" :value="item.idempresa">{{ item.nombreempresa }}</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sede:</label>
                                <select class="form-control" name="sede" v-model="sedeselect"  :disabled="rol.name==='coord'">
                                    <option v-for="item in sedes" :key="item.idsede" :value="item.idsede">{{ item.descripcionsede }}</option>
                                </select>
                            </div>
                            <div class="formgroup" width="100">
                                <label >C&oacute;digo:</label>
                                <input type="text" class="form-control" v-model="codigoconvenio" name="id" >
                            </div>

                            <div class="formgroup">
                                <label >Descripci&oacute;n:</label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion" >
                            </div>
                            <div class="formgroup">
                                <label >Fecha de Inicio:</label>
                                <input type="date" class="form-control" v-model="inicio" name="inicio" >
                            </div>
                            <div class="formgroup">
                                <label >Fecha de Finalizaci&oacute;n:</label>
                                <input type="date" class="form-control" v-model="fin" name="fin" >
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="saveconvenio" class="btn">{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            empresa: {
                type: Object
            },
            convenios: {
                type: Array
            },
            rol: {
                type: Object
            },
            /*tutores: {
                type: Array
            },*/
            hastutores:{
                type:String
            },
            sedeuser: {
                type: Object
            },
        },
        data:()=>({
          lista:[],
          tutores: false,
            llena:false,
            borrado: false,
            convenio: '',
            sede: '',
            codigo: '',
            excel: false,
            pdf: false,
            doc: false,
            actualizando: false,
            errors: [],
            mostrar: false,
            nombre: '',
            direccion: '',
            tipo: '',
            sector: '',
            telefono: '',
            telefono2: '',
            telefono3: '',
            responsable: '',
            boton1: 'Actualizar',
            cedula:'',
            nombretutor: '',
            apellido: '',
            celular: '',
            correo: '',
            boton2: 'Guardar',
            colu: '10',
            codigoconvenio: '',
            descripcion: '',
            inicio: '',
            fin: '',
            archivo: '',
            sedes: [],
            empresas: [],
            sedeselect: '',
            empresaselect:'',
            file: '',
            page: 'empresas'
        }),

        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-tutores-por-empresa',{
                    params:{'idempresa':this.empresa.idempresa}
                }).then((response)=>{
                    this.lista=response.data;
                    if(this.lista.length>0){
                        this.llena=true;
                    }
                    else{
                        this.llena=false;
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            agregar_convenio:function () {
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
                this.empresaselect = this.empresa.idempresa;
                this.sedeselect = this.sedeuser.idsede;
                $(this.$refs.modalconvenio).modal('show');
            },
            cambiar:function () {
                this.archivo = this.$refs.file.files[0].name;
            },
            descargar:function () {
                axios({
                    url: '/convenios/'+this.codigo+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.convenio); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                       // window.open('/formatos/'+this.formato.idformato+'/descargar/');

            })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            vertutores:function() {
                this.tutores = true;
            },
            ocultartutores:function() {
                this.tutores = false;
            },
            edit:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                this.nombre =this.empresa.nombreempresa;
                this.direccion = this.empresa.direccionempresa;
                this.tipo = this.empresa.tipoempresa;
                this.sector = this.empresa.sectorempresa;
                this.telefono = this.empresa.telefonoempresa;
                this.telefono2 = this.empresa.telefono2empresa;
                this.telefono3 = this.empresa.telresponsableempresa ;
                this.responsable = this.empresa.responsableempresa;
                $(this.$refs.modaledit).modal('show');
            },
            agregartutor:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                $(this.$refs.modaltutore).modal('show');
            },

            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/empresas/'+this.empresa.idempresa, {
                    nombre: this.nombre,
                    direccion: this.direccion,
                    tipo: this.tipo,
                    sector: this.sector,
                    telefono: this.telefono,
                    telefono2: this.telefono2,
                    responsable: this.responsable,
                    telefono3: this.telefono3
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
            save: function () {
                this.actualizando = true;
                this.boton2 = 'Guardando';
                axios.post('/tutores/', {
                    cedula: this.cedula,
                    nombre: this.nombretutor,
                    apellido: this.apellido,
                    celular: this.celular,
                    correo: this.correo,
                    empresa: this.empresa.idempresa,
                    page: this.page
                })
                    .then(function (response) {
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.actualizando = false;
                        this.boton2 = 'Guardar';
                        module.status = error.response.data.status;
                        this.errors = error.response.data;
                        this.mostrar = true;
                    });

                this.gettutores();
                $(this.$refs.vuemodal).modal('hide');
            },

            saveconvenio:function () {
                this.actualizando = true;
                this.boton2 = 'Guardando';
                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('id', this.codigoconvenio);
                formData.append('descripcion', this.descripcion);
                formData.append('empresa', this.empresaselect);
                formData.append('sede', this.sedeselect);
                formData.append('archivo', this.file);
                formData.append('inicio', this.inicio);
                formData.append('fin', this.fin);
                formData.append('page', this.page);
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
            this.cargardatos();
        },
        mounted(){
            for (let i = 0; i< Object.keys(this.convenios).length; i++){
               if (this.convenios[i].idempresa == this.empresa.idempresa){
                   this.convenio = this.convenios[i].archivoconvenio;
                   this.sede = this.convenios[i].sede.nombresede;
                   this.codigo = this.convenios[i].idconvenio;
                   console.log(this.convenios[i].sede.nombresede);
                   console.log(this.convenios[i].archivoconvenio);
                   console.log(this.convenios[i].idconvenio);

                   if(this.convenio.split('.')[1] === 'xlsx' || this.convenio.split('.')[1] === 'XLSX'){
                       this.excel = true;
                       this.pdf = false;
                       this.doc = false;
                   }
                   if(this.convenio.split('.')[1] === 'pdf' || this.convenio.split('.')[1] === 'PDF' ){
                       this.excel = false;
                       this.pdf = true;
                       this.doc = false;
                   }
                   if(this.convenio.split('.')[1] === 'doc' || this.convenio.split('.')[1] === 'docx'){
                       this.excel = false;
                       this.pdf = false;
                       this.doc = true;
                   }
               }
            }
            if(this.rol.name ==='prof'){
                this.colu = '8'
            }
        }
    }
</script>

<style scoped>

</style>