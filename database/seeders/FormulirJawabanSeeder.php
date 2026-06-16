<?php

namespace Database\Seeders;

use App\Models\FormulirJawaban;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;

class FormulirJawabanSeeder extends Seeder
{
    public function run(): void
    {
        $pelamars = Pelamar::all();

        foreach ($pelamars as $pelamar) {
            if ($pelamar->ipk) {
                FormulirJawaban::factory()->create([
                    'pelamar_id' => $pelamar->id,
                    'field_name' => 'ipk',
                    'jawaban' => $pelamar->ipk,
                ]);
            }
        }
    }
}
