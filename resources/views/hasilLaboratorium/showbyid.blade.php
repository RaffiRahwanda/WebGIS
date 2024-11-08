@extends('layouts.app')

@section('style-css')
    {{-- load jquery datatable untuk menggunakannya --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">

@endsection

@section('content')
 <main class="py-4">
	
	
 
	<div class="container">
	
		<center>
			<h4>Hasil Laboratorium</h4>
		
		</center>
 
		{{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
        
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
						@if(auth()->user()->role == 'Admin')
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
			IMPORT EXCEL
		</button>
									@endif
 
		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/hasil_laboratorium/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">

							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
							</div>
							<div class="modal-body">
								
								{{ csrf_field() }}
								
								<label>Pilih file excel</label>
								<div class="form-group">
									<input type="file" name="file" required="required">
									</div>
									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Import</button>
										</div>
										</div>
										</form>
										</div>
										</div>
 
 
		
		@if(auth()->user()->role == 'Admin')
		<a href="/hasil_laboratorium/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
		@endif
		<a href="/create" class="btn btn-info my-3" target="_blank">TAMBAH DATA</a>

		<div class="panel-body">

			<div style="width: 100%; padding-left: -10px;">

				<div class="table-responsive">

					<table id="example" class="table table-striped table-bordered" style="width:100%">
						   <thead>
							   <tr>
								   <th>No</th>
									   <th>Nama Tempat</th>
									   <th>Nama Sungai</th>
								   
									   <th>Bulan</th>
									   <th>Tahun</th>
									   <th>TSS</th>
									   <th>DO</th>
									   <th>BOD</th>
									   <th>COD</th>
									   <th>Fosfat</th>
									   <th>Fecal Coli</th>
									   <th>Total Coliform</th>
									   <th>Kualitas Air</th>


									   @if(auth()->user()->role == 'Admin')
									   <th>Aksi</th>
									   <th>Aksi</th>
									   @endif
									   <th>Status</th>
							   </tr>
						   </thead>
						   <tbody>
								   @php $i=1 @endphp
								   @foreach($hasil as $h)
								   <tr>
									   <td>{{ $i++ }}</td>
									   <td>{{$h->getData?->name}}</td>
									   <td>{{$h->getNameSungai->nama_sungai}}</td>
								   
									   <td>{{$h->bulan}}</td>
									   <td>{{$h->tahun}}</td>
									   <td>{{$h->tss}}</td>
									   <td>{{$h->do}}</td>
									   <td>{{$h->bod}}</td>
									   <td>{{$h->cod}}</td>
									   <td>{{$h->fosfat}}</td>
									   <td>{{$h->fecal_coli}}</td>
									   <td>{{$h->total_coliform}}</td>
									   <td>{{$h->kualitas_air}}</td>

				   
									   @if(auth()->user()->role == 'Admin')
				   
										<td><a class="btn btn-warning btn-sm" href="/edit/{{$h->id_hasil}}"  >Edit</a></td>
										<td><a class="btn btn-danger btn-sm" href="/hapus/{{$h->id_hasil}}" onclick="return confirm('Yakin mau dihapus?')">Hapus</a></td>
									   
									   @endif
									   <td>{{$h->status}}</td>
								   </tr>
								   @endforeach
						   </tbody>
						
					   </table>
				</div>
			</div>
		</div>
		
		
	</div>
</main>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
		$('#example').DataTable({
            lengthMenu: [10, 25, 50, 75, 100,200,500],
            responsive: true,
			'rowCallback' : function(row, data, index){
				if(data[12] == "Tercemar"){
					$(row).find('td:eq(12)').css('background-color', '#e50000');
				}
				else{
					 $(row).find('td:eq(12)').css('background-color', '#73c576');
				}
				
			}
        });
	</script>
	
</@endsection