<template>
    <div class="row">
        <div class="col-lg-12">
            <canvas id="canvas6">

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
            niveles:[],
            totales:[],
            nivelesarray:[],
            totalesarray:[]
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
            getniveles:function () {
                axios.get(window.location.origin+'/api/totalniveles').then((response)=>{
                    this.niveles=(response.data);
                    for(var i=0; i<Object.keys(this.niveles).length; i++){
                        console.log(this.niveles[i].nombrenivel);
                        this.nivelesarray.push(this.niveles[i].nombrenivel);
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            gettotales:function () {
                axios.get(window.location.origin+'/api/totalespornivel').then((response)=>{
                    this.totales=(response.data);
                    const data = {
                        type: 'bar',
                        data: {
                            labels: this.nivelesarray,
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ['#2a4d69', '#4b86b4', '#adcbe3', '#e7eff6', '#63ace5'],
                                    data: this.totales
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS POR NIVEL'
                            },
                            responsive: true,
                            cutoutPercentage: 0,
                            legend: {
                                display: false
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
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Niveles'
                                    }
                                }]
                            }
                        }
                    };
                    this.createChart('canvas6', data);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getniveles();
            this.gettotales();
        }
    }
</script>

<style scoped>

</style>