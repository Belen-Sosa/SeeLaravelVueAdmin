<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Models\Result;
use App\Models\Survey;
use Illuminate\Http\Request;


class ApiSurveyController extends Controller
{
        public function index($id)
    {
        // Obtener las encuestas que el usuario no tiene registradas en la tabla survey_user
        $surveys = Survey::where('estate', 1)
            ->whereDoesntHave('users', function ($query) use ($id) {
                $query->where('id_user', $id);
            })
            ->with('subject')
            ->get();

        return response()->json($surveys, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(ResultRequest $request)
    {
           Result::create($request->all()); 
           return response()->json([
            'succes'=> true
           ]);
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Cargar la encuesta junto con sus preguntas y las opciones de cada pregunta
         $survey = Survey::with(['career', 'subject', 'questions.options'])->findOrFail($id);
         return response()->json($survey,200);
    }

  

   
}
