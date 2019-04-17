<template>
    <div>

            <input type="button"  class="btn btn-sm btn-outline-success" @click="create" value="NUEVA">
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Empresa</h5>
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
                                <label>Nombre</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>

                            <div class="formgroup">
                                <label>Direcci&oacute;n </label>
                                <input type="text" class="form-control" v-model="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label>Tipo </label>
                                <select v-model="tipo" name="tipo" class="form-control">
                                    <option value="Publica">Publica</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Sin fines de lucro">Sin fines de lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sector </label>
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
                universidades: [],
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
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/empresas', {
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