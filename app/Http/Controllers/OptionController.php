<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    
    
    public function store(OptionRequest $request)
    {
     
        Option::create($request->validated());
        

    }

   
    public function show(string $id)
    {
        // Encuentra la question por el ID proporcionado y la devuelve con sus options
        $question = Question::with(['options'])
        ->findOrFail($id);
       
        return inertia('QuestionsOptions/index', ['question' => $question]);
    }

    
    
    public function update(OptionRequest $request, Option $option)
    {
        $option->update($request->validated());                       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
   
    }
}
