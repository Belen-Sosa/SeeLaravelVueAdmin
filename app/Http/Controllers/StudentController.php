<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Career;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
        $subjects= Career::with('subjects')->get();
        
        return inertia('Students/create',['role'=>'student','careers'=>$careers,'subjects'=>$subjects]);
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
        $user = User::create(  $validatedData )->assignRole('student');

          
         
          if($user->id){
            $userId = $user->id;

            foreach ($UserRequest['subjects'] as $subject_id) {
                 Registration::create([
                            'career_id' => $validatedData['career_id'],
                            'subject_id' => $subject_id,
                            'user_id' => $userId,
                 ]);
            }

          }

        return redirect()->route('students.index');
    }

   

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit(User $student )
    {
    
        $careers= Career::all();
       
        $subjects= Career::with('subjects')->get();
                // Obtener las inscripciones del estudiante con las asignaturas relacionadas
            $registrations = Registration::
            where('user_id', $student->id)
            ->get(); // Asegúrate de llamar a get() para ejecutar la consulta y obtener los datos



        
        return inertia('Students/edit',['student'=> $student,'careers'=>$careers, 'subjects'=>$subjects, 'registrations'=> $registrations]);
    }
/**
     * Show the form for editing the specified resource.
     *  public function editSubjects(User $student )
     */ 
    public function editSubjects($id)
{
    // Obtén la información del estudiante con su carrera relacionada
    $student = User::with('career')->findOrFail($id);

    // Obtén todas las materias de la carrera del estudiante
    $career = Career::with('subjects')->findOrFail($student->career_id);

    // Obtén las inscripciones del estudiante con las materias relacionadas
    $registrations = Registration::with('subject')
        ->where('user_id', $student->id)
        ->get();


    // Obtener los IDs de las materias en las que el estudiante está inscrito
    $registeredSubjectIds = $registrations->pluck('subject.id')->toArray();

    // Filtrar las materias de la carrera excluyendo las que ya están registradas
    $availableSubjects = $career->subjects->reject(function($subject) use ($registeredSubjectIds) {
        return in_array($subject->id, $registeredSubjectIds);
    });


    return inertia('Students/editSubjects', [
        'student' => $student,
        'career_subjects' => $availableSubjects, // Cambiado para enviar las materias filtradas
        'registrations' => $registrations,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $student)
    {
        $student->update($request->validated());
        $userId = $student->id;
       
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

     /**
     * Remove the specified resource from storage.
     */
    public function destroyRegister( $id)
    { 
        $register = Registration::findOrFail($id);
        $register->delete();
       
    }
}