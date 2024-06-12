<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded= [];

    //una materia puede estar en muchas inscripciones 
    public function registration()
    {
        return $this->belongsToMany(Registration::class);
    }

     //una materia puede pertenecer a un profesor
     public function teacher()
     {
         return $this->belongsTo(Teacher::class);
     }

    // una materia puede pertenecer a una carrera
    public function career()
    {
    return $this->belongsTo(Career::class);
    }

     // una materia puede estar en muchas encuestas
     public function survey()
     {
     return $this->belongsToMany(Survey::class);
     }
}
