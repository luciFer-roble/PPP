<template>
    <!-- DataTable Card-->
    <div>
        <div class="card-header ">
            <div class=" row d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <div class="col-md-2 btn-toolbar mb-2 mb-md-0"  >
                <select  class="form-control" v-model="criterio" @change="cargarselect">
                    <option value="0">-Seleccione-</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="profesor">Tutor Academico</option>
                    <option value="periodo">Periodo Academico</option>
                    <option value="empresa">Empresa</option>
                    <option value="nivel">Nivel</option>
                </select>
                    </div>
                <div class="col-md-3 btn-toolbar mb-2 mb-md-0"  >
                <input class=" form-control" :disabled="isperiodo || isnivel || isempresa" type="search" v-model="parametro" @keyup="cargardatos" placeholder="Buscar..." aria-label="Search">
                </div>
                <div class="col-md-2 btn-toolbar mb-2 mb-md-0"  >
                <select class="form-control float-right" :disabled="criterio === 'estudiante' || criterio === 'profesor'" v-model="parametro2" @change="cargardatos2">
                    <option value="0">-Seleccione-</option>
                    <option v-if="isperiodo" v-for="item in lista2" :value="item.idperiodoacademico">{{ item.facultad.nombrefacultad+' '+item.nombreperiodoacademico}}</option>
                    <option v-if="isempresa" v-for="item in lista2" :value="item.idempresa">{{ item.nombreempresa }}</option>
                    <option v-if="isnivel" v-for="item in lista2" :value="item.idnivel">{{ item.nombrenivel }}</option>
                </select>
                    </div>
                <div class="col-md-1 btn-toolbar  mb-2 mb-md-0"  >
                    <div class="btn-group">
                        <input type="button"  @click="mostrartodo" class="btn btn-light" value="Ver todos">
                    </div>
                </div>

                <div class="col-md-3 btn-toolbar mb-2 mb-md-0"  >
                    </div>
                <div class="col-md-1 btn-toolbar  float-right"  >
                        <div class="btn-group float-right">
                            <input type="button"  @click="nueva" class="btn btn-sm btn-outline-success" value="NUEVA">
                        </div>
                </div>
            </div>


        </div>
        <div class="card-body" id="app">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr v-show="check">
                        <th class="m-0 p-0">No.</th>
                        <th class="m-0 p-0">Estudiante</th>
                        <th class="m-0 p-0">Inicio</th>
                        <th class="m-0 p-0">Fin</th>
                        <th class="m-0 p-0">Tipo de proyecto</th>
                        <th class="m-0 p-0"># Horas</th>
                        <th class="m-0 p-0">Empresa</th>
                        <th class="m-0 p-0">Tipo Empresa</th>
                        <th class="m-0 p-0">Sector</th>
                        <th class="m-0 p-0">Tutor Academico</th>
                        <th class="m-0 p-0">Tutor Empresarial</th>
                        <th></th>
                    </tr>
                    <tr v-show="vacio">
                        No se encontraron coincidencias
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in lista">

                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.idpractica }}</span></td>
                        <td class="m-0 p-0"> <button  @click="verestudiante(item.idestudiante)" class="btn btn-link m-0 p-0 border-0" >{{ item.nombresestudiante+' '+item.apellidosestudiante}}</button></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechainiciopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechafinpractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.horaspractica }}</span></td>
                        <td class="m-0 p-0"><button  @click="verempresa(item.idempresa)" class="btn btn-link  m-0 p-0"  >{{ item.nombreempresa}}</button></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipoempresa}}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.sectorempresa}}</span></td>
                        <td class="m-0 p-0"><button  @click="verprofesor(item.idprofesor)" class="btn btn-link  m-0 p-0" >{{ item.nombresprofesor+' '+item.apellidosprofesor }}</button></td>
                        <td class="m-0 p-0"><button  @click="vertutore(item.idtutore)" class="btn btn-link  m-0 p-0" >{{ item.nombretutore+' '+item.apellidotutore }}</button></td>

                        <td class="m-0 p-0">
                            <div class="row p-0 m-0"  >
                                <div class="col"  >
                                    <span   class="btn text-info p-0 m-0">
                                        <i class="fa fa-external-link-alt"  @click="editar(item.idpractica)" title="Ir a la Practica"></i>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

            <!--MODAL ESTUDIANTE-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modalestudiante">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{estudiante.apellidosestudiante+' '+estudiante.nombresestudiante }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Carrera:</strong> {{ estudiante.nombrecarrera }}<br>
                                <strong>Cedula:</strong> {{ estudiante.cedulaestudiante }}<br>
                                <strong>Celular:</strong> {{ estudiante.celularestudiante }}<br>
                                <strong>Correo Electronico:</strong> {{ estudiante.correoestudiante }}<br>
                                <strong>Fecha de Nacimiento:</strong> {{ estudiante.fechanacimientoestudiante }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL empresa-->
            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" ref="modalempresa">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">{{empresa.nombreempresa }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times; </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Direccion:</strong> {{ empresa.direccionempresa }}<br>
                                <strong>Telefono:</strong> {{ empresa.telefonoempresa }}<br>
                                <strong>Tipo:</strong> {{ empresa.tipoempresa }}<br>
                                <strong>Sector:</strong> {{ empresa.sectorempresa }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL profesor-->
            <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" ref="modalprofesor">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel3">{{profesor.apellidosprofesor+' '+profesor.nombresprofesor }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Escuela:</strong> {{ profesor.nombreescuela }}<br>
                                <strong>Correo:</strong> {{ profesor.correoprofesor }}<br>
                                <strong>Celular:</strong> {{ profesor.celularprofesor }}<br>
                                <strong>Oficina:</strong> {{ profesor.oficinaprofesor }}<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL turore-->
            <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true" ref="modaltutore">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel4">{{tutore.nombretutore +' '+tutore.apellidotutore }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Clos e">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Empresa:</strong> {{ tutore.nombreempresa }}<br>
                                <strong>Correo:</strong> {{ tutore.correotutore }}<br>
                                <strong>Celular:</strong> {{ tutore.celulartutore }}<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "consulta-practicas",
        data:()=>({
            lista:[],
            criterio:'estudiante',
            parametro:'',
            check: false,
            vacio: false,
            lista3:[],
            lista2:[],
            criterio2:'0',
            parametro2:'0',
            isperiodo: false,
            isempresa: false,
            isnivel: false,
            estudiante: Object,
            empresa: Object,
            profesor: Object,
            tutore: Object
        }),
        methods:{
            verestudiante:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getestudiante',{
                    params:{'id':id}
                }).then((response)=>{
                    this.estudiante=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalestudiante).modal('show');
            },
            verempresa:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getempresa',{
                    params:{'id':id}
                }).then((response)=>{
                    this.empresa=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalempresa).modal('show');
            },
            verprofesor:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getprofesor',{
                    params:{'id':id}
                }).then((response)=>{
                    this.profesor=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalprofesor).modal('show');
            },
            vertutore:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/gettutore',{
                    params:{'id':id}
                }).then((response)=>{
                    this.tutore=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modaltutore).modal('show');
            },
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-practicas',{
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

            cargardatos2:function () {
                axios.get(window.location.origin+'/api/consultar2-practicas',{
                    params:{'criterio':this.criterio,
                        'parametro': this.parametro2}
                }).then((response)=>{
                    this.lista=response.data;
                    if(Object.keys(this.lista).length === 0){
                        this.check = false;
                        this.vacio = true;
                    }else{
                        this.check = true;
                        this.vacio = false;
                        this.parametro2
                    }
                }).catch(function (error) {
                    console.log(error);
                });



            },
            mostrartodo:function () {
                axios.get(window.location.origin+'/api/todo-practicas'
                ).then((response)=>{
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
                    this.isnivel = false;
                }
                else {
                    if (this.criterio === 'periodo'){
                        this.isempresa = false;
                        this.isperiodo = true;
                        this.isnivel = false;
                    }
                    else {
                        if (this.criterio === 'nivel'){
                            this.isempresa = false;
                            this.isperiodo = false;
                            this.isnivel = true;
                        }
                        else {
                            this.isempresa = false;
                            this.isperiodo = false;
                            this.isnivel = false;
                        }
                    }
                }
                axios.get(window.location.origin+'/api/listar-select1',{
                    params:{'criterio':this.criterio}
                }).then((response)=>{
                    this.lista2=response.data;
                    if(this.isnivel){
                        this.parametro2 =this.lista2[0].idnivel;
                    }
                    if(this.isperiodo){
                        this.parametro2 =this.lista2[0].idperiodoacademico;
                    }
                    if(this.isempresa){
                        this.parametro2 =this.lista2[0].idempresa;
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            editar:function (id) {
                window.location.href = '/practicas/'+id+'/edit';
            },
            nueva:function () {
                window.location.href = '/practicas/create';
            }
        },
        created() {
            this.mostrartodo();
        }
    }
</script>

<style scoped>

</style>