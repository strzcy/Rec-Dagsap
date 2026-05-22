<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    public function run(): void
    {
        $divisis = [
            ['nama_divisi' => 'FAT', 'kode_divisi' => 'FAT'],
            ['nama_divisi' => 'HRD&GA', 'kode_divisi' => 'HRDGA'],
            ['nama_divisi' => 'Internal Audit', 'kode_divisi' => 'IA'],
            ['nama_divisi' => 'Maintenance', 'kode_divisi' => 'MTN'],
            ['nama_divisi' => 'PPIC&Purchasing', 'kode_divisi' => 'PPIC'],
            ['nama_divisi' => 'Produksi', 'kode_divisi' => 'PROD'],
            ['nama_divisi' => 'QAQC', 'kode_divisi' => 'QAQC'],
            ['nama_divisi' => 'Sales & Marketing', 'kode_divisi' => 'SALES'],
        ];

        foreach ($divisis as $divisi) {
            Divisi::create($divisi);
        }
    }
}