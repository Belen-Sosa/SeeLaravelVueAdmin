<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $guarded=[];
    //una carrera puede tener varias inscripciones 
    public function registration()
    {
        return $this->hasMany(Registration::class);
    }
    //una carrera puede tener varias encuestas
    public function survey()
    {
        return $this->hasMany(Survey::class);
    }
       //una carrera puede tener varios usuarios 
       public function user()
       {
           return $this->hasMany(User::class);
       }
      

     //una carrera puede tener muchas materias 
    public function subjectS()
    {
        return $this->hasMany(Subject::class);
    }


      //una carrera puede tener muchos profesores 
      public function teacher()
      {
          return $this->belongsToMany(teacher::class);
      }
  
}
