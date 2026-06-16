<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use App\Models\PengajuanTenagaKerja;
use App\Models\User;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $approvedPengajuans = PengajuanTenagaKerja::where('status', 'disetujui')->get();
        $hrdUsers = User::where('role', 'hrd')->get();

        if ($approvedPengajuans->isEmpty()) {
            return;
        }

        if ($hrdUsers->isEmpty()) {
            $hrdUsers = collect([
                User::factory()->hrd()->create([
                    'username' => 'hrd_rekrutmen',
                    'name' => 'HRD Recruitment',
                    'email' => 'hrd.rec@dagsap.com'
                ])
            ]);
        }

        foreach ($approvedPengajuans as $index => $pengajuan) {
            $hrd = $hrdUsers->random();

            if ($index % 3 === 0) {
                // Draft vacancy
                Lowongan::factory()->draft()->create([
                    'pengajuan_id' => $pengajuan->id,
                    'hrd_id' => $hrd->id,
                    'judul' => 'Lowongan (Draft) - ' . $pengajuan->posisi,
                    'deskripsi' => $pengajuan->deskripsi_pekerjaan
                ]);
            } elseif ($index % 3 === 1) {
                // Published/active vacancy
                Lowongan::factory()->publikasi()->create([
                    'pengajuan_id' => $pengajuan->id,
                    'hrd_id' => $hrd->id,
                    'judul' => 'Lowongan ' . $pengajuan->posisi,
                    'deskripsi' => $pengajuan->deskripsi_pekerjaan
                ]);
            } else {
                // Closed/completed vacancy
                Lowongan::factory()->ditutup()->create([
                    'pengajuan_id' => $pengajuan->id,
                    'hrd_id' => $hrd->id,
                    'judul' => 'Lowongan ' . $pengajuan->posisi . ' (Closed)',
                    'deskripsi' => $pengajuan->deskripsi_pekerjaan
                ]);
            }
        }
    }
}
