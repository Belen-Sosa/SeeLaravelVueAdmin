<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function prepareForValidation()
    {
     
        Log::info($this->all()); 
        if( $this->isMethod('post') ){
            if ($this->has('final_date')) {
                $this->merge([
                    'final_date' => DateTime::createFromFormat('Y-m-d\TH:i', $this->final_date)->format('Y-m-d H:i'),
                ]);
            }
            $this->merge([
                'user_id' => $this->user()->id,
                'start_date' => (new DateTime())->format('Y-m-d H:i'),
                'estate' => 0,
            ]);
        }else{
            if ($this->has('final_date')) {
                $this->merge([
                    'final_date' => DateTime::createFromFormat('Y-m-d\TH:i', $this->final_date)->format('Y-m-d H:i'),
                ]);
            }
            $this->merge([
                'user_id' => $this->user()->id,
         
            ]);
        }
       

      
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { 
       
      
            return [
                'user_id' => ['required', 'integer'],
                'title'=> ['required','string','max:100'],
                'career_id'=> [ $this->isMethod('post') ? 'required' : 'nullable','exists:careers,id'],
                'subject_id'=> [ $this->isMethod('post') ? 'required' : 'nullable','exists:subjects,id'],
                'description'=> ['required','string','max:100'],
                'estate' => [ $this->isMethod('post') ? 'required' : 'nullable', 'integer'],
                'start_date' => [ $this->isMethod('post') ? 'required' : 'nullable', 'date_format:Y-m-d H:i'],
                'final_date' => ['required','date_format:Y-m-d H:i'],
                
                
            ];
            
    }
    
   
    public function messages()
    {
        return [

            'title.required'=>_('El titulo no puede estar vacio.'),
           
        ];
    }
}
