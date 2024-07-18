<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results= Result::all();
       
        return response()->json($results,200);
    }

 

    public function store(ResultRequest $request)
    {
        Log::info('Entramos en STORE');
    
        // Obtener todas las respuestas del request
        $data = $request->validated();
        Log::info($data);
    
        // Procesar los datos y guardarlos en la base de datos
        foreach ($data as $questionId => $responses) {
            foreach ($responses as $response) {
                Result::create([
                    'question_id' => $response['question_id'],
                    'option_id' => $response['option_id'],
                    'text' => $response['text'],
                ]);
            }
        }
    
        return response()->json([
            'success' => true
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Result::find($id);
       
        return response()->json($result,200);
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
