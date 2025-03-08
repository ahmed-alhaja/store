<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected array $forbidden;
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public function __construct(array $forbidden)
    { 
        $this->forbidden = $forbidden;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
      if (in_array(strtolower($value),$this->forbidden)) {
            $fail("The {$attribute} is not allowed.");      
      }
    }
}
