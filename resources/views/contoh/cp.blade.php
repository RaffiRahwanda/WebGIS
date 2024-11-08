<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.min.js"></script>
</head>
<body>
    <div>
        <label for="yearSelect">Select Year:</label>
        <select id="yearSelect" onchange="updateCharts()">
            <?php

            use Carbon\Carbon;
            $now = Carbon::now();
            ?>
          
   @for ($year = 2019; $year <= 2024; $year++)

                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
          
        </select>
    </div>

    <div id="chartContainer"> 
        <div id="chart1"></div>
        <div id="chart2"></div>

    </div>

    <script>
        var chartsData = @json($charts);
         var charts = [];
          function createChart(chartId,chartData ,seriesName, seriesData,labels) {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    id: chartId
                },
                series: [
                    {
                    name: 'TSS',
                    type:'line',
                    data: chartData.tss // pastikan data ada di sini
                },
                {
                    name: 'DO',
                    type:'column',
                    data: chartData.do
                },
               ],
                xaxis: {
                    categories: chartData.labels,
                    tickPlacement: 'on',
                    labels: {
                        rotate: -45,
                        rotateAlways: true,
                        hideOverlappingLabels: true,
                        showDuplicates: false,
                        trim: true,
                        maxHeight: 120,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                title: {
                    text: seriesName
                }
            };

           var chart =  new ApexCharts(document.querySelector(`#${chartId}`), options);
           chart.render();
        }

        // function updateChart() {
        //     var selectedYear = document.getElementById('yearSelect').value;
        //     var chartData = charts[selectedYear];
        //     var chartData1 = charts1[selectedYear];
        //     var options = {
        //         chart: {
        //          type: 'line',
        //          height: 500,
        //         },
        //         markers: {
        //             size: 0
        //             },
        //         series: [
        //         {
        //             name: 'TSS',
        //             type:'line',
        //             data: chartData.tss // pastikan data ada di sini
        //         },
        //         {
        //             name: 'DO',
        //             type:'column',
        //             data: chartData.do
        //         },
        //         {
        //             name: 'BOD',
        //             type:'line',
        //             data: chartData.bod
        //         },
        //         {
        //             name: 'COD',
        //             type:'area',
        //             data: chartData.cod
        //         },
        //         {
        //             name: 'FOSFAT',
        //             type:'line',

        //             data: chartData.fosfat
        //         },
        //         // {
        //         //     name: 'FECAL COLI',
        //         //     type:'line',

        //         //     data: chartData.fecal_coli
        //         // },
        //         // {
        //         //     name: 'TOTAL COLIFORM',
        //         //     type:'column',

        //         //     data: chartData.total_coliform
        //         // },
        //         ],
        //           yaxis: {
        //             stepSize: 20
        //             },
        //         xaxis: {
        //             categories: chartData.labels, // pastikan labels ada di sini
        //         },  
        //         title: {
        //             text: 'Sales in ' + selectedYear
        //         }
        //     };

        //      var options1 = {
        //         chart: {
        //          type: 'line',
       
                
        //             height: 500,
                    
        //         },
        //         markers: {
        //             size: 0
        //             },
        // //          stroke: {
        // //   curve: 'smooth'
        // // },
        //         series: [
        //         // {
        //         //     name: 'TSS',
        //         //     type:'line',
        //         //     data: chartData.tss // pastikan data ada di sini
        //         // },
        //         // {
        //         //     name: 'DO',
        //         //     type:'column',
        //         //     data: chartData.do
        //         // },
        //         // {
        //         //     name: 'BOD',
        //         //     type:'line',
        //         //     data: chartData.bod
        //         // },
        //         // {
        //         //     name: 'COD',
        //         //     type:'area',
        //         //     data: chartData.cod
        //         // },
        //         // {
        //         //     name: 'FOSFAT',
        //         //     type:'line',

        //         //     data: chartData.fosfat
        //         // },
        //         {
        //             name: 'FECAL COLI',
        //             type:'line',

        //             data: chartData1.fecal_coli
        //         },
        //         {
        //             name: 'TOTAL COLIFORM',
        //             type:'column',

        //             data: chartData1.total_coliform
        //         },
        //         ],
        //           yaxis: {
        //             stepSize: 20
        //             },
        //         xaxis: {
        //             categories: chartData1.labels, // pastikan labels ada di sini
        //         },  
        //         title: {
        //             text: 'Sales in ' + selectedYear
        //         }
        //     };

        //     if (window.apexChart) {
        //         window.apexChart.updateOptions(options);
        //         window.apexChart.updateOptions(options1);

        //     } else {
        //         window.apexChart = new ApexCharts(document.querySelector("#chart"), options);
        //         window.apexChart = new ApexCharts(document.querySelector("#chart1"), options1);

        //         window.apexChart.render();
        //     }
        // }


        function updateCharts() {
            var selectedYear = document.getElementById('yearSelect').value;
            var chartData = chartsData[selectedYear];

            if (charts.length > 0) {
                charts[0].updateOptions({
                series: [
                    {
                    name: 'TSS',
                    type:'line',
                    data: chartData.tss // pastikan data ada di sini
                },
                {
                    name: 'DO',
                    type:'column',
                    data: chartData.do
                },
                {
                    name: 'BOD',
                    type:'line',
                    data: chartData.bod
                },
                {
                    name: 'COD',
                    type:'area',
                    data: chartData.cod
                },
                {
                    name: 'FOSFAT',
                    type:'line',

                    data: chartData.fosfat
                }
            ],
                    xaxis: {
                        categories: chartData.labels
                    },
                    title: {
                        text: 'COD ' + selectedYear
                    }
                });
                charts[1].updateOptions({
                    series: [ 
                        {
                            name: 'FECAL COLI',
                            type:'line',

                            data: chartData.fecal_coli
                        },
                        {
                            name: 'TOTAL COLIFORM',
                            type:'area',

                            data: chartData.total_coliform
                        },],
                    xaxis: {
                        categories: chartData.labels
                    },
                    title: {
                        text: 'Profit in ' + selectedYear
                    }
                });
            } else {
                charts.push(createChart('chart1', chartData, 'Sales', chartData.tss,chartData.do,chartData.bod,chartData.cod,chartData.fosfat,chartData.labels));
                charts.push(createChart('chart2', chartData, 'Profit', chartData.fecal_coli, chartData.total_coliform,chartData.labels));
                charts.forEach(chart => chart.render());
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCharts();
        });
    </script>
</body>
</html>
