<?php

namespace App\Http\Requests\Divisi;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Identitas Pemohon
            'nama_pemohon' => 'required|string|max:255',
            'nip_pemohon' => 'required|string|max:50',
            'jabatan_pemohon' => 'required|string|max:255',
            'no_hp_pemohon' => 'required|string|max:20',
            'departemen_dipilih' => 'required|exists:divisis,id',
        
            // Data PTK
            'jenis' => 'required|in:penambahan,penggantian',
            'posisi' => 'required|string|max:255',
            'area_penempatan' => 'required|string|max:255',
            'toko_penempatan' => 'nullable|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_dibutuhkan' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) {
                    $minDate = now()->addDays(31);
                    if (strtotime($value) < strtotime($minDate)) {
                        $fail("Tanggal dibutuhkan harus minimal 31 hari dari sekarang (minimal " . $minDate->format('d/m/Y') . ")");
                    }
                },
            ],
            'deskripsi_pekerjaan' => 'required|string',
            'kriteria_pendidikan' => 'required|string',
            'kriteria_jurusan' => 'nullable|string',
            'kriteria_pengalaman' => 'nullable|string',
            'kriteria_ipk' => 'nullable|string',
            'kriteria_keahlian' => 'nullable|string',
            'tugas' => 'nullable|array',
            'persyaratan' => 'nullable|array',
            'menggantikan' => 'nullable|string',
            
            // LAMPIRAN - WAJIB
            'lampiran' => 'required|file|mimes:pdf,png,jpg,jpeg,docx|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'lampiran.mimes' => 'Format file harus PDF, PNG, JPG, atau DOCX',
            'lampiran.max' => 'Ukuran file maksimal 5MB',
            'tanggal_dibutuhkan.after' => 'Tanggal dibutuhkan harus setelah hari ini',
        ];
    }
}