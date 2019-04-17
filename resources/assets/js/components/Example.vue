<template>
    <div id="app">
        <div class="row">
            <div class="panel-heading">Example Component</div>

            <input type="text"  v-model="message">
        </div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                message:'hola putita'
            }
        }
    }
</script>

