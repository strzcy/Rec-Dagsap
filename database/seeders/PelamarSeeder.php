<?php

namespace Database\Seeders;

use App\Models\Pelamar;
use App\Models\Lowongan;
use Illuminate\Database\Seeder;

class PelamarSeeder extends Seeder
{
    public function run(): void
    {
        $lowongans = Lowongan::all();
        if ($lowongans->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'lolos_tahap1', 'psikotest', 'lolos_psikotest', 'interview', 'diterima', 'ditolak'];

        foreach ($lowongans as $index => $lowongan) {
            // High-volume seeding for the first vacancy (15 applicants)
            // Low-volume seeding for other vacancies (1 to 3 applicants)
            $count = ($index === 0) ? 15 : fake()->numberBetween(1, 3);

            foreach (range(1, $count) as $j) {
                $status = fake()->randomElement($statuses);

                $factory = Pelamar::factory();
                $factory = match($status) {
                    'pending' => $factory->pending(),
                    'lolos_tahap1' => $factory->lolosTahap1(),
                    'psikotest' => $factory->psikotest(),
                    'lolos_psikotest' => $factory->lolosPsikotest(),
                    'interview' => $factory->interview(),
                    'diterima' => $factory->diterima(),
                    'ditolak' => $factory->ditolak(),
                };

                $factory->create([
                    'lowongan_id' => $lowongan->id,
                ]);
            }
        }
    }
}
