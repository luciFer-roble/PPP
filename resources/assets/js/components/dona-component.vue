<template>
    <div>

        <div class="convas1">
            <canvas id="avancechart">
            </canvas>

            <div class="donut-inner">
                <h5 class="btn text-primary porcentaje" >
                    <button class="btn border-0 btn-lg btn-link text-primary text-bold" @click="actividades">{{ Math.round((suma*100)/practica.horaspractica) }}%</button>
                </h5>
            </div>
        </div>
        <div class="convas2">
            <canvas id="documentoschart">
            </canvas>

            <div class="donut-inner2">
                <h5 class="btn text-primary porcentaje" >
                    <button class="btn border-0 btn-lg btn-link text-primary text-bold" @click="documentos">{{ Math.round((docs*100)/totaldocs) }}%</button>
                </h5>
            </div>
        </div>
    </div>
</template>

<script>

    import Chart from 'chart.js';
    export default {
        props: {

            practica: {
                type: Object
            },
            suma: Number,
            docs: Number
        },
        data:()=>({
            totaldocs:'5'
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

            actividades:function () {
                window.location.href = '/actividades/'+this.practica.idpractica+'/list';
            },

            documentos:function () {
                window.location.href = '/documentos/'+this.practica.idpractica+'/list';
            },
            gettotaldocs: function () {
                axios.get(window.location.origin+'/api/totaldocs',{
                        params:{'carrera':this.practica.estudiante.carrera.idcarrera}
                }).then((response)=>{
                    this.totaldocs=response.data;

                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {

            const data = {
                type: 'doughnut',
                data: {
                    labels: ["Completo", "Incompleto"],
                    datasets: [
                        {
                            label: "%Proyecto",
                            backgroundColor: ["#e843b9", "#ddd"],
                            data: [this.suma,(this.practica.horaspractica-this.suma)]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '% Avance'
                    },
                    responsive: true,
                    cutoutPercentage: 90,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                            },
                            title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                            }
                        }
                    }
                }
            };
            const data2 = {
                type: 'doughnut',
                data: {
                    labels: ["Completo", "Incompleto"],
                    datasets: [
                        {
                            label: "%Documentos",
                            backgroundColor: ["#3e95cd","#ddd"],
                            data: [this.docs,(this.totaldocs-this.docs)]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '% Documentos'
                    },
                    responsive: true,
                    cutoutPercentage: 90,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                            },
                            title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                            }
                        }
                    }
                }
            };

            this.gettotaldocs();
            this.createChart('avancechart', data);
            this.createChart('documentoschart', data2);
            console.log(this.docs);


        }
    }
</script>

<style scoped>
    .donut-inner {
        text-align: center;
        margin-top: -28%;
        margin-bottom: 30%;
    }
    .donut-inner2 {
        text-align: center;
        margin-top: -28%;
        margin-bottom: 12%;
    }
    .donut-inner h5 {
        margin-bottom: 5px;
        margin-top: 0;
    }
    .donut-inner span {
        font-size: 5px;
    }
</style>