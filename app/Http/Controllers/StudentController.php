<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
     //paginando el numero de lecciones 
     const NUMBER_OF_ITEMS_PER_PAGE= 25;
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
          // Obtener el rol "estudiantes"
          $role = Role::where('name', 'student')->first();

              // Verificar si el rol existe
             if ($role) {

                $students = User::role('student')
                    ->with('career')
                    ->paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
                }
            
    
            return Inertia('Students/index', [
                'students' => $students
            ]);
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $careers= Career::all();
        
        return inertia('Students/create',['role'=>'student','careers'=>$careers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $UserRequest)
    {
        //esto obtiene los datos validados del 'UserRequest'
        $validatedData = $UserRequest->validated();
        //encriptamos la contraseña antes del guardado
        $validatedData['password'] = Hash::make($validatedData['password']);

        //creamos el usuario 
           User::create(  $validatedData )->assignRole('student');

    

        return redirect()->route('students.index');
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
    public function edit(User $student )
    {
    
        $careers= Career::all();
        return inertia('Students/edit',['student'=> $student,'careers'=>$careers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
