<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DivisiSeeder::class,
            UserSeeder::class,
            PengajuanTenagaKerjaSeeder::class,
            LowonganSeeder::class,
            PelamarSeeder::class,
            FormulirJawabanSeeder::class,
            DetailPelamarSeeder::class,
            HasilPsikotestSeeder::class,
        ]);
    }
}