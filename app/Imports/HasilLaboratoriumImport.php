<?php

namespace App\Imports;

use App\Models\HasilLaboratorium;
use Maatwebsite\Excel\Concerns\ToModel;

class HasilLaboratoriumImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HasilLaboratorium([
            'user_id' => $row[1],
            'space_id' => $row[2],
            'sungai_id' => $row[3],
            'bulan' => $row[4],
            'tahun' => $row[5],
            'tss' => $row[6], 
            'do' => $row[7], 
            'bod' => $row[8], 
            'cod' => $row[9], 
            'fosfat' => $row[10], 
            'fecal_coli' => $row[11], 
            'total_coliform' => $row[12], 
  
        ]);
    }


    
   
}
