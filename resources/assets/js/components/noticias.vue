<template>
    <div>
        <div class="container">
            <div class="form-group m-form__group">
                <textarea class="form-control m-input m-input--solid" rows="3" maxlength="500" placeholder="Escriba" v-model="comentario"></textarea>
                <div class="d-flex">
                    <div class="p-2" style="width:80%">
                        <div id="mis-fotos">
                            <img :src="parsearArchivo(item.file)" :data-src="parsearArchivo(item.file)" class="img-item" v-for="(item,index) in subidas" v-show="index<19"/>
                        </div>
                    </div>
                    <div class="ml-auto p-2">
                        <vue-dropzone  id="fotos" :options="dropzoneOptions" v-on:vdropzone-error="errores" v-on:vdropzone-success="cargarArchivos" v-on:sending="cargarArchivos" ref="fotos" class="btn btn-secondary m-btn m-btn--icon"/>
                        <button type="reset" class="btn btn-success btn-sm m-btn 	m-btn m-btn--icon" v-on:click="enviar(null)">
                            <span>Enviar<span class="la la-send"></span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-timeline-1 m-timeline-1--fixed">
            <div class="m-timeline-1__items">
                <div class="m-timeline-1__marker"></div>
                <div class="m-timeline-1__item" v-for="(item, index) in noticias" v-bind:class="index % 2===0?'m-timeline-1__item--left': 'm-timeline-1__item--right'">
                    <div class="m-timeline-1__item-circle">
                        <div class="m--bg-danger"></div>
                    </div>
                    <div class="m-timeline-1__item-arrow"></div>
                    <span class="m-timeline-1__item-time m--font-brand">{{item.fecha}}</span>
                    <div class="m-timeline-1__item-content">
                        <template v-if="item.code">
                                <div class="m-timeline-1__item-body">
                                    <div class="m-widget3">
                                        <div class="m-widget3__item">
                                            <div class="m-widget3__header">
                                                <div class="m-widget3__user-img">
                                                    <img class="m-widget3__img" :src="item.avatar"/>
                                                </div>
                                                <div class="m-widget3__info">
                                                    <span class="m-widget3__username">{{item.usuario}}</span><br>
                                                    <b class="m-widget3__time">{{item.org}}</b>
                                                    <span class="m-widget3__status m--font-info">
                                                        <span class="fa" v-bind:class="item.meLike ? 'fa-heart' : 'fa fa-heart-o'" v-on:click="enviarLike(item)" data-skin="dark" data-toggle="m-tooltip" title="Me gusta" data-html="true" :data-content="'<b>'+item.likes+'</b>'"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="m-widget3__body">
                                                <p class="m-widget3__text">
                                                    {{item.comentario}}
                                                </p>
                                                <div :id="item.code">
                                                    <img :src="imagen.down" :data-src="imagen.down" class="img-item" v-for="(imagen,index) in item.fotos" v-show="index<3" v-on:mouseover="renderizarId(item.code)"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </template>
                        <template v-else>
                            <div class="m-timeline-1__item-title">
                                {{item.proyecto.titulo_pr}}<br>
                                <b>{{item.proyecto.org.ncomercial_or || item.proyecto.org.rsocial_or}}</b>
                            </div>
                            <div class="m-timeline-1__item-body">{{item.proyecto.objgeneral_pr}}</div>
                            <div class="m-timeline-1__item-actions">
                                <button class="btn btn-sm btn-outline-brand m-btn m-btn--pill m-btn--custom" v-on:click="cargarProyecto(item.p)">
                                    Leer más..
                                </button>
                            </div>
                        </template>
                        <div class="m-timeline-1__item-actions">
                            <template v-if="item.hijos">
                                <div v-if="item.mostrando">
                                    <div class="m-widget3">
                                        <div class="m-widget3__item" v-for="itemChill in item.listaHijos">
                                            <div class="m-widget3__header">
                                                <div class="m-widget3__user-img">
                                                    <img class="m-widget3__img" :src="itemChill.avatar"/>
                                                </div>
                                                <div class="m-widget3__info">
                                                    <div class="d-flex">
                                                        <div class="p-2">
                                                            <span class="m-widget3__username">{{itemChill.usuario}}</span><br>
                                                            <b class="m-widget3__time">{{itemChill.org}}</b>
                                                        </div>
                                                        <div class="ml-auto p-2"><small class="text-muted">{{itemChill.fecha}}</small></div>
                                                        <span class="m-widget3__status m--font-info">
                                                            <span class="fa" data-toggle="m-tooltip" title="Me gusta" data-html="true" :data-content="'<b>'+itemChill.likes+'</b>'" v-bind:class="itemChill.meLike ? 'fa-heart' : 'fa fa-heart-o'" v-on:click="enviarLike(itemChill)"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-widget3__body">
                                                <p class="m-widget3__text">
                                                    {{itemChill.comentario}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a type="button" class="m-nav__link btn-sm" v-else v-on:click="mostrarComentarios(item)">{{item.hijos}} Comentarios </a>
                            </template>
                            <div class="input-group m-input-group m-input-group--pill">
                                <input class="form-control m-input form-control-sm" placeholder="Escribe un comentario. . ." type="text" v-model="item.texto" v-on:keyup.13="enviarHijo(item)" maxlength="500"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
                    <i class="la la-arrow-up"></i>
                </div>
            </div>
            <infinite-loading @infinite="cargarMasNoticias">
                <div class="m-timeline-1__marker"></div>
                <span slot="no-more">
                <div class="row">
                    <div class="col m--align-center">
                        <div class="btn btn-sm m-btn--custom m-btn--pill  btn-metal">
                            No existen más Noticias
                        </div>
                    </div>
                </div>
            </span>
                <span slot="no-results">
                No existen Noticias
            </span>
            </infinite-loading>
            <proyecto :id="proyectoSele" :clic="tiempo"></proyecto>
        </div>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import vue2Dropzone from 'vue2-dropzone';
    export default {
        name: "noticias",
        components: {
            vueDropzone: vue2Dropzone,
            InfiniteLoading,
        },
        data: () => ({
            subidas:[],
            comentario:'',
            noticias:[],

            dropzoneOptions: {
                url:'/consulta/upload',
                maxFiles:30,
                maxFilesize: 5,
                headers: { "X-CSRF-TOKEN": window.axios.defaults.headers.common['X-CSRF-TOKEN'] },
                uploadMultiple:true,
                dictDefaultMessage: '<i class="la la-photo"></i>',
                previewTemplate:'<i><i/>',
                acceptedFiles:'image/*',
                dictFallbackMessage:"Su navegador no soporta este componente.",
                dictFileTooBig:"El archivo es muy grande.",
                dictInvalidFileType:"Solo se admiten imágenes.",
                dictResponseError:"Error al enviar el archivo.",
                dictMaxFilesExceeded:"A superado el límite de imágenes.",
            },
            pagina:0,

            proyectoSele:null,
            tiempo:1,
        }),
        methods:{
            cargarProyecto(codigo){
                this.tiempo=moment();
                this.proyectoSele=codigo;
            },
            parsearArchivo:function(archivo){
                return ('/consulta/imagen?nombre='+archivo+'&p='+moment());
            },
            cargarArchivos:function(){
                axios({
                    method: 'OPTIONS',
                    url: '/consulta/upload',
                }).then((response) => {
                    this.subidas=response.data;
                });
            },
            descargarArchivo:function(archivo,nombre){
                //window.open(this.con+'/upload?nombre='+archivo,"_blank");
                window.location.href='/consulta/upload?nombre='+archivo;
                toastr.info("Se descargo "+nombre, "Éxito");
            },
            eliminarArchivo:function(archivo){
                axios({
                    method: 'DELETE',
                    url: '/consulta/upload',
                    params:{
                        'nombre':archivo.file
                    }
                }).then((response) => {
                    toastr.info("Se eliminó "+archivo.name, "Éxito");
                    this.cargarArchivos();
                });
            },
            errores:function(file,meesage,xhr){
                toastr.error(meesage, "Error");
            },
            enviar:function(){
                if(this.comentario.length>10){
                    axios({
                        method: 'POST',
                        url:window.location.href,
                        params:{
                            'comentario':this.comentario,
                        }
                    }).then((response) => {
                        if(response.data.val){
                            toastr.info("Se publicó su comentario", "Éxito");
                            this.cargarPrimerasNoticias();
                            this.comentario='';
                            this.cargarArchivos();
                        }else{
                            toastr.error("Ha ocurrido un error vuelva a intentar", "Error");
                        }
                    });
                }else{
                    toastr.error("El texto no puede estar vacío", "Error");
                }
            },
            enviarHijo:function(comentario){
                    axios({
                        method: 'POST',
                        url:window.location.href,
                        params:{
                            'comentario':comentario.texto,
                            'id':comentario.code,
                            'p':comentario.p,
                        }
                    }).then((response) => {
                        if(response.data.val){
                            comentario.texto='';
                            comentario.hijos++;
                            if(comentario.mostrando)
                                this.cargarHijos(comentario);
                        }else{
                            toastr.error("Ha ocurrido un error vuelva a intentar", "Error");
                        }
                    });
            },
            mostrarComentarios:function(comentario){
                if(!comentario.mostrando){
                    //Object.assign(comentario, {'mostrando':true});
                    comentario.mostrando=true;
                    this.cargarHijos(comentario);
                }

            },
            cargarHijos:function(comentario){
                let parametro   =   comentario.code ? comentario.code : comentario.p;
                axios({
                    method: 'OPTIONS',
                    url:window.location.href+'/'+parametro,
                }).then((response) => {
                    Object.assign(comentario, {'listaHijos':response.data});
                });
            },
            cargarPrimerasNoticias:function(){
                axios.options(window.location.href)
                    .then((response) => {
                        this.noticias = response.data;
                    }).catch((error) => {
                        if(error.status===500)
                            this.cargarPrimerasNoticias();
                    });
            },
            cargarMasNoticias:function($state){
                let pagina  =   this.noticias.length / 5 + 1;
                    pagina  =   pagina.toFixed(0);

                if(pagina===this.pagina)
                    pagina++;
                axios.options(window.location.href, {
                    params: {
                        page: pagina,
                    },
                }).then((response) => {
                    if (response.data.length) {
                        this.noticias = this.noticias.concat(response.data);
                        this.pagina=pagina;
                        $state.loaded();
                        /*
                        if (this.noticias.length===response.data) {
                            $state.complete();
                        }*/
                    } else {
                        $state.complete();
                    }
                }).catch((error) => {
                    if(error.status===500)
                        this.cargarMasNoticias();
                });
            },
            renderizarId:function(id){
                lightGallery(document.getElementById(id),{
                    download: false,
                });
            },
            enviarLike:function(comentario){
                axios({
                    method: 'PUT',
                    url:window.location.href,
                    params:{
                        'id':comentario.code,
                    }
                }).then((response) => {
                    if(response.data.val){
                        comentario.meLike=response.data.like;
                        if(response.data.like)
                            comentario.likes++;
                        else
                            comentario.likes--;
                    }else{
                        toastr.error("Ha ocurrido un error vuelva a intentar", "Error");
                    }
                });
            }
        },
        mounted(){
            $('#fotos').removeClass('vue-dropzone dropzone dz-clickable');
            this.cargarArchivos();
        },
        updated(){
            this.renderizarId('mis-fotos');
        }
    }
</script>

<style scoped>
    .img-item{
        height:37px !important;
        cursor:pointer;
    }
    .fa-heart{
        color: red;
        cursor:pointer;
    }
    .fa-heart-o{
        color:black;
        cursor:pointer;
    }
    a{
        cursor:pointer;
    }


</style>