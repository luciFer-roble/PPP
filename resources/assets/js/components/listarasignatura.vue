<template>
 <table class="table table-bordered">
  <thead>
  <tr>
   <td class="pt-0 pb-0">Nivel</td>
   <td class="pt-0 pb-0">Asignatura</td>
   <td class="pt-0 pb-0" colspan="2">Estado</td>
   <!--<td align="center" style="width: 2.2%; vertical-align: middle" class="p-0 m-0"><button class="btn btn-link p-0 m-0" @click="addrow" title="Nueva">
    <i class="text-info fa fa-plus"></i></button>
   </td>-->
  </tr>
  </thead>
  <tbody>
  <tr v-for="item in asignaturas2">
   <td class="p-0 m-0">
    <input type="text" class="form-control border-0" v-model="item.nombrenivel">
   </td>
   <td class="p-0 m-0">
    <input type="text" class="form-control border-0" v-model="item.asignatura.nombreasignatura">
   </td>
   <td style="width: 4%; vertical-align: middle" class="align-items-center fa-disabled pb-0 mt-0 pt-0 mt-0" v-if="item.cursandosino">
    <span class="btn text-secondary" title="Cursando">CU</span>
   </td>
   <td style="width: 4%; vertical-align: middle" class="align-items-center pb-0 mt-0 pt-0 mt-0" v-if="!item.cursandosino">
    <span class="btn text-success" title="aprobada">AP</span>
   </td>
   <td v-if="!item.cursandosino" align="center" style="width: 2.2%; vertical-align: middle" class="p-0 m-0"><button class="btn btn-link p-0 m-0" >
    <i class="text-primary fas fa-square"></i></button>
   </td>
   <td v-if="item.cursandosino" align="center" style="width: 2.2%; vertical-align: middle" class="p-0 m-0"><button class="btn btn-link p-0 m-0" @click="update(false, item.idestudiantexasignatura)" title="Aprobar">
    <i class="text-primary far fa-square"></i></button>
   </td>
  </tr>
  <tr v-for="(row, index) in rows">
   <td class="p-0 m-0">
    <select class="form-control border-0" style="border-radius: 0;" v-model="nivel" @change="cargarasignaturas">
     <option value="0">--nivel--</option>
     <option :key="item.idnivel" v-for="item in niveles" :value="item.idnivel">{{item.nombrenivel}}
     </option>
    </select>
   </td>
   <td class="p-0 m-0">
    <select class="form-control border-0"style="border-radius: 0;" v-model="seleccionado">
     <option value="0">--asignatura--</option>
     <option :key="item.idasignatura" v-for="item in lista2" v-show="verificar(item.idasignatura) === 'true'" :value="item.idasignatura">{{item.nombreasignatura}}
     </option>
    </select>
   </td>
   <td colspan="2" align="center" style="vertical-align: middle" class="p-0 m-0"><button :disabled="seleccionado === '0'" class="form-control btn btn-light" style="border-radius: 0;" @click="save" title="Nueva">
    Guardar</button>
   </td>
  </tr>
  </tbody>
 </table>
</template>
<script>
    export default{
        props:['codigo', 'estudiante', 'asignaturas'],
        name:'fer',
        data:()=>({
            lista2:[],
            seleccionado:'0',
            rows: [{
                title: 'Asignatura',
                description: ''
            }],
            check: false,
            nivel:'0',
            niveles: [],
            asignaturas2: []
        }),
        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/getniveles',{
                    params:{'idcarrera':this.codigo}
                }).then((response)=>{
                    this.niveles=response.data;
                });

                axios.get(window.location.origin+'/api/getasignaturas',{
                    params:{'idestudiante':this.estudiante}
                }).then((response)=>{
                    this.asignaturas2=response.data;
                })

            },
            verificar:function (id) {

                let retorno = 'true';
                for(var i=0; i<Object.keys(this.asignaturas2).length; i++){
                    if(this.asignaturas2[i].idasignatura === id){
                        retorno = 'false';
                        console.log(this.asignaturas2[i].nombreasignatura);
                    }
                }

                return retorno;
            },
            cargarasignaturas:function () {
                axios.get(window.location.origin+'/api/asignaturas-nivel',{
                    params:{'idcarrera':this.codigo,
                    'idnivel':this.nivel}
                }).then((response)=>{
                    this.lista2=response.data;
                    console.log(this.lista2[0].nombreasignatura);
                })
            },
            addrow:function (e) {
                e.preventDefault()
                var elem = document.createElement('tr');
                this.rows.push({
                    title: "Asignatura",
                    description: ""
                });

            },
            save:function (e) {
                e.preventDefault()

                axios.post('/estasignaturas', {
                    estudiante: this.estudiante,
                    asignatura: this.seleccionado
                })
                    .then((response)=>  {
                        console.log(response);
                        this.cargardatos();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            update:function (estado, id) {

                axios.put('/estasignaturas/'+id, {
                    estado: estado,
                })
                    .then((response)=> {
                        console.log(response);
                        this.cargardatos();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        created(){
           this.cargardatos();
        }
    }
</script>