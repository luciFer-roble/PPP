<template>
    <tr>
        <td class="p-0 m-0" style="width: 7%">{{ profesor.idprofesor }}</td>
        <td class="p-0 m-0">{{ profesor.cedulaprofesor }}</td>
        <td class="p-0 m-0">{{ profesor.nombresprofesor }}</td>
        <td class="p-0 m-0">{{ profesor.apellidosprofesor }}</td>
        <td class="p-0 m-0">{{ profesor.correoprofesor }}</td>
        <td class="p-0 m-0">{{ profesor.celularprofesor }}</td>
        <td class="p-0 m-0" style="width: 7%">{{ profesor.oficinaprofesor }}</td>
        <td class="p-0 m-0">{{ escuela.nombreescuela }}</td>
        <td class="p-0 m-0" style="width: 7%">

            <div class="row p-0 m-0">
                <div class="col">
                    <span class="btn btn-link p-0 m-0">
                        <i class="fa fa-fw fa-pencil-alt" @click="edit"></i>
                    </span>
                </div>

                <div class="col">
                    <span class="btn text-danger p-0 m-0">
                        <i class="fa fa-fw fa-trash-alt" @click="confirm"></i>
                    </span>
                </div>
            </div>

        </td>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true" ref="modaldelete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title center-block">Se eliminar&aacute; el profesor {{ profesor.nombresprofesor }}</h4>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal"
                           v-bind:class="{ disabled: actualizando}">Cancelar</a>
                        <button type="button" @click="borrar"
                                v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-danger' : !actualizando }"
                                class="btn">{{ boton2 }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Profesor
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group" v-if="mostrar">
                            <div class="alert alert-danger" style="opacity: 0.7 !important;">
                                <ul v-for="error in errors">
                                    <li>{{ error[0] }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="formgroup" width="100">
                                <label>C&oacute;digo</label>
                                <input type="text" class="form-control" v-model="id" name="id">
                            </div>
                            <div class="formgroup" width="100">
                                <label>Cedula</label>
                                <input type="text" class="form-control" v-model="cedula" name="cedula">
                            </div>
                            <div class="formgroup">
                                <label>Escuela</label>
                                <select class="form-control" name="escuela" v-model="escuelaselect">
                                    <option v-for="item in escuelas" :key="item.idescuela" :value="item.idescuela">{{ item.nombreescuela }}</option>
                                </select>
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombres</label>
                                <input type="text" class="form-control" v-model="nombres" name="nombres">
                            </div>
                            <div class="formgroup">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" v-model="apellidos" name="apellidos">
                            </div>
                            <div class="formgroup">
                                <label>Oficina</label>
                                <input type="text" class="form-control" v-model="oficina" name="oficina">
                            </div>
                            <div class="formgroup">
                                <label>Celular</label>
                                <input type="text" class="form-control" v-model="celular" name="celular">
                            </div>
                            <div class="formgroup">
                                <label >Correo Electr&oacute;nico</label>
                                <input type="text" class="form-control"  v-model="correo" name="correo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal"
                           v-bind:class="{ disabled: actualizando }">Cancelar</a>
                        <button type="button"
                                v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }"
                                @click="update" class="btn ">{{ boton1 }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </tr>

</template>

<script>
    export default {
        name: "profesores-componente",
        props: {
            escuela: {
                type: Object
            },

            profesor: {
                type: Object
            }
        },
        data: function () {
            return {
                id: '',
                nombres: '',
                apellidos: '',
                cedula: '',
                correo: '',
                celular: '',
                oficina: '',
                escuelaselect: '',
                escuelas: [],
                actualizando: false,
                boton1: 'Actualizar',
                boton2: 'Borrar',
                errors: [],
                mostrar: false
            }
        },
        methods: {
            edit: function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                axios.get(window.location.origin + '/api/getescuelas'
                ).then((response) => {
                    this.escuelas = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.id = this.profesor.idprofesor;
                this.nombres = this.profesor.nombresprofesor;
                this.apellidos = this.profesor.apellidosprofesor;
                this.cedula = this.profesor.cedulaprofesor;
                this.celular = this.profesor.celularprofesor;
                this.correo = this.profesor.correoprofesor;
                this.oficina = this.profesor.oficinaprofesor;
                this.escuelaselect = this.profesor.idescuela;
                $(this.$refs.modaledit).modal('show');
            },
            confirm: function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            update: function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/profesores/' + this.profesor.idprofesor, {
                    escuela: this.escuelaselect,
                    id:this.id,
                    nombres: this.nombres,
                    apellidos: this.apellidos,
                    correo: this.correo,
                    celular: this.celular,
                    oficina: this.oficina,
                    cedula: this.cedula
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
            borrar: function () {
                this.actualizando = true;
                this.boton2 = 'Borrando';
                axios.delete('/profesores/' + this.profesor.idprofesor)
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