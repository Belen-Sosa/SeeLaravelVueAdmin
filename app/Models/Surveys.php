<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

       //una encuesta puede tener muchas preguntas 
       public function question()
       {
           return $this->hasMany(Question::class);
       }

    //una encuesta puede tener muchos usuarios 
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    //una encuesta pertenece a una carrera 
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

     // una materia puede tener varias materias
     public function subject()
     {
     return $this->belongsToMany(Subject::class);
     }

}
