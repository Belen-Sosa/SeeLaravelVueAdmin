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
        $userId = null;
        if ($this->route('student')) {
            $userId = $this->route('student')->id;
        } elseif ($this->route('administrator')) {
            $userId = $this->route('administrator')->id;
        }

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'name')->ignore($userId),
            ],
            'career_id' => [
                'required',
                'exists:careers,id',
            ],
            'email' => [
                'required',
                'email',
                'string',
                'max:1000',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:8',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Debe ingresar un nombre de usuario.',
            'email.unique' => 'El correo ingresado ya se encuentra registrado.',
            'email.required' => 'Debe ingresar un correo electrónico.',
            'career_id.required' => 'Debe seleccionar una carrera.',
            'password.required' => 'Debe ingresar una contraseña.',
        ];
    }
}