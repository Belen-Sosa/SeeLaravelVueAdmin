<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'duration' => $this->duration !== '' ? $this->duration : null,
        ]);
    }

  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> ['required','string','max:100',Rule::unique(table:'careers',column:'name')->ignore(id:request('career'),idColumn:'id')],
            'duration'=> ['required','integer','max:100']
        ];
    }

    public function messages()
    {
        return [
            'name.unique'=>_('El nombre de la carrera ya existe.'),
            'duration.required' => _('La duración no puede ser nula.')
        ];
    }
}
