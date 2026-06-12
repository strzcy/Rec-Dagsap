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
        // HRD
        User::create([
            'username' => 'hrd_dagsap',
            'name' => 'HRD Dagsap',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('hrd_dagsap123'),
            'role' => 'hrd',
            'no_telepon' => '6281367826052'
        ]);

        // Management
        $managementData = [
            'FAT' => [
                'username' => 'FAT',
                'password' => 'FAT123'
            ],
            'HRD&GA' => [
                'username' => 'HRD&GA',
                'password' => 'HRD&GA123'
            ],
            'Internal Audit' => [
                'username' => 'InternalAudit',
                'password' => 'InternalAudit123'
            ],
            'Maintenance' => [
                'username' => 'Maintenance',
                'password' => 'Maintenance123'
            ],
            'PPIC&Purchasing' => [
                'username' => 'PPIC&Purchasing',
                'password' => 'PPIC&Purchasing123'
            ],
            'Produksi' => [
                'username' => 'Produksi',
                'password' => 'Produksi123'
            ],
            'QAQC' => [
                'username' => 'QAQC',
                'password' => 'QAQC123'
            ],
            'Sales & Marketing' => [
                'username' => 'Sales&Marketing',
                'password' => 'Sales&Marketing123'
            ],
        ];

        foreach ($managementData as $divisiNama => $cred) {
            $divisi = Divisi::where('nama_divisi', $divisiNama)->first();

            if ($divisi) {
                User::create([
                    'username' => $cred['username'],
                    'name' => 'Management ' . $divisiNama,
                    'email' => strtolower(str_replace([' ', '&'], ['.', 'and'], $cred['username'])) . '@dagsap.com',
                    'password' => Hash::make($cred['password']),
                    'role' => 'management',
                    'managed_divisi_id' => $divisi->id,
                    'no_telepon' => '6281367826052'
                ]);
            }
        }

        // Divisi
        User::create([
            'username' => 'user_dagsap',
            'name' => 'User Divisi',
            'email' => 'user.divisi@dagsap.com',
            'password' => Hash::make('user_dagsap123'),
            'role' => 'divisi',
            'divisi_id' => null,
            'no_telepon' => '6281367826052'
        ]);
    }
}