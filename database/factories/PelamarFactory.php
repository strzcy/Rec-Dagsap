<?php

namespace Database\Factories;

use App\Models\Pelamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pelamar>
 */
class PelamarFactory extends Factory
{
    protected $model = Pelamar::class;

    public function definition(): array
    {
        $name = fake('id_ID')->name();
        $email = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name)) . fake()->numberBetween(10, 99) . '@example.com';
        $education = fake()->randomElement(['SMA/SMK', 'D3', 'S1']);
        $jurusan = match($education) {
            'SMA/SMK' => fake()->randomElement(['IPA', 'IPS', 'Teknik Mesin', 'Administrasi Perkantoran']),
            'D3', 'S1' => fake()->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Akuntansi', 'Manajemen', 'Teknik Elektro', 'Teknologi Pangan']),
        };

        return [
            'lowongan_id' => \App\Models\Lowongan::factory()->publikasi(),
            'nama_lengkap' => $name,
            'email' => $email,
            'no_telepon' => '628' . fake()->numberBetween(111111111, 999999999),
            'tempat_lahir' => fake('id_ID')->city(),
            'tanggal_lahir' => fake()->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'alamat' => fake('id_ID')->address(),
            'pendidikan_terakhir' => $education,
            'jurusan' => $jurusan,
            'tahun_lulus' => fake()->numberBetween(2010, 2023),
            'ipk' => number_format(fake()->randomFloat(2, 2.50, 4.00), 2),
            'pengalaman_kerja' => fake()->randomElement([
                null,
                'Staf Administrasi di PT ABC selama 2 tahun.',
                'Operator Produksi di PT XYZ selama 3 tahun.',
                'Fresh Graduate dengan magang di PT Jaya Abadi.'
            ]),
            'cv_path' => 'cvs/' . fake()->uuid() . '.pdf',
            'ijazah_path' => 'ijazahs/' . fake()->uuid() . '.pdf',
            'status' => 'pending',
            'catatan' => null,
            'psikotest_link' => null,
            'psikotest_dikirim_at' => null,
            'psikotest_selesai_at' => null,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function lolosTahap1(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lolos_tahap1',
        ]);
    }

    public function psikotest(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'psikotest',
            'psikotest_link' => 'https://psikotest.dagsap.com/test/' . fake()->md5(),
            'psikotest_dikirim_at' => now(),
        ]);
    }

    public function lolosPsikotest(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lolos_psikotest',
            'psikotest_link' => 'https://psikotest.dagsap.com/test/' . fake()->md5(),
            'psikotest_dikirim_at' => now()->subDays(2),
            'psikotest_selesai_at' => now()->subDays(1),
        ]);
    }

    public function interview(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'interview',
            'psikotest_link' => 'https://psikotest.dagsap.com/test/' . fake()->md5(),
            'psikotest_dikirim_at' => now()->subDays(4),
            'psikotest_selesai_at' => now()->subDays(3),
            'catatan' => 'Jadwal interview tatap muka dengan User & HRD.',
        ]);
    }

    public function diterima(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diterima',
            'psikotest_link' => 'https://psikotest.dagsap.com/test/' . fake()->md5(),
            'psikotest_dikirim_at' => now()->subDays(10),
            'psikotest_selesai_at' => now()->subDays(9),
            'catatan' => 'Disetujui untuk offering letter.',
        ]);
    }

    public function ditolak(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
            'catatan' => 'Kualifikasi pengalaman tidak sesuai dengan deskripsi pekerjaan.',
        ]);
    }
}
