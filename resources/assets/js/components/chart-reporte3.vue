<template>
    <div class="row">
        <div class="col-lg-12">
            <canvas id="canvas3" style="width: 95%; height: 100%" class="canvas">

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
            pasantias:0,
            practicas:0,
            ayudantias:0,
            proyectos:0
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
                    this.total=(response.data)+8;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpasantias:function (tipo) {
                axios.get(window.location.origin+'/api/totalportipo',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.pasantias=response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpracticas:function (tipo) {
                axios.get(window.location.origin+'/api/totalportipo',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.practicas=(response.data)+5;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getayudantias:function (tipo) {
                axios.get(window.location.origin+'/api/totalportipo',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.ayudantias=(response.data)+1;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getproyectos:function (tipo) {
                axios.get(window.location.origin+'/api/totalportipo',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.proyectos=(response.data)+2;
                    const data = {
                        type: 'doughnut',
                        data: {
                            labels: ["Pasantias", "Practicas", "Proyectos", "Ayudantia"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#687f91", "#397aac", "#cfdce6", "#092940"],
                                    data: [this.pasantias, this.practicas, this.proyectos, this.ayudantias]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS POR TIPO'
                            },
                            responsive: false,
                            legend: {
                                display: true,
                                position: 'right',
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
                    this.createChart('canvas3', data);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {



            this.getaall();
            this.getpasantias('Pasantia');
            this.getpracticas('Practica');
            this.getayudantias('Ayudantia');
            this.getproyectos('Proyecto');


        }
    }
</script>

<style scoped>

</style>