<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
     protected $guarded = [];
     protected $table = 'spaces';
        protected $primaryKey = 'id';
       protected $fillable = [
        'id',
        'sungai',
        'name',
        'slug',
        'image',
        'location',
        'content'
        
    ];

    public function getImage()
    {
        if (substr($this->image, 0, 5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('/uploads/imgCover/' . $this->image);
        }

        return 'https://via.placeholder.com/500x500.png?text=No+Cover';
    }

    public function getNameSungais(){

        return $this->belongsTo(Sungai::class, 'sungai_id');
    }
}
