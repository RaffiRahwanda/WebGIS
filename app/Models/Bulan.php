<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    use HasFactory;

     protected $table="bulans";
    protected $primaryKey = 'id_bulan';
    protected $fillable = [
        "id_bulan",
        "nama_bulan",
    ];

    
}
