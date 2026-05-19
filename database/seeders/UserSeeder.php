<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Management
        User::create([
            'name' => 'Management User',
            'email' => 'management@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'management',
            'no_telepon' => '081234567890'
        ]);

        // HRD
        User::create([
            'name' => 'HRD User',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'hrd',
            'no_telepon' => '081234567891'
        ]);

        // Divisi TI
        $divisiTI = Divisi::where('kode_divisi', 'TI')->first();
        User::create([
            'name' => 'Divisi TI',
            'email' => 'ti@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiTI->id,
            'no_telepon' => '081234567892'
        ]);

        // Divisi SDM
        $divisiSDM = Divisi::where('kode_divisi', 'SDM')->first();
        User::create([
            'name' => 'Divisi SDM',
            'email' => 'sdm@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiSDM->id,
            'no_telepon' => '081234567893'
        ]);
    }
}