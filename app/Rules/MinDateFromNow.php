<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinDateFromNow implements ValidationRule
{
    protected $days;

    public function __construct($days = 31)
    {
        $this->days = $days;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $minDate = now()->addDays($this->days);
        
        if (strtotime($value) < strtotime($minDate)) {
            $fail("Tanggal dibutuhkan harus minimal {$this->days} hari dari sekarang (minimal " . $minDate->format('d/m/Y') . ")");
        }
    }
}