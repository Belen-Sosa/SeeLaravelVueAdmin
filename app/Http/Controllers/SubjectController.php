<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Career;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    //paginando el numero de lecciones 
    const NUMBER_OF_ITEMS_PER_PAGE= 25;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

        $subjects = Subject::with(['career', 'teacher'])->paginate(self::NUMBER_OF_ITEMS_PER_PAGE); // Cambia 10 por el número de elementos que deseas por página


       return Inertia('Subjects/index', [
           'subjects' => $subjects
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $teachers= Teacher::all();
         $careers= Career::all();
         return inertia('Subjects/create',['teachers'=>$teachers,'careers'=>$careers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        
        Subject::create($request->validated());
        return redirect()->route('subjects.index');
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
    public function destroy(string $id)
    {
        //
    }
}
