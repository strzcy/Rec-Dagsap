<?php

namespace App\Http\Requests\Divisi;

use Illuminate\Foundation\Http\FormRequest;

class VerifyNikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|string'
        ];
    }
}
