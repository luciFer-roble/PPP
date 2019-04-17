<template>
    <div class="row">
        <div class="col-lg-12">
            <canvas id="canvas1">

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
                axios.get(window.location.origin+'/api/totalesporperiodo').then((response)=>{
                    this.totales=(response.data);
                    for(let i=0; i<Object.keys(this.totales).length; i++){
                        if(this.totales[i] == null){
                            console.log(0);
                            this.totalesarray.push(0);
                        }else{
                            //console.log(this.totales[i][0].totalestudiantes);
                            //this.totales[i].forEach(function (total) {
                              //  console.log(total);
                            //});
                            this.totalesarray.push(this.totales[i].totalestudiantes);
                        }
                    }
                    const data = {
                        type: 'bar',
                        data: {
                            labels: this.periodosarray,
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
                                text: 'PRACTICAS CULMINADAS'
                            },
                            responsive: true,
                            cutoutPercentage: 0,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data, ) {
                                        var dataset = data.datasets[tooltipItem.datasetIndex];
                                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                        var currentValue = dataset.data[tooltipItem.index];
                                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                            return previousValue + currentValue;
                                        });
                                        var percentage = parseFloat((currentValue/total*100).toFixed(0));
                                        return currentValue + ' (' + percentage + '%)';
                                    }
                                }
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                       /* callback: function(value, index, values) {
                                            return ((value / 2) * 100) + '%';
                                        }*/
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
                    this.createChart('canvas1', data);
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