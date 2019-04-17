<template>
    <div class="row">
        <div class="col-lg-12 mb-5">
            <canvas id="canvas41">

            </canvas>
        </div>
        <div class="col-lg-12">
            <canvas id="canvas42">

            </canvas>
        </div>
    </div>
</template>

<script>

    import Chart from 'chart.js';
    export default {
        props: {
        },
        data:()=>({
            totaldocs:'5',
            total:0,
            privadase:0,
            privadasp:0,
            publicase:0,
            publicasp:0,
            sinlucroe:0,
            sinlucrop:0,
            internacionalese:0,
            internacionalesp:0

        }),
        methods: {
            createChart(chartId, chartData) {
                var canvas = document.getElementById(chartId);
                var ctx = canvas.getContext("2d");
                const myChart = new Chart(ctx, {
                    type: chartData.type,
                    data: chartData.data,
                    options: chartData.options,
                });
            },
            getaall:function () {
                axios.get(window.location.origin+'/api/totalpracticas').then((response)=>{
                    this.total=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getprivadae:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    if(response.data === ''){
                        this.privadase=(0);
                    }else{
                        this.privadase=parseInt(response.data.totalestudiantes);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getprivadap:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.privadasp=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpublicae:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    if(response.data === ''){
                        this.publicase=(0);
                    }else{
                        this.publicase=parseInt(response.data.totalestudiantes);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpublicap:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.publicasp=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsinlucroe:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    if(response.data === ''){
                        this.sinlucroe=(0);
                    }else{
                        this.sinlucroe=parseInt(response.data.totalestudiantes);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsinlucrop:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.sinlucrop=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getinternacionalese:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    if(response.data === ''){
                        this.internacionalese=(0);
                    }else{
                        this.internacionalese=parseInt(response.data.totalestudiantes);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getinternacionalesp:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.internacionalesp=(response.data);
                    const data = {
                        type: 'polarArea',
                        data: {
                            labels: ["Privada", "Publica", "Sin Fines De Lucro", "Organismo Internacional"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#687f91", "#397aac", "#cfdce6", "#092940"],
                                    data: [this.privadasp, this.publicasp, this.sinlucrop, this.internacionalesp]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS POR TIPO DE EMPRESA'
                            },
                            responsive: true,
                            animation:{
                                animateRotate: false,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            },
                            scale: {
                                ticks: {
                                    beginAtZero: true
                                },
                                reverse: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var dataset = data.datasets[tooltipItem.datasetIndex];
                                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                            return previousValue + currentValue;
                                        });
                                        var currentValue = dataset.data[tooltipItem.index];
                                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                        return currentValue + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    };
                    const data2 = {
                        type: 'polarArea',
                        data: {
                            labels: ["Privada", "Publica", "Sin Fines De Lucro", "Organismo Internacional"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#687f91", "#397aac", "#cfdce6", "#092940"],
                                    data: [this.privadase, this.publicase, this.sinlucroe, this.internacionalese]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'ESTUDIANTES POR TIPO DE EMPRESA'
                            },
                            responsive: true,
                            animation:{
                                animateRotate: false,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            },
                            scale: {
                                ticks: {
                                    beginAtZero: true
                                },
                                reverse: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var dataset = data.datasets[tooltipItem.datasetIndex];
                                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                            return previousValue + currentValue;
                                        });
                                        var currentValue = dataset.data[tooltipItem.index];
                                        var percentage = parseFloat((currentValue/total*100).toFixed(0));
                                        return currentValue + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    };
                    this.createChart('canvas41', data);
                    this.createChart('canvas42', data2);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {



            this.getaall();
            this.getprivadae('Privada');
            this.getpublicae('Publica');
            this.getsinlucroe('Sin Fines de Lucro');
            this.getinternacionalese('Organismo Internacional');
            this.getprivadap('Privada');
            this.getpublicap('Publica');
            this.getsinlucrop('Sin Fines de Lucro');
            this.getinternacionalesp('Organismo Internacional');


        }
    }
</script>

<style scoped>
    </style>