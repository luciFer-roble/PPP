<template>
    <div>

        <div class="col"  >
            <button type="button"  class="btn btn-outline-success" @click="create" >NUEVA</button>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Sede</h5>
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
                                <label>Descripcion:</label>
                                <input type="text" class="form-control" v-model="descripcion" name="descripcion">
                            </div>
                            <div class="formgroup">
                                <label>Universidad:</label>
                                <select class="form-control" name="universidad" v-model="universidadselect">
                                    <option v-for="item in universidades" :key="item.iduniversidad" :value="item.iduniversidad">{{ item.nombreuniversidad }}</option>
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
        name: "sedes-componente",
        props: {
        },
        data: function () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                universidadselect: '',
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
                axios.get(window.location.origin+'/api/getuniversidades'
                ).then((response)=>{
                    this.universidades=response.data;
                    this.universidadselect=this.universidades[0].iduniversidad;
                }).catch(function (error) {
                    console.log(error);
                });
                $(this.$refs.modaledit).modal('show');
            },
            save:function () {
                this.actualizando = true;
                this.boton1 = 'Guardando';
                axios.post('/sedes', {
                    id: this.id,
                    universidad: this.universidadselect,
                    nombre: this.nombre,
                    descripcion: this.descripcion
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