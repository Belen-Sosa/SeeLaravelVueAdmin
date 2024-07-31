<?php

namespace App\Http\Controllers;
use App\Http\Requests\StateRequest;
use App\Http\Requests\SurveyRequest;
use App\Models\Career;
use App\Models\Survey;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SurveyController extends Controller
{
    const NUMBER_OF_ITEMS_PER_PAGE = 25;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        // Obtener la fecha actual
        $now = Carbon::now();

        // Obtener las encuestas que tienen estado 1 y la fecha final es mayor que la actual
        $surveysToUpdate = Survey::where('final_date', '<', $now)
            ->get();


        // Actualizar el estado de las encuestas
        foreach ($surveysToUpdate as $survey) {
            $survey->estate = 0;
            $survey->save();
        }

        $surveys = Survey::with('career')
            ->with('subject')
            ->paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
        // Obtener el mensaje de la consulta de la URL si existe
        $message = $request->query('message', '');

        return Inertia('Surveys/index', [
            'surveys' => $surveys,
            'message' => $message

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers = Career::all();
        $subjects = Career::with('subjects')->get();

        return inertia('Surveys/create', ['subjects' => $subjects, 'careers' => $careers]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(SurveyRequest $SurveyRequest)
    {
        $data = $SurveyRequest->validated();

        Survey::create($data);
        return redirect()->route('surveys.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // Cargar la encuesta junto con sus preguntas y las opciones de cada pregunta
        $survey = Survey::with(['career', 'subject', 'questions.options'])->findOrFail($id);


        // Devolver los datos a la vista
        return inertia('Surveys/showSurvey', ['survey' => $survey]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {

        return inertia('Surveys/edit', ['survey' => $survey]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurveyRequest $SurveyRequest, Survey $survey)
    {
        $data = $SurveyRequest->validated();
        $survey->update($data);
        return redirect()->route('surveys.index');
    }

    public function updateState(StateRequest $request, $id)

    {
        $survey = Survey::findOrFail($id);

        try {
            // Validar y actualizar el estado de la encuesta
            $validatedData = $request->validated();
            $newState = $validatedData['estate'];
            $currentDate = Carbon::now();

            // Verificar si la fecha final es menor que la fecha actual
            if ($survey->final_date < $currentDate && $newState == 1) {
                $message = "No se puede actualizar el estado a 'PUBLIBA' porque la fecha final es menor a la fecha actual.";
            } else {
                // Actualizar el estado si la validación pasa
                if ($survey->update(['estate' => $newState])) {
                    $message = "Estado actualizado correctamente";
                } else {
                    $message = "Error al intentar actualizar el estado, pruebe cambiar la Fecha Final";
                }
            }

            return redirect()->route('surveys.index', ['message' => $message]);
        } catch (\Exception $e) {
            // Manejo de errores si ocurre alguna excepción

            return back()->withError('Error al actualizar el estado de la encuesta');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index');
    }
}
