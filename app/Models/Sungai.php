<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sungai extends Model
{
    use HasFactory;
    protected $guarded = [];
     protected $table = 'sungai';
        protected $primaryKey = 'id_sungai';
       protected $fillable = [
        'id_sungai',
        'nama_sungai',
        'keterangan',
     
        
    ];
}
