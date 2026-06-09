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
        User::create([
            'username' => 'hrd_dagsap',
            'name' => 'HRD Dagsap',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('hrd_dagsap123'),
            'role' => 'hrd',
            'no_telepon' => '6281294491075' // Format 62
        ]);

        // Management per divisi
        $managementData = [
            'FAT' => ['username' => 'manager_fat', 'password' => 'manager_fat123'],
            'HRD&GA' => ['username' => 'manager_hrdga', 'password' => 'manager_hrdga123'],
            'Internal Audit' => ['username' => 'manager_audit', 'password' => 'manager_audit123'],
            'Maintenance' => ['username' => 'manager_mtn', 'password' => 'manager_mtn123'],
            'PPIC&Purchasing' => ['username' => 'manager_ppic', 'password' => 'manager_ppic123'],
            'Produksi' => ['username' => 'manager_prod', 'password' => 'manager_prod123'],
            'QAQC' => ['username' => 'manager_qaqc', 'password' => 'manager_qaqc123'],
            'Sales & Marketing' => ['username' => 'manager_sales', 'password' => 'manager_sales123'],
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