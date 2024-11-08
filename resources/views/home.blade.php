@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.min.js"></script>
@section('content')
<main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header"> <h2 for="yearSelect"> Grafik:</h2>
</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="p-6 m-20 bg-white rounded shadow">
                      <div style="padding-left:90px;padding-right:90px">
                                   <div class="card-header"><h5>Tahun:</h5>
</div>
        <select class="form-select" id="yearSelect" onchange="updateCharts()">
            <?php

            use Carbon\Carbon;
            $now = Carbon::now();
            ?>
             @for ($year = 2019; $year <= $now->year; $year++)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>
    </div>
    <br>

    <div id="chartContainer"> 
        <div id="chart1"></div>
        <div id="chart2"></div>

    </div>
                    </div>
                      
              
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
</main>


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
                   {
                    name: 'BOD',
                    type:'line',
                    data: chartData.bod // pastikan data ada di sini
                },
                {
                    name: 'COD',
                    type:'column',
                    data: chartData.cod
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
             var options1 = {
                chart: {
                    type: 'area',
                    height: 350,
                    id: chartId
                },
                series: [
                    {
                    name: 'TSS',
                    type:'line',
                    data: chartData.cod // pastikan data ada di sini
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
           return new ApexCharts(document.querySelector(`#${chartId}`), options);
        //    return new ApexCharts(document.querySelector('#chart1'), options);
          
        }
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
                        text: 'TSS, DO, BOD, COD, FOSFAT ' + selectedYear
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
                        text: 'Fecal Coli & Total Coliform' + selectedYear
                    }
                });
            } else {
                charts.push(createChart('chart1', chartData, 'TSS, DO, BOD, COD, FOSFAT', chartData.tss,chartData.do,chartData.bod,chartData.cod,chartData.fosfat,chartData.labels));
                charts.push(createChart('chart2', chartData, 'Fecal Coli & Total Coliform', chartData.fecal_coli, chartData.total_coliform,chartData.labels));
                charts.forEach(chart => chart.render());
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCharts();
        });
    </script>

@endsection
