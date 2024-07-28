<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
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
            'survey_id'=> ['required','exists:surveys,id'],
            'title'=> ['required','string','max:100',Rule::unique(table:'questions',column:'title')->ignore(id:request('question'),idColumn:'id')],
            'type_question_id'=> ['required','exists:type_questions,id'],
        ];
    }

     

}
