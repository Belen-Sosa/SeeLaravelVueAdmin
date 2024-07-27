<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded=[];

    //una inscripcion pertenece a una carrera
    public function career(){
        return $this->belongsTo(Career::class);
    }
    
    //una incripcion pertenece a un usuario 
    public function user(){
        return $this->belongsTo(User::class);
    }

  
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
