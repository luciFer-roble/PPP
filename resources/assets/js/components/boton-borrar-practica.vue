<template>
    <td class="p-0  m-0">
        <div class="col p-0 m-0" align="center" >
            <span   class="btn text-danger p-0 m-0">
                <i  class="fa fa-fw fa-trash-alt" @click="confirm" ></i>
            </span>
        </div>
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaldelete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="modal-title center-block">Se eliminara: {{ practica.tipopractica+' en '+practica.tutore.empresa.nombreempresa+
                            ' registrada para el/la Estudiante  '+practica.estudiante.nombresestudiante+' '
                            +practica.estudiante.apellidosestudiante }}</h3>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando}" >Cancelar</a>
                        <button type="button"  @click="borrar" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-danger' : !actualizando }" class="btn">{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </td>
</template>

<script>
    export default {
        name: "boton-borrar-practica",
        props: {
            practica: {
                type: Object
            }
        },
        data: function () {
            return {
                actualizando: false,
                boton2: 'Borrar',
            }
        },
        methods:{
            confirm:function () {
                this.actualizando = false;
                $(this.$refs.modaldelete).modal('show');
            },
            borrar:function () {
                this.actualizando = true;
                this.boton2 = 'Borrando';
                axios.delete('/practicas/'+this.practica.idpractica)
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