<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Models\Result;
use App\Models\Survey;
use Illuminate\Http\Request;


class ApiSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $surveys= Survey::all();
       
       return response()->json($surveys,200);
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
