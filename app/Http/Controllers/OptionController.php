<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
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
    public function store(OptionRequest $request)
    {
        Log::info('datos de option en la Store');
        Log::info($request);
        Option::create($request->validated());
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Encuentra la question por el ID proporcionado y la devuelve con sus options
        $question = Question::with(['options'])
        ->findOrFail($id);

       
        Log::info('datos de la question y sus options');
        Log::info($question);

       
        return inertia('QuestionsOptions/index', ['question' => $question]);
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
    public function update(OptionRequest $request, Option $option)
    {
        Log::info('datos de la option ');

           Log::info($option);

           Log::info("datos del request");
           Log::info($request);
        $option->update($request->validated());


  /*// Encuentra la question por el ID proporcionado y la devuelve con sus options
  $question = Question::with(['options'])
  ->findOrFail($option-> question_id);

  return inertia('QuestionsOptions/index', ['question' => $question]);
*/


                    
            

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
   
    }
}
