<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentrePoint;
use App\Models\Space;
use App\Models\HasilLaboratorium;
use App\Charts\HasilLabPieChart;
use DB;
class MapController extends Controller
{
    public function index()
    {
        $centrePoint = CentrePoint::get()->first();
        $spaces = Space::get();
      
        // $hasil_lab =
        //  DB::table('hasil_lab')
        //   ->join('space', 'hasil_lab.space_id', '=', 'space.id')->
        //     // HasilLaboratorium::
        //     whereDate('created_at', '=', DB::raw("(SELECT DATE(created_at) FROM hasil_lab LIMIT 1)"))
        //     ->orderBy('id_hasil')
        //     ->get();

             $hasil_lab =
         DB::table('hasil_lab')
          ->join('spaces', 'hasil_lab.space_id', '=', 'spaces.id')
          
            // HasilLaboratorium::
          ->whereDate('hasil_lab.created_at', '=', DB::raw("(SELECT DATE(created_at) FROM hasil_lab LIMIT 1)"))
            ->select('hasil_lab.*', 'spaces.location as locations', 'spaces.name as names', 'spaces.image as images', 'spaces.slug as slugs') // Misalnya, 'name' adalah kolom di tabel 'space'
            // ->select('hasil_lab.*', 'spaces.name as names') // Misalnya, 'name' adalah kolom di tabel 'space'

            // ->select('hasil_lab.*', 'spaces.image as images') // Misalnya, 'name' adalah kolom di tabel 'space'
            // ->select('hasil_lab.*', 'spaces.slug as slugs') // Misalnya, 'name' adalah kolom di tabel 'space'


            ->orderBy('hasil_lab.id_hasil')
            ->get();
        // $hasil_lab =  HasilLaboratorium::whereDate('created_at', '=', function($query) {
        //             $query->selectRaw('DATE(created_at)')
        //                   ->from('hasil_lab')
        //                   ->limit(1);
        //         })
        //         ->orderBy('id_hasil');
// dd($hasil_lab);
        return view('map',[
            'hasil_lab' => $hasil_lab,
            'spaces' => $spaces,
            'centrePoint' => $centrePoint
        ]);
        //return dd($spaces);
    }

    public function show(Request $request,$slug,HasilLabPieChart $hasil1 )
    {
        $categories = HasilLaboratorium::select('space_id')->distinct()->orderBy('space_id')->get();
        $years = HasilLaboratorium::select('tahun')->distinct()->orderBy('tahun')->get();
        $allData = $this->getAllData();
            $user = $request->user();
            $tahun = DB::table('hasil_lab')->select('tahun')->groupBy('tahun')->get();
            $centrePoint = CentrePoint::get()->first();
            $spaces = Space::where('slug',$slug)->first();
            if($user){
            	if($user->role=="Admin")
                  $hasil = HasilLaboratorium::where('space_id', $spaces->id)->get();
                  else {
                    $hasil = HasilLaboratorium::where('space_id', $spaces->id)->where('status', 'Terkonfirmasi')->get();
                  }
            }
            else{
                    $hasil = HasilLaboratorium::where('space_id', $spaces->id)->where('status', 'Terkonfirmasi')->get();

            }
            return view('detail',compact(
                'centrePoint',
                'spaces',
                'hasil',
                'tahun',
                'categories', 'years', 'allData'
            )
          ); 
    }



    private function  getAllData()
    {
       
       $sales = HasilLaboratorium::orderBy('space_id')->orderBy('tahun')->get();
        $data = [];
        foreach ($sales as $sale) {
            $year = ($sale->tahun);
              $data[$sale->space_id][$year]['tss'][] = (float) $sale->tss;
              $data[$sale->space_id][$year]['do'][] = (float) $sale->do;  
              $data[$sale->space_id][$year]['bod'][] = (float) $sale->bod;
              $data[$sale->space_id][$year]['cod'][] = (float) $sale->cod; 
              $data[$sale->space_id][$year]['fosfat'][] = (float) $sale->fosfat; 
              $data[$sale->space_id][$year]['fecal_coli'][] = $sale->fecal_coli; 
              $data[$sale->space_id][$year]['total_coliform'][] = $sale->total_coliform; 
              $data[$sale->space_id][$year]['labels'][] = $sale->bulan;
          
        }
        foreach ($data as $category => $years) {
            foreach ($years as $year => $info) {
                $data[$category][$year]['labels'] = $info['labels'];
            }
        }
        return $data;
        }
}
