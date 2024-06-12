<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded=[];

     //una pregunta puede tener muchas opciones 
    public function option()
{
    return $this->hasMany(Option::class);
}

//un pregunta solo pertenece a un tipo de pregunta

public function typeQuestion(){
        
    return $this->belongsTo(TypeQuestion::class);
}

//una pregunta pertenece a una encuesta
public function survey(){
    return $this->belongsTo(Survey::class);
}
}