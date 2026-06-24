<?php

namespace App\Http\Requests\HRD;

use Illuminate\Foundation\Http\FormRequest;

class KirimJadwalInterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_interview' => 'required|date',
            'waktu_interview' => 'required',
            'lokasi_interview' => 'required|string',
            'catatan' => 'nullable|string'
        ];
    }
}
