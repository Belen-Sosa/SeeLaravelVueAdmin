<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
    use HasFactory;
    

    //un tipo de pregunta puede estaar en muchas preguntas 
    public function questions()
{
    return $this->hasMany(Question::class);
}
}
