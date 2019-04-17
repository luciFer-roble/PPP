<template>
    <tr v-bind:class="{ 'fondoverde': check }">
        <td style="width:  12%">
            <input v-bind:class="{ 'fondoverde': check }" class="form-control border-0" type="date" name="fecha" id="fecha"  v-model="fecha" @blur="insertar" :disabled="check || (rol.name === 'tut' || rol.name === 'prof')">
        </td>
        <td class="p-0 m-0">
            <textarea v-bind:class="{ 'fondoverde': check }" class="form-control border-0" name="descripcion" id="descripcion" cols="30"  v-model="descripcion" @blur="insertar" :disabled="check || (rol.name === 'tut' || rol.name === 'prof')"></textarea>
        </td>
        <td style="width:  6%; vertical-align: middle" class="align-items-center" v-if="check && (rol.name === 'tut' || rol.name === 'prof')">
            <span class="btn"><i class="text-success  fas fa-check-circle fa-2x"  @click="ponerfalse"></i></span>
        </td>
        <td style="width:  6%; vertical-align: middle" class="align-items-center" v-if="!check && listo && (rol.name === 'tut' || rol.name === 'prof')">
            <span class="btn"><i class=" text-success far fa-circle fa-2x"  @click="ponertrue" ></i></span>
        </td>
        <td style="width:  6%; vertical-align: middle" class="align-items-center" v-if="!check && !listo && (rol.name === 'tut' || rol.name === 'prof')">
            <!--<input class="form-control" type="checkbox"  v-model="check" :disabled="check" @change="insertar">-->
            <span class="btn"><i class=" text-success far fa-circle fa-2x fa-disabled"  ></i></span>
        </td>
        <td class="p-0 m-0">
            <textarea v-bind:class="{ 'fondoverde': check }" class="form-control border-0" name="comentario" id="comentario" cols="14" v-model="comentario" @blur="insertar" :disabled="check"></textarea>
        </td>

        <!--<td style="width:  6%">
            <input class="form-control" type="text" name="horas" id="horas" v-model="horas" @blur="insertar" :disabled="false">
        </td>-->
    </tr>
</template>

<script>
    export default {

        props: {
            actividad: {
                type: Object
            },
            rol: {
                type: Object
            }
        },
        data:()=>({
            fecha: '',
            descripcion: '',
            comentario: '',
            check: '',
            horas: '',
            desactivar: false,
            listo: false
        }),
        methods:{
            ponertrue:function () {
                this.check = true;
                this.insertar();
            },
            ponerfalse:function () {
                this.check = false;
                this.insertar();
            },
            insertar:function () {
                axios.put('/actividades/'+this.actividad.idactividad, {
                    fecha: this.fecha,
                    descripcion: this.descripcion,
                    comentario: this.comentario,
                    estado: this.check,
                    horas: 6
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        },
        created() {
            console.log(this.actividad.idactividad);
            this.fecha = this.actividad.fechaactividad;
            this.descripcion = this.actividad.descripcionactividad;
            this.comentario = this.actividad.comentarioactividad;
            this.check = this.actividad.estadoactividad;
            this.horas = this.actividad.horasactividad;
            if(this.fecha !== null && this.descripcion !== null){
                this.listo =true;
            }
        }
    }
</script>
<style scoped>
    input[disabled] {
        background-color: white;
    }
    textarea[disabled] {
         background-color: white ;
     }
    textarea{
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }
    .fondoverde{
        background-color: #ccffcc !important;
    }
    .fa-disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>