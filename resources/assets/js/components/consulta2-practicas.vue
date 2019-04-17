<template>
    <!-- DataTable Card-->
    <div class="card mb-3">
        <div class="card-header ">
            <div class="form-inline mr-2">
                <select  class="form-control" v-model="criterio2" @change="cargarselect">
                    <option value="0">-Seleccione-</option>
                    <option value="periodo">Periodo Academico</option>
                    <option value="empresa">Empresa</option>
                    <option value="nivel">Nivel</option>
                </select>
                <select class="form-control" v-model="parametro2" @change="cargardatos2">
                    <option value="0">-Seleccione-</option>
                    <option v-if="isperiodo" v-for="item in lista2" :value="item.idperiodoacademico">{{ item.facultad.nombrefacultad+' '+item.nombreperiodoacademico}}</option>
                    <option v-if="isempresa" v-for="item in lista2" :value="item.idempresa">{{ item.nombreempresa }}</option>
                </select>
            </div>
        </div>
        <div class="card-body" id="app">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr v-show="check">
                        <th>Codigo</th>
                        <th>Estudiante</th>
                        <th>Empresa</th>
                        <th>Tutor Academico</th>
                        <th>Tutor Empresarial</th>
                        <th>Tipo</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>En curso</th>
                    </tr>
                    <tr v-show="vacio">
                        No se encontraron coincidencias
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in lista">

                        <td>{{ item.idpractica }}</td>
                        <td> <a  class="btn btn-link" :href="'/estudiantes/' + item.idestudiante" >{{ item.nombre1estudiante+' '+item.apellido1estudiante}}</a></td>
                        <td><a  class="btn btn-link" :href="'/empresas/' + item.idempresa" >{{ item.nombreempresa}}</a></td>
                        <td><a  class="btn btn-link" :href="'/profesores/' + item.idprofesor" >{{ item.nombre1profesor+' '+item.apellido1profesor }}</a></td>
                        <td><a  class="btn btn-link" :href="'/tutores/' + item.idtutore" >{{ item.nombretutore+' '+item.apellidotutore }}</a></td>
                        <td>{{ item.tipopractica }}</td>
                        <td>{{ item.fechainiciopractica }}</td>
                        <td>{{ item.fechafinpractica }}</td>
                        <td>{{ item.activapractica }}</td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</template>

<script>
    export default {
        name: "consulta2-practicas",
        data:()=>({
            lista:[],
            lista2:[],
            criterio:'0',
            parametro:'0',
            isperiodo: false,
            isempresa: false,
            check: false,
            vacio: false
        }),
        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar2-practicas',{
                    params:{'criterio':this.criterio,
                        'parametro': this.parametro}
                }).then((response)=>{
                    this.lista=response.data;
                    if(Object.keys(this.lista).length === 0){
                        this.check = false;
                        this.vacio = true;
                    }else{
                        this.check = true;
                        this.vacio = false;
                    }
                }).catch(function (error) {
                    console.log(error);
                });



            },

            cargarselect:function () {
                console.log(this.criterio);
                if(this.criterio === 'empresa'){
                    this.isempresa = true;
                    this.isperiodo = false;
                }
                else {
                    this.isempresa = false;
                    this.isperiodo = true;
                }
                axios.get(window.location.origin+'/api/listar-select1',{
                    params:{'criterio':this.criterio}
                }).then((response)=>{
                    this.lista2=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

            }
        }
    }
</script>

<style scoped>

</style>