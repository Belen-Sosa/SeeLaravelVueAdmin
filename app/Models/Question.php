<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'survey_id',
        'title',
        'type_question_id',
      
    ];

     //una pregunta puede tener muchas opciones 
    public function option()
{
    return $this->hasMany(Option::class);
}

//un pregunta solo pertenece a un tipo de pregunta

public function typeQuestion(){
        
    return $this->belongsTo(TypeQuestion::class, 'type_question_id');
}

//una pregunta pertenece a una encuesta
public function survey(){
    return $this->belongsTo(Survey::class);
}
}