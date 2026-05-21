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
        // HRD (global, 1 user) - tidak punya managed_divisi_id
        User::create([
            'username' => 'hrd',
            'name' => 'HRD User',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('password'),
            'role' => 'hrd',
            'no_telepon' => '081234567891'
        ]);

        // Management per divisi
        $divisis = Divisi::all();
        
        foreach ($divisis as $divisi) {
            User::create([
                'username' => 'management_' . strtolower($divisi->kode_divisi),
                'name' => 'Management ' . $divisi->nama_divisi,
                'email' => 'management.' . strtolower($divisi->kode_divisi) . '@dagsap.com',
                'password' => Hash::make('password'),
                'role' => 'management',
                'managed_divisi_id' => $divisi->id,
                'no_telepon' => '0812345678' . (90 + $divisi->id)
            ]);
        }

        // Divisi TI
        $divisiTI = Divisi::where('kode_divisi', 'TI')->first();
        if ($divisiTI) {
            User::create([
                'username' => 'ti',
                'name' => 'Divisi TI',
                'email' => 'ti@dagsap.com',
                'password' => Hash::make('password'),
                'role' => 'divisi',
                'divisi_id' => $divisiTI->id,
                'no_telepon' => '081234567892'
            ]);
        }

        // Divisi SDM
        $divisiSDM = Divisi::where('kode_divisi', 'SDM')->first();
        if ($divisiSDM) {
            User::create([
                'username' => 'sdm',
                'name' => 'Divisi SDM',
                'email' => 'sdm@dagsap.com',
                'password' => Hash::make('password'),
                'role' => 'divisi',
                'divisi_id' => $divisiSDM->id,
                'no_telepon' => '081234567893'
            ]);
        }
        
        // Divisi Keuangan
        $divisiKEU = Divisi::where('kode_divisi', 'KEU')->first();
        if ($divisiKEU) {
            User::create([
                'username' => 'keuangan',
                'name' => 'Divisi Keuangan',
                'email' => 'keuangan@dagsap.com',
                'password' => Hash::make('password'),
                'role' => 'divisi',
                'divisi_id' => $divisiKEU->id,
                'no_telepon' => '081234567894'
            ]);
        }
        
        // Divisi Marketing
        $divisiMKT = Divisi::where('kode_divisi', 'MKT')->first();
        if ($divisiMKT) {
            User::create([
                'username' => 'marketing',
                'name' => 'Divisi Marketing',
                'email' => 'marketing@dagsap.com',
                'password' => Hash::make('password'),
                'role' => 'divisi',
                'divisi_id' => $divisiMKT->id,
                'no_telepon' => '081234567895'
            ]);
        }
        
        // Divisi Operasional
        $divisiOPS = Divisi::where('kode_divisi', 'OPS')->first();
        if ($divisiOPS) {
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
}