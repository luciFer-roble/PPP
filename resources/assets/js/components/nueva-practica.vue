<template>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <form method="post" action="/practicas">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="card-body">
                        <div class="form-group autocomplete">
                            <label class="col-sm-8 control-label">Estudiante:</label>
                            <input type="hidden" v-model="codigo" name="codigo" />
                            <div class="col-lg-8">
                                <input @keyup="autoComplete" type="text" class="form-control" name="estudiante" v-model="estudiante" placeholder="Ingrese el nombre o apellido del Estudiante"/>
                            </div>
                            <div class="panel-footer" v-if="estudiantes.length">
                                <ul class="list-group autocomplete-results">
                                    <li class="list-group-item autocomplete-result" v-for="item in estudiantes" @click="setestudiante(item.idestudiante, item.nombresestudiante, item.apellidosestudiante)">
                                        {{ item.nombresestudiante+' '+item.apellidosestudiante }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label">Empresa:</label>
                            <div class="col-lg-12">
                                <select v-model="empresa" name="empresa" class="form-control" @change="gettutores">
                                    <option value="">-Seleccione-</option>
                                    <option  :key="item.idempresa" v-for="item in empresas" :value="item.idempresa">{{item.nombreempresa}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label text-primary" style="font-weight: normal !important;">Tutor Empresarial:</label>

                            <div class="col-lg-12">
                                <div class="input-group">
                                    <select v-model="tutore" name="tutore" class="form-control">
                                        <option value="">-Seleccione-</option>
                                        <option  :key="item.idtutore" v-for="item in tutores" :value="item.idtutore">{{item.nombretutore+' '+item.apellidotutore}}</option>
                                    </select>
                                    <div class="input-group-append">
                                            <span class="input-group-text btn btn-link">
                                                <i data-toggle="modal" data-target="#modal1" class="fa fa-fw fa-plus"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label">Tutor Academico:</label>
                            <div class="col-lg-12">
                                <select v-model="profesor" name="profesor" class="form-control">
                                    <option value="">-Seleccione-</option>
                                    <option  :key="item.idprofesor" v-for="item in profesores" :value="item.idprofesor">{{item.nombresprofesor+' '+item.apellidosprofesor}}</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label" >Tipo de practica:</label>
                            <div class="col-lg-12">
                                <select v-model="tipo" name="tipo" class="form-control">
                                    <option value="">-Seleccione-</option>
                                    <option value="Practica">Practica Pre-Profesional</option>
                                    <option value="Pasantia">Pasantia</option>
                                    <option value="Ayudantia">Ayudantia</option>
                                    <option value="Proyecto">Proyecto</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label" >Fecha de Inicio:</label>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" v-model="inicio" name="inicio">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label" >Fecha de Finalizaci&oacute;n:</label>
                            <div class="col-lg-12">
                            <input type="date" class="form-control" v-model="fin" name="fin">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label" >Periodo Acad&eacute;mico:</label>
                            <div class="col-lg-12">
                                <select v-model="periodo" name="periodo" class="form-control">
                                    <option value="">-Seleccione-</option>
                                    <option  :key="item.idperiodoacademico" v-for="item in periodos" :value="item.idperiodoacademico">{{item.nombreperiodoacademico}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label" >Sueldo/salario:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" v-model="salario" name="salario" placeholder="$000">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-sm-12 control-label" >Horario:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" v-model="horario" name="horario" placeholder="HH:MM - HH-MM" >

                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="col-sm-12 control-label" >Horas:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" v-model="horas" name="horas" >

                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 control-label">Descripci&oacute;n:</label>
                            <div class="col-lg-8">
                                <textarea  class="form-control" v-model="descripcion" name="descripcion" ></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">Guardar</button>

                    </div>
                </form>

            </div>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="vuemodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Tutor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="formgroup" width="100%">
                                    <label>Empresa:</label>
                                    <select v-model="empresa" name="empresa" class="form-control">
                                        <option value="">-Seleccione-</option>
                                        <option  :key="item.idempresa" v-for="item in empresas" :value="item.idempresa">{{item.nombreempresa}}</option>
                                    </select>
                                </div>
                                <div class="formgroup" width="100%">
                                    <label>Cedula:</label>
                                    <input type="text" class="form-control" v-model="cedula" name="cedula">
                                </div>
                                <div class="formgroup" width="100">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" v-model="nombre" name="nombre">
                                </div>

                                <div class="formgroup">
                                    <label>Apellido:</label>
                                    <input type="text" class="form-control" v-model="apellido" name="apellido">
                                </div>

                                <div class="formgroup">
                                    <label>Celular:</label>
                                    <input type="text" class="form-control" v-model="celular" name="celular">
                                </div>

                                <div class="formgroup">
                                    <label>Correo:</label>
                                    <input type="text" class="form-control" v-model="correo" name="correo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="button" @click="save" class="btn btn-primary">Insertar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "nueva-practica",
        props: {
            /*csrf_token:{
                type: String
            }*/
        },
        data:()=>({
            periodos: [],
            tutores: [],
            empresas: [],
            profesores: [],
            estudiantes: [],
            estudiante: '',
            codigo:'',
            empresa: '',
            tutore: '',
            profesor: '',
            tipo: '',
            inicio: '',
            fin: '',
            periodo: '',
            salario: '',
            horario: '',
            horas: '',
            descripcion: '',
            csrf: "",
            cedula: "",
            nombre: "",
            apellido: "",
            celular: "",
            correo: ""
        }),
        methods:{
            insertar:function () {
                axios.post('/practicas/', {
                    estudiante: this.codigo,
                    empresa: this.empresa,
                    tutore: this.tutore,
                    profesor: this.profesor,
                    tipo: this.tipo,
                    inicio: this.inicio,
                    fin: this.fin,
                    periodo: this.periodo,
                    salario: this.salario,
                    horario: this.horario,
                    horas: this.horas,
                    descripcion: this.descripcion
                })
                    .then(function (response) {
                        window.location.replace = response.data.redirect;
                    })
                    .catch(error => {
                    module.status = error.response.data.status;
                    });

            },
            save: function () {
                axios.post('/tutores/', {
                    cedula: this.cedula,
                    nombre: this.nombre,
                    apellido: this.apellido,
                    celular: this.celular,
                    correo: this.correo,
                    empresa: this.empresa
                })
                    .then(function (response) {
                        console.log('insertado');
                    })
                    .catch(error => {
                        module.status = error.response.data.status;
                    });

                this.gettutores();
                $(this.$refs.vuemodal).modal('hide');
            },
            setestudiante:function(idestudiante, nombresestudiante, apellidosestudiante){
                this.estudiante = nombresestudiante+' '+apellidosestudiante;
                this.codigo = idestudiante;
                this.estudiantes =[];
            },
            getprofesores:function () {
                axios.get(window.location.origin+'/api/getprofesores').then((response)=>{
                    this.profesores=response.data;
                })

            },
            getempresas:function () {
                axios.get(window.location.origin+'/api/getempresas').then((response)=>{
                    this.empresas=response.data;
                })

            },
            getperiodos:function () {
                axios.get(window.location.origin+'/api/getperiodos').then((response)=>{
                    this.periodos=response.data;
                })

            },
            gettutores:function () {
                axios.get(window.location.origin+'/api/gettutores',{
                    params:{'empresa':this.empresa}
                }).then((response)=>{
                    this.tutores=response.data;
                })

            },
            autoComplete(){
                //this.results = [];
                if(this.estudiante.length > 1){
                    axios.get('/api/getestudiantes',{
                        params: {'estudiante': this.estudiante}
                    }).then(response => {
                        this.estudiantes = response.data;
                    });
                }
            }
        },
        /*computed:{
            csrfToken() { window.Laravel.csrfToken; }
        },*/
        created() {
            this.getperiodos();
            this.getempresas();
            this.getprofesores();
            this.csrf = window.Laravel.csrfToken;
        }
    }
</script>

<style scoped>
    .autocomplete {
        position: relative;
    }

    .autocomplete-results {
        padding: 0;
        margin: 0;
        border: 1px solid #eeeeee;
        overflow: auto;
    }

    .autocomplete-result {
        list-style: none;
        text-align: left;
        padding: 4px 2px;
        cursor: pointer;
    }

    .autocomplete-result:hover {
        background-color: #007bff80;
        color: white;
    }
</style>