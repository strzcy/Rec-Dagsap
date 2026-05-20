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
            'username' => 'management',
            'name' => 'Management User',
            'email' => 'management@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'management',
            'no_telepon' => '081234567890'
        ]);

        // HRD
        User::create([
            'username' => 'hrd',
            'name' => 'HRD User',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'hrd',
            'no_telepon' => '081234567891'
        ]);

        // Divisi TI
        $divisiTI = Divisi::where('kode_divisi', 'TI')->first();
        User::create([
            'username' => 'ti',
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
            'username' => 'sdm',
            'name' => 'Divisi SDM',
            'email' => 'sdm@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiSDM->id,
            'no_telepon' => '081234567893'
        ]);
        
        // Divisi Keuangan
        $divisiKEU = Divisi::where('kode_divisi', 'KEU')->first();
        User::create([
            'username' => 'keuangan',
            'name' => 'Divisi Keuangan',
            'email' => 'keuangan@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiKEU->id,
            'no_telepon' => '081234567894'
        ]);
        
        // Divisi Marketing
        $divisiMKT = Divisi::where('kode_divisi', 'MKT')->first();
        User::create([
            'username' => 'marketing',
            'name' => 'Divisi Marketing',
            'email' => 'marketing@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiMKT->id,
            'no_telepon' => '081234567895'
        ]);
        
        // Divisi Operasional
        $divisiOPS = Divisi::where('kode_divisi', 'OPS')->first();
        User::create([
            'username' => 'operasional',
            'name' => 'Divisi Operasional',
            'email' => 'operasional@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => $divisiOPS->id,
            'no_telepon' => '081234567896'
        ]);
    }
}