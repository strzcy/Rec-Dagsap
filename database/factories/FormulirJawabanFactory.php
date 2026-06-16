<?php

namespace Database\Factories;

use App\Models\FormulirJawaban;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormulirJawaban>
 */
class FormulirJawabanFactory extends Factory
{
    protected $model = FormulirJawaban::class;

    public function definition(): array
    {
        return [
            'pelamar_id' => \App\Models\Pelamar::factory(),
            'field_name' => 'ipk',
            'jawaban' => number_format(fake()->randomFloat(2, 2.50, 4.00), 2),
        ];
    }
}
