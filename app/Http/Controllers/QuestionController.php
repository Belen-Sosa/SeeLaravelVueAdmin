<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Survey;
use App\Models\TypeQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        Log::info('datos de la survey y sus questions en la Store');
        Log::info($request);
        Question::create($request->validated());
          // Encuentra la encuesta por el ID proporcionado y la devuelve con sus preguntas
          $survey_questions = Survey::with('questions.typeQuestion')
          ->findOrFail($request->survey_id);

          $type_questions= TypeQuestion::all();
          return inertia('Questions/index', ['survey_questions' => $survey_questions, 'type_questions'=> $type_questions]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $survey_id)
    {
           // Encuentra la encuesta por el ID proporcionado y la devuelve con sus preguntas
           $survey_questions = Survey::with(['questions.typeQuestion'])
           ->findOrFail($survey_id);

           $type_questions= TypeQuestion::all();
          /* Log::info('datos de la survey y sus questions en la survey_questions');
           Log::info($survey_questions);

           */

           return inertia('Questions/index', ['survey_questions' => $survey_questions, 'type_questions'=> $type_questions]);

          
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Question $question)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request,$id)
    {

        Log::info('datos de la question ');

        $question = Question::findOrFail($id);
           Log::info($question);

           Log::info("datos del request");
           Log::info($request);
        $question->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
