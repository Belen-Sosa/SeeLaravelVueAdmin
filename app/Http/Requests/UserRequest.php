<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
       // Obtiene el ID del usuario desde la ruta

       if($this->route('student')){
        $userId=$this->route('student')->id;
       } if($this->route('administrator')){
            $userId=$this->route('administrator');}
        else{
        $userId=null;
       }
     

       
    
        return [
            'name'=> ['required','string','max:100',  Rule::unique('users', 'name')->ignore($userId)],
            'career_id'=> ['required','exists:careers,id'],
            'email'=> ['required','email','string','max:1000' , Rule::unique('users', 'email')->ignore($userId)],

            //si el metodo es un post, osea una creacion de usuario hacemos que el password sea requerido si es un edit no.
          'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:8'
            ]
        ];
       
      
       
    }

    public function messages()
    {
        return [

            'name.unique'=>_('EL nombre del usuario ya existe.'),
            'email.unique'=>_('El correo ingresado ya se encuentra registrado.')
            
        ];
    }
}
