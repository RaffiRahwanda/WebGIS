<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HasilLaboratorium;
use App\Exports\HasilLaboratoriumExport;
use App\Imports\HasilLaboratoriumImport;
use App\Models\Space;
use App\Models\Bulan;

use App\Models\Sungai;
use Alert;
use Carbon\Carbon;
use Session;

class HasilLaboratoriumController extends Controller
{
    //
	public function apasaja($id){
        $tempat = Space::where('sungai_id',$id)->get();
        return response()->json($tempat);
    }

	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
	{
		 $title = 'Delete Data!';
			$text = "Are you sure you want to delete?";
			confirmDelete($title, $text);
		$user = $request->user();
		if($user->role=="Admin")
			$hasil = HasilLaboratorium::all();

		else {
			$hasil = HasilLaboratorium::where('status', 'Terkonfirmasi')->get();
			# code...
		}
		return view('hasilLaboratorium.index',['hasil'=>$hasil]);
	}

	public function showById(Request $request, $id){
		$user = $request->user();
		$hasil = HasilLaboratorium::where('user_id', $user->id )->get();
		return view('hasilLaboratorium.showbyid',['hasil'=>$hasil]);


	}
 
	public function export_excel()
	{
		return Excel::download(new  HasilLaboratoriumExport, 'hasillab.xlsx');
	}

     public function import_excel(Request $request) 
{
	// validasi
	$this->validate($request, [
		'file' => 'required|mimes:csv,xls,xlsx'
	]);
 
	// menangkap file excel
	$file = $request->file('file');
 
	// membuat nama file unik
	$nama_file = rand().$file->getClientOriginalName();
 
	// upload ke folder file_siswa di dalam folder public
	$file->move('file_hasil',$nama_file);
 
	// import data
	Excel::import(new HasilLaboratoriumImport, public_path('/file_hasil/'.$nama_file));
 
	// notifikasi dengan session
	Session::flash('sukses','Data Hasil Lab Berhasil Diimport!');
 
	// alihkan halaman kembali
	return redirect('/hasil_laboratorium');
}

	public function create(Request $request){

		$user = $request->user();

 		$messages = [

            'required' => 'Jangan kosong segera isi.'

        ];
 		$this->validate($request, [
             'space_id' => 'required',
            'sungai_id' => 'required:nullable',
            'bulan' => 'required',
            'tahun' => 'required',
            'tss' => 'required',
            'do' => 'required',
            'bod' => 'required',
            'cod' => 'required',
            'fosfat' => 'required',
            'fecal_coli' => 'required',
            'total_coliform' => 'required',
    
        ],$messages);
		$tambah =  new HasilLaboratorium;
		$tambah->space_id = $request->space_id;
		$tambah->user_id = $user->id;
		$tambah->sungai_id = $request->sungai_id;
		$tambah->bulan = $request->bulan;
		$tambah->tahun = $request->tahun;
		$tambah->tss = $request->tss;
		$tambah->do = $request->do;
		$tambah->bod = $request->bod;
		$tambah->cod = $request->cod;
		$tambah->fosfat = $request->fosfat;
		$tambah->fecal_coli = $request->fecal_coli;
		$tambah->total_coliform = $request->total_coliform;
		if($user->role == "Admin")
		{
			$tambah->status ='Terkonfirmasi';
		}
		$tambah->save();

		//  if ($tambah) {
            return back()->with('success', 'Data berhasil disimpan');
        // } else {
        //     return back()->with('error', 'Data gagal disimpan');
        // }

	}	

	public function add(){
		$data['bulans'] = Bulan::all();
		$data['data'] = Space::all();
		$data['data_sungai'] = Sungai::all();
		return view('hasilLaboratorium.create', $data );

	}

	
	public function edit($id){
		$data['hasil'] = HasilLaboratorium::find($id);
		return view('hasilLaboratorium.edit', $data);
	}

	public function updateHasil(Request $request,$id){
		 $current_timestamp = Carbon::now()->timestamp;
        $hasil =  HasilLaboratorium::find($id);
        $hasil->update($request->all());
    
         $hasil->updated_at =  $current_timestamp;
        $hasil->save();
        return redirect('/hasil_laboratorium');
	}
	
	public function update(Request $request,$id){
		$user = $request->user();
		 $current_timestamp = Carbon::now()->timestamp;
        $hasil =  HasilLaboratorium::find($id);
        $hasil->update($request->all());
    
         $hasil->updated_at =  $current_timestamp;
        $hasil->save();
        return redirect('/hasil_lab/'.$user->id);
	}

	

	public function deletes($id){
		$ad = HasilLaboratorium::find($id);
		$ad->delete($ad);
		 alert()->success('Hore!','Post Deleted Successfully');
		return redirect('/hasil_laboratorium');
	}


	public function formById($id){

		$data['data'] = HasilLaboratorium::find($id);
		return view('hasilLaboratorium.form_create',$data);
	}

	public function createByID(Request $request){
		$user =$request->user();
	$messages = [

				'required' => 'Jangan kosong segera isi.'

			];
			$this->validate($request, [
				'space_id' => 'required',
				'sungai_id' => 'required:nullable',
				'bulan' => 'required',
				'tahun' => 'required',
				'tss' => 'required',
				'do' => 'required',
				'bod' => 'required',
				'cod' => 'required',
				'fosfat' => 'required',
				'fecal_coli' => 'required',
				'total_coliform' => 'required',
		
			],$messages);
			$tambah =  new HasilLaboratorium;
			$tambah->space_id = $request->space_id;
			$tambah->user_id = $user->id;
			$tambah->sungai_id = $request->sungai_id;
			$tambah->bulan = $request->bulan;
			$tambah->tahun = $request->tahun;
			$tambah->tss = $request->tss;
			$tambah->do = $request->do;
			$tambah->bod = $request->bod;
			$tambah->cod = $request->cod;
			$tambah->fosfat = $request->fosfat;
			$tambah->fecal_coli = $request->fecal_coli;
			$tambah->total_coliform = $request->total_coliform;
			if($user->role == "Admin")
		{
			$tambah->status ='Telah di Konfirmasi';
		}
			$tambah->save();

			if ($tambah) {
				return redirect('/map/'.$request->slug)->with('success', 'Data berhasil disimpan');
			} else {
				return redirect('/map/'.$request->slug)->with('error', 'Data gagal disimpan');
			}
	}	


	public function editById($id){
		$data['hasil'] = HasilLaboratorium::find($id);
		return view('hasilLaboratorium.form_edit', $data);
	}


	public function updateById(Request $request,$id){
		 $current_timestamp = Carbon::now()->timestamp;
        $hasil =  HasilLaboratorium::find($id);
        $hasil->update($request->all());
    
         $hasil->updated_at =  $current_timestamp;
        $hasil->save();
        return redirect('/map/'.$request->slug);
	}


	public function deleteById($id){
		$ad = HasilLaboratorium::find($id);
		$ad->delete($ad);

		return back();
	}

	 public function updateStatus($id)
    {
        $hasil =  HasilLaboratorium::find($id);
         $hasil->update(['status' => "Terkonfirmasi"]);
        $hasil->save();
        return back();
    }

	public function editByHasil($id){
		$data['hasil'] = HasilLaboratorium::find($id);
		return view('hasilLaboratorium.form_edit_hasil', $data);
	}
}

