<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Space;
use App\Models\User;
use App\Models\Sungai;


class HasilLaboratorium extends Model
{
    use HasFactory;
    protected $table="hasil_lab";
    protected $primaryKey = 'id_hasil';
    protected $fillable = [
        
        'space_id',
        'user_id',
        'sungai_id',
        'bulan',
        'tahun',
        'tss',
        'do',
        'bod',
        'cod',
        'fosfat',
        'fecal_coli',
        'total_coliform',
        'kualitas_air',
        'status'
        
    ];


    public function getData(){

        return $this->belongsTo(Space::class, 'space_id');
    }

    public function getNameSungai(){

        return $this->belongsTo(Sungai::class, 'sungai_id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
