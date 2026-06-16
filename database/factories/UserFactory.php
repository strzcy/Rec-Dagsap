<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake('id_ID')->name();
        $cleanFirstName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', explode(' ', $name)[0] ?? 'user'));
        $username = $cleanFirstName . fake()->unique()->numberBetween(100, 9999);

        return [
            'username' => $username,
            'name' => $name,
            'email' => $username . '@dagsap.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'divisi',
            'divisi_id' => null,
            'managed_divisi_id' => null,
            'no_telepon' => '628' . fake()->numberBetween(111111111, 999999999),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * State for HRD role.
     */
    public function hrd(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'hrd',
        ]);
    }

    /**
     * State for Management role.
     */
    public function management(?int $divisiId = null): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'management',
            'managed_divisi_id' => $divisiId,
        ]);
    }

    /**
     * State for Divisi user role.
     */
    public function divisi(?int $divisiId = null): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'divisi',
            'divisi_id' => $divisiId,
        ]);
    }
}

