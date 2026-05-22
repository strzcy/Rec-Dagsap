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
        // HRD (global, 1 user) - username susah ditebak
        User::create([
            'username' => 'Hrd_D4gs4p_2024',
            'name' => 'HRD Dagsap',
            'email' => 'hrd@dagsap.com',
            'password' => Hash::make('D4gs4p@HRD2024!'),
            'role' => 'hrd',
            'no_telepon' => '6281294491075' // Nomor HRD untuk WhatsApp
        ]);

        // Management per divisi dengan username unik
        $managementData = [
            'FAT' => ['username' => 'M4n4g3r_F4T_88', 'password' => 'F4T@M4n4g3r2024!'],
            'HRD&GA' => ['username' => 'G4_4dm1n_77', 'password' => 'HRDGA@4dm1n2024!'],
            'Internal Audit' => ['username' => '4ud1t0r_X99', 'password' => '14@4ud1t0r2024!'],
            'Maintenance' => ['username' => 'Mtn_Sup3r_55', 'password' => 'MTN@Sup3r2024!'],
            'PPIC&Purchasing' => ['username' => 'Ppic_Pr0c_44', 'password' => 'PPIC@Pr0c2024!'],
            'Produksi' => ['username' => 'Pr0d_M4n4g3r_33', 'password' => 'PROD@M4n4g3r2024!'],
            'QAQC' => ['username' => 'Q4qc_Ch13f_22', 'password' => 'QAQC@Ch13f2024!'],
            'Sales & Marketing' => ['username' => 'S4l3s_D1r_11', 'password' => 'SALES@D1r2024!'],
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
                    'no_telepon' => '0812345678' . (90 + $divisi->id)
                ]);
            }
        }

        // Divisi users dengan username unik
        $divisiUsers = [
            'FAT' => ['username' => 'F4T_0p3r4t0r_99', 'password' => 'F4T@Us3r2024!', 'name' => 'Operator FAT'],
            'HRD&GA' => ['username' => 'Hrdg4_St4ff_88', 'password' => 'HRDGA@St4ff2024!', 'name' => 'Staff HRDGA'],
            'Internal Audit' => ['username' => '14_4ud1t0r_77', 'password' => 'IA@4ud1t0r2024!', 'name' => 'Auditor Internal'],
            'Maintenance' => ['username' => 'Mtn_T3kn1k_66', 'password' => 'MTN@T3kn1k2024!', 'name' => 'Teknik Maintenance'],
            'PPIC&Purchasing' => ['username' => 'Ppic_St4ff_55', 'password' => 'PPIC@St4ff2024!', 'name' => 'Staff PPIC'],
            'Produksi' => ['username' => 'Pr0d_0p3r4t0r_44', 'password' => 'PROD@0p3r4t0r2024!', 'name' => 'Operator Produksi'],
            'QAQC' => ['username' => 'Q4qc_1nsp3k_33', 'password' => 'QAQC@1nsp3k2024!', 'name' => 'Inspector QAQC'],
            'Sales & Marketing' => ['username' => 'S4l3s_Ex3c_22', 'password' => 'SALES@Ex3c2024!', 'name' => 'Sales Executive'],
        ];

        foreach ($divisiUsers as $divisiNama => $cred) {
            $divisi = Divisi::where('nama_divisi', $divisiNama)->first();
            if ($divisi) {
                User::create([
                    'username' => $cred['username'],
                    'name' => $cred['name'],
                    'email' => strtolower(str_replace(' ', '.', $divisiNama)) . '.user@dagsap.com',
                    'password' => Hash::make($cred['password']),
                    'role' => 'divisi',
                    'divisi_id' => $divisi->id,
                    'no_telepon' => '0812345678' . (80 + $divisi->id)
                ]);
            }
        }
    }
}