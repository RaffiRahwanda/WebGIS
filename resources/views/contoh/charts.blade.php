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
        <label for="categorySelect">Select Category:</label>
        <select id="categorySelect" onchange="updateCharts()">
            <option value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->space_id }}">{{ $category->space_id }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="yearSelect">Select Year:</label>
        <select id="yearSelect" onchange="updateCharts()">
            <option value="">Select a Year</option>
            @foreach ($years as $year)
                <option value="{{ $year->tahun }}">{{ $year->tahun }}</option>
            @endforeach
        </select>
    </div>

    <div id="chartContainer" style="display: none;">
        <div id="chart1"></div>
        <div id="chart2"></div>
    </div>

    <script>
        var allData = @json($allData);
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
            var selectedCategory = document.getElementById('categorySelect').value;
            var selectedYear = document.getElementById('yearSelect').value;

            if (!selectedCategory || !selectedYear) {
                document.getElementById('chartContainer').style.display = 'none';
                return;
            }

            var chartData = allData[selectedCategory][selectedYear];

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
                    type:'area',
                    data: chartData.do
                },
                {
                    name: 'BOD',
                    type:'line',
                    data: chartData.bod
                },
                {
                    name: 'COD',
                    type:'line',
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
                        text: 'Sales'
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
                        text: 'Profit'
                    }
                });
            } else {
                charts.push(createChart('chart1', 'Sales', chartData.tss,chartData.do,chartData.bod,chartData.cod,chartData.fosfat,chartData.labels));
                        charts.push(createChart('chart2', 'Profit', chartData.fecal_coli, chartData.total_coliform,chartData.labels));
                        charts.forEach(chart => chart.render());
            }
            document.getElementById('chartContainer').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCharts();
        });
    </script>
</body>
</html>
