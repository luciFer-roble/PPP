<template>
    <tr>

        <td class="p-0 m-0">{{ empresa.nombreempresa }}</td>
        <td class="p-0 m-0">{{ empresa.direccionempresa }}</td>
        <td class="p-0 m-0" style="width: 20%">{{ empresa.tipoempresa }}</td>
        <td class="p-0 m-0">{{ empresa.sectorempresa }}</td>
        <td  style="width:  10%" class="p-1 m-0">{{ empresa.telefonoempresa }}</td>
        <td  style="width:  10%" class="p-1 m-0">{{ empresa.telefono2empresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.responsableempresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.telresponsableempresa  }}</td>
        <td class="p-0 m-0" style="width: 7%">

            <div class="row p-0 m-0"  >
                <div class="col p-0 m-0" align="center" >
                    <span   class="btn btn-link p-0 m-0">
                        <i  class="fa fa-fw fa-pencil-alt" @click="edit"></i>
                    </span>
                </div>

                <div class="col p-0 m-0" align="center" >
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
                        <h4 class="modal-title center-block">Se Eliminar&aacute; la Empresa {{ empresa.nombreempresa }}</h4>
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Empresa
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
                                <label>Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>
                            <div class="formgroup" width="100">
                                <label>Direcci&oacute;n</label>
                                <input type="text" class="form-control" v-model="direccion" name="direccion">
                            </div>
                            <div class="formgroup">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo" v-model="tipo">
                                    <option value="Publica">Publica</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Sin fines de lucro">Sin fines de lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sector</label>
                                <select class="form-control" name="sector" v-model="sector">
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
                        <button type="button"  v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }" @click="update" class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        name: "empresas-componente",
        props: {
            empresa: {
                type: Object
            }
        },
        data: function () {
            return {
                nombre: '',
                direccion: '',
                tipo: '',
                sector: '',
                telefono: '',
                telefono2: '',
                telefono3: '',
                responsable: '',
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
                this.nombre =this.empresa.nombreempresa;
                this.direccion = this.empresa.direccionempresa;
                this.tipo = this.empresa.tipoempresa;
                this.sector = this.empresa.sectorempresa;
                this.telefono = this.empresa.telefonoempresa;
                this.telefono2 = this.empresa.telefono2empresa;
                this.telefono3 = this.empresa.telresponsableempresa;
                this.responsable = this.empresa.responsableempresa;
                $(this.$refs.modaledit).modal('show');
            },
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
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
                    telefono3: this.telefono3,
                    responsable: this.responsable
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
                axios.delete('/empresas/'+this.empresa.idempresa)
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