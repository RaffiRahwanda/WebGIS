<?php

namespace App\Exports;

use App\Models\HasilLaboratorium;
use Maatwebsite\Excel\Concerns\FromCollection;

class HasilLaboratoriumExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HasilLaboratorium::all();
    }
}
