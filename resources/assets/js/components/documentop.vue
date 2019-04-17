<template>
    <tr >
        <td class="pb-0 pt-0 m-0" v-model="descripcion">
            {{ descripcion }}
        </td>
        <td class="p-0 m-0" v-if="!mostrar">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" ref="file" name="archivo" @change="guardar">
                    <input type="text" class="conesquinas custom-file-label btn-block" v-model="archivo" placeholder="Seleccione...">
                </div>
                <div class="input-group-append">
                    <span class="conesquinas input-group-text bl" >Cargar</span>
                </div>
            </div>
        </td>
        <td class="p-0 m-0" v-if="mostrar">
            <button class="btn btn-link" @click="descargar" >{{ archivo }}</button>
        </td>
        <td style="width: 4%; vertical-align: middle" class="align-items-center fa-disabled pb-0 mt-0 pt-0 mt-0" v-if="mostrar">
            <!--<input class="form-control custom-checkbox " type="checkbox"   :disabled="mostrar" :checked="mostrar">-->
            <span class="btn"><i class=" text-success fas fa-check fa-disabled"  ></i></span>
        </td>
        <td style="width: 4%; vertical-align: middle" class="align-items-center pb-0 mt-0 pt-0 mt-0" v-if="!mostrar">
            <!--<input class="form-control custom-checkbox " type="checkbox"   :disabled="mostrar" :checked="mostrar">-->
            <span class="btn"><i class=" text-danger fas fa-times fa-disabled"  ></i></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            tipo: {
                type: Object
            },
            practica: {
                type: Object
            },
            documento: String,
            codigo: String
        },

        data:()=>({
            descripcion: '',
            archivo: '',
            mostrar: false,
            file:''
        }),

        methods:{
            descargar:function () {
                axios({
                    url: '/documentos/'+this.codigo+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
                }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.documento); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                    // window.open('/formatos/'+this.formato.idformato+'/descargar/');

                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            guardar:function () {

                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('tipo', this.tipo.idtipodocumento);
                formData.append('practica', this.practica.idpractica);
                formData.append('archivo', this.file);
                formData.append('estudiante', this.practica.idestudiante);

                axios.post('/documentos/', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response)=>{
                        this.archivo=response.data;
                    }).catch(function (error) {
                        console.log(error);
                    });
                this.mostrar = true;
                //this.archivo= this.practica.idestudiante+this.tipo.idtipodocumento+'P'+this.practica.idpractica;
            },
            editar:function () {
                window.location.href = '/formatos/'+this.formato.idformato+'/edit';
            }
        },
        created() {
            this.descripcion = this.tipo.descripciontipodocumento;
            this.archivo=this.documento;
            if(this.documento != ''){
                this.mostrar = true;
            }
        }
    }
</script>


<style scoped>
    .fondoverde{
        background-color: #ccffcc;
    }
    .fa-disabled {
        opacity: 0.8;
        cursor: default;
    }
    .conesquinas{
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }
</style>