<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use App\Http\Requests\SurveyRequest;
use App\Models\Career;
use App\Models\Subject;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;


class SurveyController extends Controller
{   
    const NUMBER_OF_ITEMS_PER_PAGE= 25;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
   

           $surveys = Survey::with('career')
           ->with('subject')
           ->paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
           
       

       return Inertia('Surveys/index', [
           'surveys' => $surveys
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers= Career::all();
        $subjects= Subject::all();
        
        return inertia('Surveys/create',['subjects'=>$subjects,'careers'=>$careers]);
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(SurveyRequest $SurveyRequest)
    {   $data=$SurveyRequest->validated();
        Log::info('datos en el controller');
        Log::info($data);
        Survey::create( $data);

        return redirect()->route('surveys.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
    
        return inertia('Surveys/edit',['survey'=> $survey]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurveyRequest $SurveyRequest, Survey $survey)
    {
        $data=$SurveyRequest->validated();
        Log::info('datos en el controller');
        Log::info($data);
        Log::info('datos de la survey');
        Log::info($survey);
        $survey->update($data);
        return redirect()->route('surveys.index');
    }

    public function updateState( StateRequest $request, $id)
    
    {  
        $survey = Survey::findOrFail($id);
         Log::info('Entramos aquii');
        Log::info($survey);
        try {
        // Validar y actualizar el estado de la encuesta
        $validatedData = $request->validated();
       // $survey->estate = $validatedData['estate'];
       Log::info($validatedData);
     
       if( $survey->update(['estate' => $validatedData['estate']])){
            // Log para verificar si la solicitud está llegando al controlador
            Log::info('Estado actualizado correctamente');
       }else{
        Log::info('no se pudo, segui intentando');
       }
           

      

        return redirect()->route('surveys.index');
    } catch (\Exception $e) {
        // Manejo de errores si ocurre alguna excepción
        
        
        Log::error('Error al actualizar el estado de la encuesta: ' . $e->getMessage());
                
                
        // Puedes retornar un error o redirigir a una página de error
                
            
        return back()->withError('Error al actualizar el estado de la encuesta');
      }
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey )
    {
        $survey->delete();
        return redirect()->route('surveys.index');
    }
}
