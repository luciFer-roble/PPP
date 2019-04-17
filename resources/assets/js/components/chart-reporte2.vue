<template>
    <div class="row">
        <div class="col-lg-12">
            <canvas id="canvas2">

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
            periodos:[],
            totales:[],
            periodosarray:[],
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
            getperiodos:function () {
                axios.get(window.location.origin+'/api/totalperiodos').then((response)=>{
                    this.periodos=(response.data);
                    for(var i=0; i<Object.keys(this.periodos).length; i++){
                        console.log(this.periodos[i].nombreperiodoacademico);
                        this.periodosarray.push(this.periodos[i].nombreperiodoacademico);
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            gettotales:function () {
                axios.get(window.location.origin+'/api/totalesporperiodo2').then((response)=>{
                    this.totales=(response.data);
                    const data = {
                        type: 'line',
                        data: {
                            labels: this.periodosarray,
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: "#e7eff6",
                                    borderColor: "#4b86b4",
                                    data: this.totales
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS REALIZADAS POR PERIODO'
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
                                        labelString: 'Periodo academico'
                                    }
                                }]
                            }
                        }
                    };
                    this.createChart('canvas2', data);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getperiodos();
            this.gettotales();
        }
    }
</script>

<style scoped>

</style>