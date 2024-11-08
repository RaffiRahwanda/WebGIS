<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CentrePoint;
use App\Models\Space;
use App\Models\Sungai;

use Illuminate\Http\Request;

use DataTables;
class DataController extends Controller
{
   
    public function centrepoint()
    {
        // Method ini untuk menampilkan data centrepoint atau koordinat
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $centrepoint = CentrePoint::orderBy('created_at', 'DESC');
        return  datatables()->of($centrepoint)
        ->addColumn('action', 'centrepoint.action')
         ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function spaces()
    {
        // Method ini untuk menampilkan data dari tabel spaces
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $spaces = Space::orderBy('created_at','DESC');
        return  datatables()->of($spaces)
        ->addColumn('action','space.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }

      public function sungai()
    {
        // Method ini untuk menampilkan data dari tabel spaces
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $sungai = Sungai::orderBy('created_at','DESC');
        return  datatables()->of($sungai)
        ->addColumn('action','sungai.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }

  
}