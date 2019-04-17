<template>
        <div class="input-group" style="width:70%">
            <div class="custom-file">
                <input type="file" class="custom-file-input" ref="file" name="foto" @change="cambiar">
                <input type="text" class="custom-file-label btn-block" v-model="foto">
            </div>
            <div class="input-group-append">
                <span class="input-group-text bl" id="">Cargar</span>
            </div>
        </div>

</template>

<script>
    export default {
        name: "avatar-nuevo",
        data:()=>({
            foto: ''
        }),
        methods:{
            cambiar:function () {
                this.foto = this.$refs.file.files[0].name;
            },

        },
        created() {
        }
    }
</script>

<style scoped>

</style>