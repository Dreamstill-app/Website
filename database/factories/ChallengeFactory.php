<?php

namespace Database\Factories;

use App\Models\Challenge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Challenge>
 */
class ChallengeFactory extends Factory
{
    protected $model = Challenge::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'points' => fake()->randomElement([10, 20, 30, 50]),
            'metric' => 'sorts_count',
            'target' => fake()->numberBetween(1, 10),
            'is_published' => true,
        ];
    }
}
