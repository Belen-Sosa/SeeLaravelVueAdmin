<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
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
        return [
            'name'=> ['required','string','max:100',Rule::unique(table:'teachers',column:'name')->ignore(id:request('teacher'),idColumn:'id')],
            'file'=> ['required','integer'],
            'mail'=> ['required','string','max:1000'],
            'phone'=> ['required','string']
        ];
    }

    public function messages()
    {
        return [

            'name.unique'=>_('El nombre de el profesor ya existe.'),
            'file.unique'=>_('El numero de legajo ya existe .'),
            'mail.require'=>_('El numero de legajo ya existe .'),
            
        ];
    }
}
