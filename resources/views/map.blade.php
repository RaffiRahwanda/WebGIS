<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin="">
    </script>

     {{-- cdn leaflet search --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>


     <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
     <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">

        <!-- <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster-src.js"></script> -->
        <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
@extends('layouts.app')
 
@section('content')
     
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <style>
        body {
            padding: 0;
            margin: 0;
        }
        #map {
            height: 100%;
            width: 100vw;
        }
    </style>

    <div id="map"></div>
    <script>
      
      var map = L.map('map').setView([{{ $centrePoint->location }}], 10);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
    //     var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
    //         'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    //        mbUrl =
    //         'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA';
    //     var satellite = L.tileLayer(mbUrl, {
    //             id: 'mapbox/satellite-v9',
    //             tileSize: 512,
    //             zoomOffset: -1,
    //             attribution: mbAttr
    //         }),
    //         dark = L.tileLayer(mbUrl, {
    //             id: 'mapbox/dark-v10',
    //             tileSize: 512,
    //             zoomOffset: -1,
    //             attribution: mbAttr
    //         }),
    //         streets = L.tileLayer(mbUrl, {
    //             id: 'mapbox/streets-v11',
    //             tileSize: 512,
    //             zoomOffset: -1,
    //             attribution: mbAttr
    //         });
    //     var map = L.map('map', {
                       
    //         center: [{{ $centrePoint->location }}],
    //         zoom: 5,
    //         layers: [streets]
    //     });
    //     var baseLayers = {
    //         "Grayscale": dark,
    //         "Satellite": satellite,
    //         "Streets": streets
    //     };
    //     var overlays = {
    //         "Streets": streets,
    //         "Grayscale": dark,
    //         "Satellite": satellite,
    //     };
       var greenIcon = L.icon({
       
            // iconUrl: 'http://leafletjs.com/examples/custom-icons/leaf-green.png',
            //https://www.pngkey.com/png/detail/417-4174990_how-to-set-use-small-green-dot-icon.png
            //https://cdn-icons-png.flaticon.com/512/2209/2209792.png
            iconUrl: 'https://www.freepnglogos.com/uploads/dot-png/dot-system-status-and-maintenance-schedule-beachboard-3.png',
           // https://www.freepnglogos.com/uploads/dot-png/file-location-dot-red-svg-wikipedia-0.png
            // shadowUrl: 'http://leafletjs.com/examples/custom-icons/leaf-shadow.png',

            iconSize:     [30, 30], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });


        var redIcon = L.icon({
       
            // iconUrl: 'http://leafletjs.com/examples/custom-icons/leaf-green.png',
            //https://www.pngkey.com/png/detail/417-4174990_how-to-set-use-small-green-dot-icon.png
            //https://cdn-icons-png.flaticon.com/512/2209/2209792.png
            iconUrl: 'https://www.freepnglogos.com/uploads/dot-png/file-location-dot-red-svg-wikipedia-0.png',
            // shadowUrl: 'http://leafletjs.com/examples/custom-icons/leaf-shadow.png',

            iconSize:     [30, 30], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        // Menampilkan popup data ketika marker di klik 
        var markers = new L.MarkerClusterGroup();
        

            @foreach($hasil_lab as $items)
                var mas = L.marker( [{{ $items->locations }}],  @if($items->kualitas_air == 'Tidak Tercemar') { icon: greenIcon }  @elseif($items->kualitas_air == 'Tercemar') { icon: redIcon }@endif)
                .bindPopup(
                            "<div class='my-2'><img src='{{ asset('/uploads/imgCover/' . $items->images) }}' class='img-fluid' width='700px'></div>" +
                            "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $items->names }}</div>" + 
                            "<div><a href='{{ route('map.show', $items->slugs) }}' class='btn btn-outline-info btn-sm'>Detail Tempat</a></div>" +
                            "<div class='my-2'></div>"
                        );
                markers.addLayer(mas);

               
            

                
               
                map.addLayer(markers);
        @endforeach
        
    
        var datas = [    
        @foreach ($spaces as $key => $value) 
            {"loc":[{{$value->location }}], "title": '{!! $value->name !!}'},
        @endforeach            
        ];
        // pada koding ini kita menambahkan control pencarian data        
        var markersLayer = new L.MarkerClusterGroup();
        map.addLayer(markersLayer);
        var controlSearch = new L.Control.Search({
            position:'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 17,
            markerLocation: true
        })
    
    //menambahkan variabel controlsearch pada addControl
       map.addControl( controlSearch );
       markersLayer.remove();
        // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
        for(i in datas) {
          
            var title = datas[i].title,	
                loc = datas[i].loc,		
                marker = new L.Marker(new L.latLng(loc), {title: title} );
            markersLayer.addLayer(marker);
            // melakukan looping data untuk memunculkan popup dari space yang dipilih
            @foreach ($spaces as $item)
          L.marker([{{ $item->location }}]
                )
                .bindPopup(
                    "<div class='my-2'><img src='{{ asset('/uploads/imgCover/' . $item->image) }}' class='img-fluid' width='700px'></div>" +
                    "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name }}</div>" +
                    "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
                    "<div class='my-2'></div>"
                );
                
            @endforeach
            
        }
        L.control.layers(baseLayers, overlays).addTo(map);
       
    </script>
@endsection