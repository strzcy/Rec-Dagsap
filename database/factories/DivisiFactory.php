<?php

namespace Database\Factories;

use App\Models\Divisi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Divisi>
 */
class DivisiFactory extends Factory
{
    protected $model = Divisi::class;

    public function definition(): array
    {
        $namaDivisi = fake()->unique()->words(2, true);
        $kodeDivisi = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $namaDivisi), 0, 5)) . fake()->unique()->numberBetween(10, 99);

        return [
            'nama_divisi' => ucwords($namaDivisi),
            'kode_divisi' => $kodeDivisi,
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
