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
                 @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                <div class="card rounded">

                    <div class="card-header">Tambah Hasil Lab</div>
                    <div class="card-body">
                        {{-- action form yang mengarah ke route space.store untuk proses penyimpanan data --}}
                        <form action="/tambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="sungai_id">Nama Sungai</label>
                                <select class="form-select" name="sungai_id" id="sungai">
                                    <option value="0">--Pilih Sungai--</option>
                                    @foreach($data_sungai as $sungai)
                                    <option  value="{{$sungai->id_sungai}}">{{$sungai->nama_sungai}}</option>
                                    @endforeach
                                </select>
                                @error('sungai_id' == 0)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="space_id">Nama Tempat</label>
                                <select class="form-select" name="space_id" id="tempat">
                                   
                                </select>
                                @error('space_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label for="bulan">Bulan</label>
                                <select class="form-select" name="bulan" id="">
                                    @foreach($bulans as $datas)
                                    <option  value="{{$datas->nama_bulan}}">{{$datas->nama_bulan}}</option>
                                    @endforeach
                                </select>
                                
                                @error('bulan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="">
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for="tss">Total suspended solid (TSS)</label>
                                <input type="number" name="tss" class="form-control @error('tss') is-invalid @enderror" id="">
                                @error('tss')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="do">Oksigen terlarut (DO)</label>
                                <input type="number" name="do" class="form-control @error('do') is-invalid @enderror" id="">
                                @error('do')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label for="">BOD</label>
                                <input type="number" name="bod" class="form-control @error('bod') is-invalid @enderror" id="">
                                @error('bod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">COD</label>
                                <input type="number" name="cod" class="form-control @error('cod') is-invalid @enderror" id="">
                                @error('cod')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Fosfat</label>
                                <input type="number" name="fosfat" class="form-control @error('fosfat') is-invalid @enderror" id="">
                                @error('fosfat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                             <div class="form-group mb-3">
                                <label for=""> Bakteri Coli Tinja (Fecal Coli)</label>
                                <input type="number" name="fecal_coli" class="form-control @error('fecal_coli') is-invalid @enderror" id="">
                                @error('fecal_coli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="form-group mb-3">
                                <label for=""> Total Coliform</label>
                                <input type="number" name="total_coliform" class="form-control @error('total_coliform') is-invalid @enderror" id="">
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
                                <a href="{{ url()->previous() }}" class="btn btn-info btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

<script>
    $(document).ready(function() {
        $('#sungai').on('change', function() {
            var kode_sungai = $(this).val();
            // console.log(kode_sungai); 
            if (kode_sungai) {
                $.ajax({
                    url: '/apasaja/' + kode_sungai,
                    type: 'GET',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function(data){
                        // console.log(data);
                        if(data) {
                            $('#tempat').empty();
                            $('#tempat').append('<option value=" "> --Pilih Tempat-- </option>');
                            $.each(data, function(key, tempat){
                                $('select[name="space_id"]').append(
                                    '<option value="'+tempat.id+'">' + tempat.name + '</option>'
                                );
                            });
                        }
                        else{
                            $('tempat').empty();
                        }
                    }
                })
            }
            else{
                            $('tempat').empty();

            }
        })
    })
</script>

@endsection

