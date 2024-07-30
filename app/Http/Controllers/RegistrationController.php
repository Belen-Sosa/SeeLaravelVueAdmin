<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_register( $user_id,$career_id, $subject_id )
    {
        Registration::create([
            'career_id' =>$career_id,
            'subject_id' => $subject_id,
            'user_id' => $user_id,
                ]);
    }

   
}
