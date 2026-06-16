<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilPsikotestSeeder extends Seeder
{
    public function run(): void
    {
        $records = [];
        for ($i = 0; $i < 5; $i++) {
            $records[] = [
                'created_at' => now()->subDays(fake()->numberBetween(1, 10)),
                'updated_at' => now(),
            ];
        }

        DB::table('hasil_psikotests')->insert($records);
    }
}
