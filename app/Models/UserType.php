<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $guarded=[];

    //un tipo de usuario puede estar en varios usuarios 
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
