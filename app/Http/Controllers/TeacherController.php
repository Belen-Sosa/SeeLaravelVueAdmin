<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        define('NUMBER_OF_ITEMS_PER_PAGE',25);
        $teachers= Teacher::paginate(NUMBER_OF_ITEMS_PER_PAGE);
        return inertia('Teachers/index',['teachers'=>$teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Teachers/create');
    }

    /**
     * Store a newly created resource in storage.
     * @param App\Http\Request\TeacherRequest
     */
    public function store(TeacherRequest $request)
    {
        Teacher::create($request->validated());
        return redirect()->route('teachers.index');
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
    public function edit(Teacher $teacher)
    {
        return inertia('Teachers/edit',['teacher'=> $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index');
    }
}
