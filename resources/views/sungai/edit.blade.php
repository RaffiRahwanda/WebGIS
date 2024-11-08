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
    @section('content')
    <main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded">
                    <div class="card-header">Edit Sungai</div>
                    <div class="card-body">
                        <form action="{{ route('sungai.update',$sungai) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Nama Sungai</label>
                                <input type="text" name="nama_sungai" value="{{ $sungai->nama_sungai}}" class="form-control @error('nama_sungai') is-invalid @enderror" id="">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            <div class="form-group mb-3">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control @error('keterangan')
                                    is-invalid
                                @enderror" id="" cols="30" rows="10" placeholder="Deskripsi">{{ $sungai->keterangan }}</textarea>
                                @error('keterangan')
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

