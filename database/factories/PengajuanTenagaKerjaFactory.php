<?php

namespace Database\Factories;

use App\Models\PengajuanTenagaKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PengajuanTenagaKerja>
 */
class PengajuanTenagaKerjaFactory extends Factory
{
    protected $model = PengajuanTenagaKerja::class;

    public function definition(): array
    {
        $jenis = fake()->randomElement(['penambahan', 'penggantian']);
        $posisi = fake()->randomElement([
            'Staff IT Support',
            'Operator Produksi',
            'Supervisor QAQC',
            'Staff Administrasi FAT',
            'Supervisor Maintenance',
            'Staff Purchasing',
            'HR Recruitment Officer',
            'Sales Marketing Representative'
        ]);

        return [
            'divisi_id' => \App\Models\Divisi::factory(),
            'departemen_dipilih' => null,
            'user_id' => \App\Models\User::factory()->divisi(),
            'nama_pemohon' => fake('id_ID')->name(),
            'nip_pemohon' => 'NIP' . fake()->unique()->numberBetween(10000, 99999),
            'jabatan_pemohon' => 'Supervisor ' . fake()->word(),
            'no_hp_pemohon' => '628' . fake()->numberBetween(111111111, 999999999),
            'diajukan_oleh' => fake('id_ID')->name(),
            'disetujui_oleh' => null,
            'jenis' => $jenis,
            'posisi' => $posisi,
            'jumlah' => fake()->numberBetween(1, 5),
            'tanggal_dibutuhkan' => fake()->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            'kriteria' => [
                'pendidikan' => fake()->randomElement(['SMA/SMK', 'D3', 'S1']),
                'pengalaman' => fake()->randomElement(['Minimal 1 tahun', 'Minimal 2 tahun', 'Fresh graduate boleh melamar']),
                'usia' => 'Maksimal 30 tahun',
                'gender' => fake()->randomElement(['Laki-laki / Perempuan', 'Laki-laki', 'Perempuan']),
            ],
            'persyaratan' => [
                'Menguasai Ms. Office & Tools penunjang pekerjaan.',
                'Memiliki kemampuan komunikasi yang baik.',
                'Bersedia ditempatkan di pabrik (Cikupa, Tangerang).',
                'Disiplin, teliti, dan bertanggung jawab.'
            ],
            'deskripsi_pekerjaan' => fake()->paragraph(),
            'tugas' => [
                'Melakukan monitoring harian pada area kerja.',
                'Membuat laporan mingguan dan bulanan.',
                'Berkoordinasi dengan departemen terkait.'
            ],
            'status' => 'pending',
            'alasan_penolakan' => null,
            'approved_by' => null,
            'approved_at' => null,
            'jabatan_penyetuju' => null,
        ];
    }

    /**
     * State for approved requests.
     */
    public function disetujui(?int $approverId = null, ?string $approverName = null): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'disetujui',
            'approved_by' => $approverId ?? \App\Models\User::factory()->hrd(),
            'approved_at' => now(),
            'disetujui_oleh' => $approverName ?? 'HRD Manager',
            'jabatan_penyetuju' => 'HRD & GA Manager',
        ]);
    }

    /**
     * State for rejected requests.
     */
    public function ditolak(?int $approverId = null, ?string $approverName = null): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
            'approved_by' => $approverId ?? \App\Models\User::factory()->hrd(),
            'approved_at' => now(),
            'disetujui_oleh' => $approverName ?? 'HRD Manager',
            'jabatan_penyetuju' => 'HRD & GA Manager',
            'alasan_penolakan' => 'Kebutuhan tenaga kerja belum mendesak / budget tidak mencukupi.',
        ]);
    }
}
