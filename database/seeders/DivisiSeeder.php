<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    public function run(): void
    {
        $divisis = [
            ['nama_divisi' => 'Teknologi Informasi', 'kode_divisi' => 'TI'],
            ['nama_divisi' => 'Sumber Daya Manusia', 'kode_divisi' => 'SDM'],
            ['nama_divisi' => 'Keuangan', 'kode_divisi' => 'KEU'],
            ['nama_divisi' => 'Marketing', 'kode_divisi' => 'MKT'],
            ['nama_divisi' => 'Operasional', 'kode_divisi' => 'OPS'],
        ];

        foreach ($divisis as $divisi) {
            Divisi::create($divisi);
        }
    }
}