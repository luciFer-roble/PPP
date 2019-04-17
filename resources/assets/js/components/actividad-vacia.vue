<template>
    <tr >
        <td>
            <input class="form-control" type="date" name="fecha" id="fecha" v-model="fecha" @blur="actualizar">
        </td>
        <td class="p-0 m-0">
            <textarea class="form-control " name="descripcion" id="descripcion" cols="30" v-model="descripcion"></textarea>
        </td>
        <td>
        </td>
        <td>
            <input class="form-control custom-checkbox " type="checkbox">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
    </tr>
</template>

<script>
    export default {

        props: {
            actividad: {
                type: Object
            }
        },
        data:()=>({
            fecha:'',
            descripcion:''
        }),
        created() {

        }
    }
</script>