<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
   
    public function show(string $id)
    {
    
        
        // Cargar la encuesta junto con sus preguntas y las opciones de cada pregunta
        $survey = Survey::with([ 'questions.options','questions.results'])->findOrFail($id);

    
        // Devolver los datos a la vista
        return inertia('Surveys/resultSurvey', ['data' => $survey]);
    }

}
