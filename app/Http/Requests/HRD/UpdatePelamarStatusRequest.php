<?php

namespace App\Http\Requests\HRD;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelamarStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,lolos_tahap1,psikotest,lolos_psikotest,interview,diterima,ditolak',
            'catatan' => 'nullable|string',
        ];
    }
}
