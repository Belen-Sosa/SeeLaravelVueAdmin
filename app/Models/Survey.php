<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    


    protected $fillable = [
        'user_id',
        'title',
        'career_id',
        'subject_id',
        'description',
        'estate',
        'start_date',
        'final_date',
    ];
       //una encuesta puede tener muchas preguntas 
       public function questions()
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
