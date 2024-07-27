<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        Log::info('Entramos en ResultRequest');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        Log::info("en rules");  
      
        foreach ($this->all() as $index => $item) {
            if (is_array($item)) {
                foreach ($item as $subIndex => $subItem) {
                    $rules["$index.$subIndex.question_id"] = 'required|exists:questions,id';
                    $rules["$index.$subIndex.option_id"] = 'nullable|exists:options,id';
                    $rules["$index.$subIndex.text"] = 'nullable|string|max:100';
                }
            } else {
                $rules["$index.question_id"] = 'required|exists:questions,id';
                $rules["$index.option_id"] = 'nullable|exists:options,id';
                $rules["$index.text"] = 'nullable|string|max:100';
            }
        }

        Log::info($rules);
        return $rules;
    }

    protected function prepareForValidation()
    {
        $processedData = [];

        Log::info("en prepareForValidation");  
        Log::info($this->all());
        foreach ($this->all() as $questionId => $answer) {
            if (is_array($answer)) {
                foreach ($answer as $optionId) {
                    $processedData[] = [
                        'question_id' => $questionId,
                        'option_id' => $optionId,
                        'text' => null
                    ];
                }
            } else {
                if ($answer === '') {
                    $processedData[] = [
                        'question_id' => $questionId,
                        'option_id' => null,
                        'text' => null
                    ];
                } elseif (is_numeric($answer)) {
                    $processedData[] = [
                        'question_id' => $questionId,
                        'option_id' => (int) $answer,
                        'text' => null
                    ];
                } else {
                    $processedData[] = [
                        'question_id' => $questionId,
                        'option_id' => null,
                        'text' => $answer
                    ];
                }
            }
        }

        $resultArray = [];
        foreach ($processedData as $data) {
            $resultArray[$data['question_id']][] = $data;
        }

        $this->replace($resultArray);
        Log::info("data procesada");
        Log::info($this->all());
    }
}