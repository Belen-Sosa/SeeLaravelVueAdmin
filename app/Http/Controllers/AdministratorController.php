<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Career;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{
     //paginando el numero de lecciones 
     const NUMBER_OF_ITEMS_PER_PAGE= 25;
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
          // Obtener el rol "estudiantes"
          $role = Role::where('name', 'admin')->first();

              // Verificar si el rol existe
             if ($role) {

                $admins = User::role('admin')
                    ->with('career')
                    ->paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
                }
            
    
            return Inertia('Administrators/index', [
                'admins' => $admins
            ]);
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $careers= Career::all();
        
        return inertia('Administrators/create',['role'=>'admin','careers'=>$careers]);
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
           User::create(  $validatedData )->assignRole('admin');

    

        return redirect()->route('administrators.index');
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
    public function edit($adminId)
    {
  
        $admin = User::findOrFail($adminId);
        $careers= Career::all();
       

        return inertia('Administrators/edit',['admin'=> $admin,'careers'=>$careers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $adminId)
    {  $admin = User::findOrFail($adminId);
        $admin->update($request->validated());
        return redirect()->route('administrators.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($adminId)
    {
        $admin = User::findOrFail($adminId);
        $admin->delete();
        return redirect()->route('administrators.index');
    }
}
