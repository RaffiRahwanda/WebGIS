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
        <label for="idSelect">Select ID:</label>
        <select id="idSelect" onchange="updateCharts()">
            @foreach ($ids as $id)
                <option value="{{ $id->id_hasil }}" {{ $id->id == $defaultId ? 'selected' : '' }}>{{ $id->id_hasil }}</option>
            @endforeach
        </select>
    </div>

    <div id="chartContainer">
        <div id="chart1"></div>
        <div id="chart2"></div>
    </div>

    <script>
        var defaultChartsData = @json($charts);
        var charts = [];

        function createChart(chartId, seriesName, seriesData, labels) {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    id: chartId
                },
                series: [{
                    name: seriesName,
                    data: seriesData
                }],
                xaxis: {
                    categories: labels,
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

            return new ApexCharts(document.querySelector(`#${chartId}`), options);
        }

        function updateCharts() {
      
            var selectedId = document.getElementById('idSelect').value;

            fetch(`/chart-data/${selectedId}`)
                .then(response => response.json())
                .then(chartData => {
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
                                text: 'Sales for ID ' + selectedId
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
                        },
                            ],
                            xaxis: {
                                categories: chartData.labels
                            },
                            title: {
                                text: 'Profit for ID ' + selectedId
                            }
                        });
                    } else {
                        charts.push(createChart('chart1', 'Sales', chartData.tss,chartData.do,chartData.bod,chartData.cod,chartData.fosfat,chartData.labels));
                        charts.push(createChart('chart2', 'Profit', chartData.fecal_coli, chartData.total_coliform,chartData.labels));
                        charts.forEach(chart => chart.render());
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCharts(defaultChartsData);
        });
    </script>
</body>
</html>
