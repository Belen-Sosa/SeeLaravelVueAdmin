<?php

namespace App\Http\Controllers;

use App\Models\Registration;


class RegistrationController extends Controller
{
   
    
    public function create_register( $user_id,$career_id, $subject_id )
    {
        Registration::create([
            'career_id' =>$career_id,
            'subject_id' => $subject_id,
            'user_id' => $user_id,
        ]);
    }

   
}
