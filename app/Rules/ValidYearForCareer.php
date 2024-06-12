<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidYearForCareer implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    
        protected $career;

        public function __construct($career)
        {
            $this->career = $career;
        }
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Si la carrera es "Profesorado de Educacion Primaria", permitir año 4
        if ($this->career === 'Profesorado de Educacion Primaria' && $value == 4) {
            return;
        }

        // Si la carrera no es "Profesorado de Educacion Primaria", no permitir año 4
        if ($value > 3) {
            $fail('El año no puede ser 4 a menos que la carrera sea Profesorado de Educacion Primaria.');
        }
    }
       
          
    }
