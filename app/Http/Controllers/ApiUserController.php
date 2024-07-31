<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ApiUserController extends Controller
{
   
    public function login(LoginRequest $request)
    {

        //de la peticion solo tomamos el email y el password 
        $credentials = $request->only('email', 'password');
        

        //attempt permite loguear a un usuario 
        if (Auth::attempt($credentials)) {
            
              /** @var \App\Models\MyUserModel $user **/
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
       
            $user = User::where('email',$request->email)->first();
                      
        
            // Obtener solo los datos pivot de las materias
            $subjects = $user->subjects->map(function ($subject) {    return [   'subject' => $subject->pivot->toArray(), ]; });
                            

            return response()->json([
                'status'=> true,
                'token' => $token,
                'token_type' => 'Bearer',
                'user'=>$user,
                'subjects_register'=>$subjects
               
                
               
            ]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    { 
        
        return response()->json($request->user());
    }

   
}
