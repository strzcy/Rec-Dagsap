<?php

namespace Database\Seeders;

use App\Models\PengajuanTenagaKerja;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengajuanTenagaKerjaSeeder extends Seeder
{
    public function run(): void
    {
        $divisis = Divisi::all();
        $divisiIds = $divisis->pluck('id')->toArray();

        // Get divisi users for submitting requests
        $divisiUsers = User::where('role', 'divisi')->get();
        if ($divisiUsers->isEmpty()) {
            // Generate some divisi users
            $divisiUsers = collect();
            foreach ($divisis as $divisi) {
                $divisiUsers->push(
                    User::factory()->divisi($divisi->id)->create([
                        'name' => 'User Divisi ' . $divisi->nama_divisi,
                        'email' => 'user.' . strtolower($divisi->kode_divisi) . '@dagsap.com',
                        'username' => 'user_' . strtolower($divisi->kode_divisi)
                    ])
                );
            }
        }

        // Get hrd/management users for approving
        $hrdUsers = User::where('role', 'hrd')->get();
        if ($hrdUsers->isEmpty()) {
            $hrdUsers = collect([
                User::factory()->hrd()->create([
                    'username' => 'hrd_rekrutmen',
                    'name' => 'HRD Recruitment',
                    'email' => 'hrd.rec@dagsap.com'
                ])
            ]);
        }

        if (empty($divisiIds)) {
            return;
        }

        // 1. Happy Path - Approved Requests
        foreach (range(1, 8) as $i) {
            $divisiUser = $divisiUsers->random();
            $approver = $hrdUsers->random();
            $divisiId = fake()->randomElement($divisiIds);
            $deptId = fake()->boolean(50) ? fake()->randomElement($divisiIds) : null;

            PengajuanTenagaKerja::factory()
                ->disetujui($approver->id, $approver->name)
                ->create([
                    'divisi_id' => $divisiId,
                    'departemen_dipilih' => $deptId,
                    'user_id' => $divisiUser->id,
                ]);
        }

        // 2. Pending Requests
        foreach (range(1, 4) as $i) {
            $divisiUser = $divisiUsers->random();
            $divisiId = fake()->randomElement($divisiIds);
            $deptId = fake()->boolean(30) ? fake()->randomElement($divisiIds) : null;

            PengajuanTenagaKerja::factory()->create([
                'divisi_id' => $divisiId,
                'departemen_dipilih' => $deptId,
                'user_id' => $divisiUser->id,
                'status' => 'pending',
            ]);
        }

        // 3. Rejected Requests
        foreach (range(1, 3) as $i) {
            $divisiUser = $divisiUsers->random();
            $approver = $hrdUsers->random();
            $divisiId = fake()->randomElement($divisiIds);
            $deptId = fake()->boolean(40) ? fake()->randomElement($divisiIds) : null;

            PengajuanTenagaKerja::factory()
                ->ditolak($approver->id, $approver->name)
                ->create([
                    'divisi_id' => $divisiId,
                    'departemen_dipilih' => $deptId,
                    'user_id' => $divisiUser->id,
                ]);
        }
    }
}
