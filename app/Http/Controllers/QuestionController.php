<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Survey;
use App\Models\TypeQuestion;

class QuestionController extends Controller
{

    
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        Question::create($request->validated());
       
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
          

           return inertia('Questions/index', ['survey_questions' => $survey_questions, 'type_questions'=> $type_questions]);

          
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request,$id)
    {

            $question = Question::findOrFail($id);
            
            $question->update($request->validated());
                    
            $survey_questions = Survey::with(['questions.typeQuestion'])
            ->findOrFail($question->survey_id);

            $type_questions = TypeQuestion::all();

            // Redirige o retorna a la vista show utilizando Inertia
            return inertia('Questions/index', [
            'survey_questions' => $survey_questions,
            'type_questions' => $type_questions
            ]);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {

        
        $question->delete();


    }
}
