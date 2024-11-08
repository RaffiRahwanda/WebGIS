<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilLaboratorium;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function index()
    {
        // Ambil daftar kategori dan tahun unik dari tabel Sale
        $categories = HasilLaboratorium::select('space_id')->distinct()->orderBy('space_id')->get();
        $years = HasilLaboratorium::select('tahun')->distinct()->orderBy('tahun')->get();

        // Ambil semua data yang diperlukan
        $allData = $this->getAllData();

        return view('charts', compact('categories', 'years', 'allData'));
    }

    private function getAllData()
    {
        // Nama bulan dalam bahasa Indonesia
        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Ambil semua data penjualan dari database
        $sales = HasilLaboratorium::orderBy('space_id')->orderBy('tahun')->get();

        // Inisialisasi array untuk data terstruktur
        $data = [];

        foreach ($sales as $sale) {
            $year = ($sale->tahun);
            // $month = date('n', strtotime($sale->date));

              $data[$sale->space_id][$year]['tss'][] = (float) $sale->tss;
            $data[$sale->space_id][$year]['do'][] = (float) $sale->do;  
          $data[$sale->space_id][$year]['bod'][] = (float) $sale->bod;
            $data[$sale->space_id][$year]['cod'][] = (float) $sale->cod; 
             $data[$sale->space_id][$year]['fosfat'][] = (float) $sale->fosfat; 
             $data[$sale->space_id][$year]['fecal_coli'][] = $sale->fecal_coli; 
            $data[$sale->space_id][$year]['total_coliform'][] = $sale->total_coliform; 

                 $data[$sale->space_id][$year]['labels'][] = $sale->bulan;
          
        }

        // Pastikan setiap label adalah unik
        foreach ($data as $category => $years) {
            foreach ($years as $year => $info) {
                $data[$category][$year]['labels'] = $info['labels'];
            }
        }

        return $data;
    }
}
