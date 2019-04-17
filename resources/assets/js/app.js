
/**(function($) {
    "use strict"; // Start of use strict
    // Configure tooltips for collapsed side navigation
    $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
    })
    // Toggle the side navigation
    $("#sidenavToggler").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("sidenav-toggled");
        $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
        $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
    });
    // Force the toggled class to be removed when a collapsible nav link is clicked
    $(".navbar-sidenav .nav-link-collapse").click(function(e) {
        e.preventDefault();
        $("body").removeClass("sidenav-toggled");
    });
    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
    });
    // Scroll to top button appear
    $(document).scroll(function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });
    // Configure tooltips globally
    $('[data-toggle="tooltip"]').tooltip()
    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });
})(jQuery); // End of use strict
**/
require('./bootstrap');
window.Vue= require('vue');

Vue.component('listarasignatura', require('./components/listarasignatura.vue'));
Vue.component('noticias', require('./components/noticias.vue'));
Vue.component('actividad', require('./components/actividad.vue'));
Vue.component('documento-item', require('./components/documento-item.vue'));
Vue.component('convenio-item', require('./components/convenio-item.vue'));
Vue.component('empresa-item', require('./components/empresa-item.vue'));
Vue.component('documentop', require('./components/documentop.vue'));
Vue.component('consulta2-praticas', require('./components/consulta2-practicas.vue'));
Vue.component('consulta-praticas', require('./components/consulta-practicas.vue'));
Vue.component('dona-item', require('./components/dona-component.vue'));
Vue.component('estudiante-item', require('./components/estudiante-item.vue'));
Vue.component('estudiante-periodo', require('./components/estudiante-periodo.vue'));
Vue.component('estudiante-tipopractica', require('./components/estudiante-tipopractica.vue'));
Vue.component('estudiante-tipoempresa', require('./components/estudiante-tipoempresa.vue'));
Vue.component('estudiante-sector', require('./components/estudiante-sector.vue'));
Vue.component('chart-reporte1', require('./components/chart-reporte1.vue'));
Vue.component('chart-reporte2', require('./components/chart-reporte2.vue'));
Vue.component('chart-reporte3', require('./components/chart-reporte3.vue'));
Vue.component('chart-reporte4', require('./components/chart-reporte4.vue'));
Vue.component('chart-reporte5', require('./components/chart-reporte5.vue'));
Vue.component('chart-reporte6', require('./components/chart-reporte6.vue'));
Vue.component('nueva-practica', require('./components/nueva-practica.vue'));
Vue.component('sedes-componente', require('./components/sedes-componente.vue'));
Vue.component('sedes-nuevo', require('./components/sedes-nuevo.vue'));
Vue.component('facultades-componente', require('./components/facultades-componente.vue'));
Vue.component('facultades-nuevo', require('./components/facultades-nuevo.vue'));
Vue.component('escuelas-componente', require('./components/escuelas-componente.vue'));
Vue.component('escuelas-nuevo', require('./components/escuelas-nuevo.vue'));
Vue.component('carreras-componente', require('./components/carreras-componente.vue'));
Vue.component('carreras-nuevo', require('./components/carreras-nuevo.vue'));
Vue.component('tutores-componente', require('./components/tutores-componente.vue'));
Vue.component('tutores-nuevo', require('./components/tutores-nuevo.vue'));
Vue.component('coordinadores-componente', require('./components/coordinadores-componente.vue'));
Vue.component('coordinadores-nuevo', require('./components/coordinadores-nuevo.vue'));
Vue.component('empresa-nuevo', require('./components/empresa-nuevo.vue'));
Vue.component('empresas-componente', require('./components/empresas-componente.vue'));
Vue.component('formato-nuevo', require('./components/formato-nuevo.vue'));
Vue.component('estudiantes-componente', require('./components/estudiantes-componente.vue'));
Vue.component('boton-borrar-practica', require('./components/boton-borrar-practica.vue'));
Vue.component('avatar-nuevo', require('./components/avatar-nuevo.vue'));
Vue.component('convenio-nuevo', require('./components/convenio-nuevo.vue'));
Vue.component('profesores-nuevo', require('./components/profesores-nuevo.vue'));
Vue.component('profesores-componente', require('./components/profesores-componente.vue'));
Vue.component('reporte7-item', require('./components/reporte7-item.vue'));
Vue.component('reporte8-item', require('./components/reporte8-item.vue'));
Vue.component('reporte9-item', require('./components/reporte9-item.vue'));
Vue.component('reporte10-item', require('./components/reporte10-item.vue'));
const app = new Vue({
    el: '#app'
});