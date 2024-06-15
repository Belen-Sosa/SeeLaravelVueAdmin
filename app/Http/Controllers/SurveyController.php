<?php

namespace App\Http\Controllers;

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
    public function destroy(Survey $survey )
    {
        $survey->delete();
        return redirect()->route('surveys.index');
    }
}
