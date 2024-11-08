<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\HasilLabPieChart;
use App\Models\HasilLaboratorium;
use Carbon\Carbon;

class HomeController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    ///harus login saat akess menggunakan auth construct
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(HasilLabPieChart $hasil)

    public function index()
    {
         $now = Carbon::now();
        $charts = [];
        for ($year = 2019; $year <= $now->year; $year++) {
            $charts[$year] = $this->getChartData($year);
        }
        // $tahun = DB::table('hasil_lab')->select('tahun')->groupBy('tahun')->get();

        return view('home', compact('charts'));
        // return view('home', ['hasil' => $hasil->build(), 'hasil1' =>$hasil->build1(),'hasil2' => $hasil->build2()]);
        
    }


     private function getChartData($year)
    {
        $hasil = HasilLaboratorium::where('tahun', $year)->orderBy('bulan')->get();
          $tss=[];
        $do = [];
        $bod = [];
        $cod = [];
        $fosfat = [];
        $fecal_coli = [];
        $total_coliform = [];
        $labels = [];
         foreach ($hasil as $hasil) {
            $tss[] = (float) $hasil->tss;
            $do[] = (float) $hasil->do;  
            $bod[] = (float) $hasil->bod;
            $cod[] = (float) $hasil->cod; 
            $fosfat[] = (float) $hasil->fosfat; 
            $fecal_coli[] = $hasil->fecal_coli; 
            $total_coliform[] = $hasil->total_coliform; 

            $labels[] = $hasil->space_id;
        }
         return [
            'year' => $year,
            'tss'=>$tss,
            'do'=>$do,
            'bod'=>$bod,
            'cod' => $cod,
            'fosfat' => $fosfat,
            'fecal_coli' => $fecal_coli,
            'total_coliform' => $total_coliform,

            'labels' => $labels,
            
        ];


        }
}
