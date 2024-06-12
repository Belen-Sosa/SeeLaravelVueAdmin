<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\CareerRequest;

class CareerController extends Controller
{
    const NUMBER_OF_ITEMS_PER_PAGE = 25;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $careers= Career::paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
        return inertia('Careers/index',['careers'=>$careers]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Careers/create');
    }

    /**
     * Store a newly created resource in storage.
     *   @param App\Http\Request\CareerRequest
     */
 
    public function store(CareerRequest $request)
    {
        Career::create($request->validated());
        return redirect()->route('careers.index');
        //
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
    public function edit(Career $career)
    {
        return inertia('Careers/edit',['career'=> $career]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(CareerRequest $request,  Career $career)
    {
        $career->update($request->validated());
        return redirect()->route('careers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index');
    }
}
