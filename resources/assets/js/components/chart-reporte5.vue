<template>
    <div class="row">
        <div class="col-lg-12 mb-5" >
            <canvas id="canvas51">

            </canvas>
        </div>
        <div class="col-lg-12">
            <canvas id="canvas52">

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
            primarioe:0,
            primariop:0,
            secundarioe:0,
            secundariop:0,
            terciarioe:0,
            terciariop:0

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
            getprimarioe:function (sector) {
                axios.get(window.location.origin+'/api/totalestudiantesporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    console.log(response.data);
                    if(response.data != 'vacio'){
                        this.primarioe=parseInt(response.data.totalestudiantes);
                    }else{
                        this.primarioe=0;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getprimariop:function (sector) {
                axios.get(window.location.origin+'/api/totalpracticasporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    this.primariop=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsecundarioe:function (sector) {
                axios.get(window.location.origin+'/api/totalestudiantesporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    if(response.data != 'vacio'){
                        this.secundarioe=parseInt(response.data.totalestudiantes);
                    }else{
                        this.secundarioe=0;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsecundariop:function (sector) {
                axios.get(window.location.origin+'/api/totalpracticasporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    this.secundariop=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getterciarioe:function (sector) {
                axios.get(window.location.origin+'/api/totalestudiantesporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    if(response.data != 'vacio'){
                        this.terciarioe=parseInt(response.data.totalestudiantes);
                    }else{
                        this.terciarioe=0;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getterciariop:function (sector) {
                axios.get(window.location.origin+'/api/totalpracticasporsectorempresa',{
                    params:{'sector':sector}
                }).then((response)=>{
                    this.terciariop=(response.data);
                    const data = {
                        type: 'polarArea',
                        data: {
                            labels: ["Primario", "Secundario", "Terciario"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#687f91", "#397aac", "#cfdce6", "#092940"],
                                    data: [this.primariop, this.secundariop, this.terciariop]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS POR SECTOR DE EMPRESA'
                            },
                            responsive: true,
                            animation:{
                                animateRotate: false,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                position: 'left',
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
                    const data2 = {
                        type: 'polarArea',
                        data: {
                            labels: ["Primario", "Secundario", "Terciario"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#687f91", "#397aac", "#cfdce6", "#092940"],
                                    data: [this.primarioe, this.secundarioe, this.terciarioe]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'ESTUDIANTES POR SECTOR DE EMPRESA'
                            },
                            responsive: true,
                            animation:{
                                animateRotate: false,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                position: 'left',
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
                    this.createChart('canvas51', data);
                    this.createChart('canvas52', data2);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {



            this.getaall();
            this.getprimarioe('Primario');
            this.getsecundarioe('Secundario');
            this.getterciarioe('Terciario');
            this.getprimariop('Primario');
            this.getsecundariop('Secundario');
            this.getterciariop('Terciario');


        }
    }
</script>

<style scoped>

</style>