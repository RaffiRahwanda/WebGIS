<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentrePoint;
use App\Models\Sungai;
use App\Models\HasilLaboratorium;

use Illuminate\Support\Str;
class SungaiController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        // Menampilkan data dari tabel space
        return view('sungai.index');
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
       
        return view('sungai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        $this->validate($request, [
             'nama_sungai' => 'required',
        ]);

        $sungai = new Sungai;
    
        $sungai->nama_sungai = $request->input('nama_sungai');
        $sungai->keterangan = $request->input('keterangan');
        $sungai->created_at = now();
        $sungai->updated_at = null;

        //return dd($spaces);

        // proses simpan data
        $sungai->save();

        // redirect ke halaman index space
        if ($sungai) {
            return redirect()->route('sungai.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('sungai.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['hasil'] = HasilLaboratorium::where('sungai_id', $id)->get();
        return view('sungai.hasilsungai',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sungai $sungai)
    {
    
        $sungai = Sungai::findOrFail($sungai->id_sungai);
        return view('sungai.edit', [
            'sungai' => $sungai
        ]);
    }


    public function hasilBySungai($id){
        $data['hasil'] = HasilLaboratorium::where('sungai_id', $id)->get();
        return view('sungai.hasilsungai', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sungai $sungai)
    {
        // Menjalankan validasi
        $this->validate($request, [
            'nama_sungai' => 'required',
            'keterangan' => 'required',
        
        ]);

        
        $sungai = Sungai::findOrFail($sungai->id_sungai);
       
        // Lakukan Proses update data ke tabel space
        $sungai->update([
            'nama_sungai' => $request->nama_sungai,
            'keterangan' => $request->keterangan,
          
        ]);
       
        // redirect ke halaman index space
        if ($sungai) {
            return redirect()->route('sungai.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('sungai.index')->with('error', 'Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $sungai = Sungai::findOrFail($id);
        $hasil_lab = HasilLaboratorium::where('sungai_id', $id)->get()->each->delete();  
        $sungai->delete();
          return redirect()->route('sungai.index');
        
    }
}
