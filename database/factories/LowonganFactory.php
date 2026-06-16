<?php

namespace Database\Factories;

use App\Models\Lowongan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lowongan>
 */
class LowonganFactory extends Factory
{
    protected $model = Lowongan::class;

    public function definition(): array
    {
        return [
            'pengajuan_id' => \App\Models\PengajuanTenagaKerja::factory()->disetujui(),
            'hrd_id' => \App\Models\User::factory()->hrd(),
            'judul' => 'Lowongan: ' . fake()->jobTitle(),
            'banner_image' => null,
            'deskripsi' => fake()->paragraph(3),
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_selesai' => now()->addDays(30)->format('Y-m-d'),
            'status' => 'draft',
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }

    public function publikasi(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'publikasi',
        ]);
    }

    public function ditutup(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditutup',
            'tanggal_mulai' => now()->subDays(40)->format('Y-m-d'),
            'tanggal_selesai' => now()->subDays(10)->format('Y-m-d'),
        ]);
    }
}
