<?php

namespace Database\Factories;

use App\Models\KonselingGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KonselingGroup>
 */
class KonselingGroupFactory extends Factory
{
    protected $model = KonselingGroup::class;

    public function definition(): array
    {
        return [
            'guru_id' => User::factory()->guru(),
            'nama' => fake()->sentence(3),
            'deskripsi' => fake()->paragraph(),
            'kuota' => fake()->numberBetween(5, 20),
            'hari' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'waktu_mulai' => fake()->time('H:i'),
            'waktu_selesai' => fake()->time('H:i'),
            'status' => 'aktif',
        ];
    }
}
