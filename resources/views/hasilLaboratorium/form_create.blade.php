@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #map {
            height: 500px;
        }
        .ui-datepicker-calendar {
            display: none;
            }
    </style>
@endsection


{{-- Pada view create.blade space ini kita kan menginput beberapa data yaitu 
nama space (tempat), deskripsi, gambar jika di perlukan, dan titik koordinat lokasi
Untuk cdn yang kita muat disini hampir sama dengan form create pada file view create centrepoint
--}}

@section('content')

<main class="py-4">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded">
                    <div class="card-header">Tambah Hasil Lab</div>
                    <div class="card-body">
                        {{-- action form yang mengarah ke route space.store untuk proses penyimpanan data --}}
                        <form action="/tambah/hasil" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="sungai_id">Nama Sungai</label>
                                <input type="text"  value="{{$data->getNameSungai->nama_sungai}}" name="nama_sungai" class="form-control @error('nama_sungai') is-invalid @enderror" id="" disabled>
                                <input type="text" value="{{$data->sungai_id}}" name="sungai_id" class="form-control @error('sungai_id') is-invalid @enderror"  style="display:none" id="">


                                @error('sungai_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="space_id">Nama Tempat</label>
                                 <input type="text"  value="{{$data->getData?->name}}" name="d" class="form-control @error('space_id') is-invalid @enderror"  id="" disabled> 
                                <input type="text" value="{{$data->space_id}}" name="space_id" class="form-control @error('space_id') is-invalid @enderror" style="display:none" id="">
                                 <input type="text"  value="{{$data->getData?->slug}}" name="slug" class="form-control @error('space_id') is-invalid @enderror"  id=""   style="display:none"> 
                                
                                @error('space_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label for="bulan">Bulan</label>
                                <input type="text" name="bulan" class="form-control @error('bulan') is-invalid @enderror" id="">
                                @error('bulan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="tahun">Tahun</label>
                                <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="">
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="tss">Total suspended solid (TSS)</label>
                                <input type="text" name="tss" class="form-control @error('tss') is-invalid @enderror" id="">
                                @error('tss')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="do">Oksigen terlarut (DO)</label>
                                <input type="text" name="do" class="form-control @error('do') is-invalid @enderror" id="">
                                @error('do')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label for="">BOD</label>
                                <input type="text" name="bod" class="form-control @error('bod') is-invalid @enderror" id="">
                                @error('bod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">COD</label>
                                <input type="text" name="cod" class="form-control @error('cod') is-invalid @enderror" id="">
                                @error('cod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Fosfat</label>
                                <input type="text" name="fosfat" class="form-control @error('fosfat') is-invalid @enderror" id="">
                                @error('fosfat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                             <div class="form-group mb-3">
                                <label for=""> Bakteri Coli Tinja (Fecal Coli)</label>
                                <input type="text" name="fecal_coli" class="form-control @error('fecal_coli') is-invalid @enderror" id="">
                                @error('fecal_coli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for=""> Total Coliform</label>
                                <input type="text" name="total_coliform" class="form-control @error('total_coliform') is-invalid @enderror" id="">
                                @error('total_coliform')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           <div class="form-group mb-3">
                                <label for="kualitas_air">Kualitas Air</label>
                                <select class="form-select" name="kualitas_air" id="">
                                    <option value="Tidak Tercemar">Tidak Tercemar</option>
                                    <option value="Tercemar">Tercemar</option>
                                </select>
                                <!-- <input type="text" name="kualitas_air" class="form-control @error('kualitas_air') is-invalid @enderror" id=""> -->
                                @error('kualitas_air')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                           
                          
                            <div class="form-group mt-3">
                                <a href="/hasil_laboratorium" class="btn btn-info btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy'});
    });​
</script>
@endsection

