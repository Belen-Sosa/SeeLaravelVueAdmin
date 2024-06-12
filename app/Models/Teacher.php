<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded=[];

     //una profesor puede tener varias materias
     public function subjects()
     {
         return $this->hasMany(Subject::class);
     }

     //un profesor puede estar en muchas carreras
    public function career()
    {
        return $this->belongsToMany(career::class);
    }

}
