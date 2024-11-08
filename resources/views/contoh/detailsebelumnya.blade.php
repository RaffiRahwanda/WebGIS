
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.26.0/apexcharts.min.js"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        html,
        body {
             font-family: 'Space Mono', monospace;
        display: flex;
        flex-direction: column;
       
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 690px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }

 * {
	 -webkit-font-smoothing: antialiased;
	 -moz-osx-font-smoothing: grayscale;
	 text-rendering: optimizelegibility;
	 letter-spacing: -0.25px;
}
 ol {
	 padding-left: 50px;
}
 li {
	 color: #4f4f4f;
	 padding-left: 16px;
	 margin-top: 24px;
	 position: relative;
	 font-size: 16px;
	 line-height: 20px;
}
 li:before {
	 content: '';
	 display: block;
	 height: 42px;
	 width: 42px;
	 border-radius: 50%;
	 border: 2px solid #ddd;
	 position: absolute;
	 top: -12px;
	 left: -46px;
}
 strong {
	 color: #292929;
}
 ol.alternating-colors li:nth-child(odd):before {
	 border-color: #0bad02;
}
 ol.alternating-colors li:nth-child(even):before {
	 border-color: #2378d5;
}
 
    </style>
</head>

<body>
    <div class="container py-4 justify-content-center">
        <div class="row">
            <div class="col-md-6 col-xs-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <p>
                        <h4><strong>Sungai:</strong></h4>
                        <h5>{{ $spaces->getNameSungais->nama_sungai }}</h5>
                        </p>
                        <p>
                    <h4><strong>Jembatan:</strong></h4>
                        <h5>{{ $spaces->name }}</h5>
                        </p>

                        <p>
                            <h4>
                                <strong>Keterangan:</strong>
                            </h4>
                        <p>{{ $spaces->content }}</p>
                        </p>
                        <p>
                        <h4>
                            <strong>Foto</strong>
                            <select name="" id="">
                                @foreach($tahun as $th)
                                <option value="">{{$th->tahun}}</option>
                                @endforeach
                            </select>
                        </h4>
                        <img class="img-fluid" width="500" src="{{ asset('uploads/imgCover/' . $spaces->image) }}"
                            alt="">
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('map.index') }}" class="btn btn-outline-primary">Kembali</a>
                    </div>
                </div>
            </div>
         
            <div class="col-md-6 col-xs-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
                        <hr>
                        <div>
        <label for="idSelect">Select ID:</label>
        <select id="idSelect" onchange="updateCharts()">
            @foreach ($hasil as $id)
                <option value="{{ $id->id_hasil }}" {{ $id->id == $defaultId ? 'selected' : '' }}>{{ $id->id_hasil }}</option>
            @endforeach
        </select>
    </div>
                         <div class="card">
                <div class="card-body">

              <div id="chartContainer">
                <div id="chart1"></div>
                <div id="chart2"></div>
            </div>
                    </div>

        </div>
        <hr>

            <div class="card">
                <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                  
                    @if(auth()->user())
                    <a   @foreach($hasil as $h) href="/create/{{$h->id_hasil}}" @endforeach class="btn btn-info" style="margin-left:50em">Tambah Data Hasil</a>
                    @endif
                  
        <thead>
            <tr>
                <th>No</th>
					<th>ID HASIL</th>
					<th>Space_id</th>
					<th>Bulan</th>
					<th>Tahun</th>
					<th>TSS</th>
					<th>DO</th>
                    <th>BOD</th>
                    <th>COD</th>
                    <th>Fosfat</th>
                    <th>Fecal Coli</th>
                    <th>Total Coliform
                        </th>
                    @if(auth()->user())
                    
                    
                    <th>Status</th>
					<th>Aksi</th>
					<th>Aksi </th>
            @endif

            </tr>
        </thead>
        <tbody>
				@php $i=1 @endphp
				@foreach($hasil as $h)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$h->id_hasil}}</td>
                    <!-- <td>{{$h->getNameSungai->nama_sungai}}</td> -->
                    <td>{{$h->space_id}}</td>

                    <td>{{$h->bulan}}</td>
                    <td>{{$h->tahun}}</td>
					<td>{{$h->tss}}</td>
					<td>{{$h->do}}</td>
					<td>{{$h->bod}}</td>
					<td>{{$h->cod}}</td>
					<td>{{$h->fosfat}}</td>
					<td>{{$h->fecal_coli}}</td>
					<td>{{$h->total_coliform}}</td>
                    @if(auth()->user())
                     @if(auth()->user()->role == "Admin")

                        @if($h->status=="Terkonfirmasi")
                    <td>
						{{$h->status}}
					</td>
                        @else
                        <td>
                            <form action="/update_status/{{$h->id_hasil}}"  method="post" enctype="multipart/form-data">
                            @csrf
						<button class="btn btn-info btn-sm" type="submit" onclick="return confirm('Ok untuk konfirmasi!')">{{$h->status}}</button>

                            </form>
					    </td>
                        @endif
					 <td><a class="btn btn-warning btn-sm" href="/edit_hasil/{{$h->id_hasil}}"  >Edit</a></td>
                            <td><a class="btn btn-danger btn-sm" href="/hapus_hasil/{{$h->id_hasil}}" onclick="return confirm('Yakin mau dihapus?')">Hapus</a></td>
                            @endif
                    @endif

				</tr>
				@endforeach
        </tbody>
     </table>
                </div>
            </div>
           
        </div>
    </div>
    {{-- karena hanya akan menampilkan single data dari marker yang dipilih jadi kita tidak 
    melakukan looping untuk halaman detail ini --}}

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

    <script>
      
           var map = L.map('map').setView([{{ $spaces->location }}], 20);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        
          var greenIcon = L.icon({
       
            // iconUrl: 'http://leafletjs.com/examples/custom-icons/leaf-green.png',
            iconUrl: ' https://cdn-icons-png.flaticon.com/512/2209/2209792.png',
            shadowUrl: 'http://leafletjs.com/examples/custom-icons/leaf-shadow.png',

            iconSize:     [60, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        var overlays = {
            //"Streets": streets
            "{{ $spaces->name }}": data{{ $spaces->id }},
        };
        L.control.layers(baseLayers, overlays).addTo(map);
        var curLocation = [{{ $spaces->location }}];
        map.attributionControl.setPrefix(false);
        var marker = new L.marker(curLocation, {
            draggable: 'false',
        });
        map.addLayer(marker);
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
		$('#example').DataTable({
            lengthMenu: [5,10, 25, 50, 75, 100,200],
            responsive: true
        });
	</script>
   
</body>

</html>