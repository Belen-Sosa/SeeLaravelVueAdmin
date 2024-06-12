<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $guarded=[];

    //una opcion puede pertenecer a solo una pregunta 

    public function question(){
        
        return $this->belongsTo(Question::class);
    }


     //una opcion puede tener varios resultados 
     public function result()
     {
         return $this->hasMany(Result::class);
     }
}
