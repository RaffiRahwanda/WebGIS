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
                    
                        <form action="/update/{{$hasil->id_hasil}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama Sungai</label>
                                <input type="text" name="sungai_id" value="{{$hasil->sungai_id}}"class="form-control @error('sungai_id') is-invalid @enderror" id="" style="display:none">
                                

                                <input type="text" name="name_sungai" value="{{$hasil->getNameSungai->nama_sungai}}"class="form-control @error('tts') is-invalid @enderror" id=""  disabled>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama Tempat</label>
                                <input type="text" name="space_id" value="{{$hasil->space_id}}"class="form-control @error('tts') is-invalid @enderror" id="" style="display:none">

                                <input type="text" name="name_tempat" value="{{$hasil->getData?->name}}"class="form-control @error('tts') is-invalid @enderror" id=""  disabled>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                             <div class="form-group mb-3">
                                <label for="name">Bulan</label>
                               

                                <input type="text" name="bulan" value="{{$hasil->bulan}}"class="form-control @error('tts') is-invalid @enderror" id="" >
                                @error('bulan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="name">Tahun</label>
                                

                                <input type="text" name="tahun" value="{{$hasil->tahun}}"class="form-control @error('tts') is-invalid @enderror" id="" >
                                @error('bulan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="tts">Total suspended solid (TSS)</label>
                                <input type="text" name="tss" value="{{$hasil->tss}}"class="form-control @error('tts') is-invalid @enderror" id="" >
                                @error('tts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="do">Oksigen terlarut (DO)</label>
                                <input type="text" name="do" value="{{$hasil->do}}" class="form-control @error('do') is-invalid @enderror" id="">
                                @error('do')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label for="">BOD</label>
                                <input type="text" name="bod" value="{{$hasil->bod}}"class="form-control @error('bod') is-invalid @enderror" id="">
                                @error('bod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">COD</label>
                                <input type="text" name="cod" value="{{$hasil->cod}}" class="form-control @error('cod') is-invalid @enderror" id="">
                                @error('cod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Fosfat</label>
                                <input type="text" name="fosfat" value="{{$hasil->fosfat}}" class="form-control @error('fosfat') is-invalid @enderror" id="">
                                @error('fosfat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                             <div class="form-group mb-3">
                                <label for=""> Bakteri Coli Tinja (Fecal Coli)</label>
                                <input type="text" name="fecal_coli" value="{{$hasil->fecal_coli}}" class="form-control @error('coli') is-invalid @enderror" id="">
                                @error('coli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for=""> Total Coliform</label>
                                <input type="text" name="total_coliform"  value="{{$hasil->total_coliform}}" class="form-control @error('coliform') is-invalid @enderror" id="">
                                @error('coliform')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for=""> Kualitas Air</label>
                                <select class="form-select" name="kualitas_air" id="">
                                    <option value="{{$hasil->kualitas_air}}">{{$hasil->kualitas_air}}</option>
                                    @if($hasil->kualitas_air == "Tercemar")
                                     <option value="Tidak Tercemar">Tidak Tercemar</option>
                                    @else
                                     <option value="Tercemar">Tercemar</option>
                                    @endif
                                </select>
                                @error('kualitas_air')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                           
                          
                            <div class="form-group mt-3">
                                <a href="/hasil_lab/{{$hasil->user_id}}" class="btn btn-info btn-sm">Kembali</a>

                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

