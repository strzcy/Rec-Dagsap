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
        // HRD - username sederhana
        
        $managementData = [
            'FAT' => ['username' => 'fat', 'password' => 'fat123'],
            'HRD&GA' => ['username' => 'hrdga', 'password' => 'hrdga123'],
            'Internal Audit' => ['username' => 'audit', 'password' => 'audit123'],
            'Maintenance' => ['username' => 'maintenance', 'password' => 'mtn123'],
            'PPIC&Purchasing' => ['username' => 'ppic', 'password' => 'ppic123'],
            'Produksi' => ['username' => 'produksi', 'password' => 'prod123'],
            'QAQC' => ['username' => 'qaqc', 'password' => 'qaqc123'],
            'Sales & Marketing' => ['username' => 'sales', 'password' => 'sales123'],
        ];

        foreach ($managementData as $divisiNama => $cred) {
            $divisi = Divisi::where('nama_divisi', $divisiNama)->first();
            if ($divisi) {
                User::create([
                    'username' => $cred['username'],
                    'name' => 'Management ' . $divisiNama,
                    'email' => strtolower(str_replace(' ', '.', $divisiNama)) . '@dagsap.com',
                    'password' => Hash::make($cred['password']),
                    'role' => 'management',
                    'managed_divisi_id' => $divisi->id,
                    'no_telepon' => '6281234567' . (90 + $divisi->id)
                ]);
            }
        }

        
        User::create([
            'username' => 'user_dagsap',
            'name' => 'User Divisi',
            'email' => 'user.divisi@dagsap.com',
            'password' => Hash::make('user_dagsap123'),
            'role' => 'divisi',
            'divisi_id' => null, // tidak terikat divisi tertentu
            'no_telepon' => '628123456789'
        ]);
    }
}