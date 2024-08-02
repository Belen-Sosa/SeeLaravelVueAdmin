<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidYearForCareer;
class SubjectRequest extends FormRequest
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
    { // dd($this->all());
        return [
            'name'=> ['required','string','max:100'],
            'year' => ['required', 'integer', 'min:1', 'max:4', new ValidYearForCareer($this->input('career'))],
            'career_id'=> ['required'],
            'teacher_id'=> ['required']
        ];
    }
    public function messages()
    {
        return [

            'name.require'=>_('El nombre de la materia es requerido.'),
            'year.require'=>_('Debe ingresar a que año de la carrera pertenece la materia.'),
            'career_id.require'=>_('Debe seleccionar una carrera.'),
            'teacher_id.require'=>_('Debe seleccionar un profesor.'),
            
        ];
    }
}
