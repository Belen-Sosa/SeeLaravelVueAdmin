<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded=[];

    //un resultado pertenece a una opcion
    public function option(){
        return $this->belongsTo(Option::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
