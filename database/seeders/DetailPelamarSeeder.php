<?php

namespace Database\Seeders;

use App\Models\DetailPelamar;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;

class DetailPelamarSeeder extends Seeder
{
    public function run(): void
    {
        $eligiblePelamars = Pelamar::whereIn('status', [
            'lolos_tahap1', 'psikotest', 'lolos_psikotest', 'interview', 'diterima'
        ])->get();

        foreach ($eligiblePelamars as $pelamar) {
            DetailPelamar::factory()->create([
                'pelamar_id' => $pelamar->id,
                'nama_lengkap' => $pelamar->nama_lengkap,
                'email' => $pelamar->email,
                'no_hp' => $pelamar->no_telepon,
                'no_wa' => $pelamar->no_telepon,
                'alamat_tinggal' => $pelamar->alamat,
                'tempat_lahir' => $pelamar->tempat_lahir,
                'tanggal_lahir' => $pelamar->tanggal_lahir,
            ]);
        }
    }
}
