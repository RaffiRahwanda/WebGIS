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
                    <div class="card-header">Tambah Tempat</div>
                    <div class="card-body">
                        {{-- action form yang mengarah ke route space.store untuk proses penyimpanan data --}}
                        <form action="{{ route('sungai.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-group mb-3">
                                <label for="name">Nama Sungai</label>
                                <input type="text" name="nama_sungai" class="form-control @error('name') is-invalid @enderror" id="">
                                @error('nama_sungai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             
                            
                            <div class="form-group mb-3">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control @error('content')
                                    is-invalid
                                @enderror" id="" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                            <div class="form-group mt-3">
                                   <a href="{{ route('sungai.index') }}" class="btn btn-info btn-sm">Kembali</a>
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

