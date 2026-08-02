<?php

namespace Database\Factories;

use App\Models\Fact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fact>
 */
class FactFactory extends Factory
{
    protected $model = Fact::class;

    public function definition(): array
    {
        return [
            'text' => fake()->sentence(12),
            'category' => fake()->randomElement(['climate', 'waste', 'water', 'repair', 'care']),
            'is_published' => true,
        ];
    }
}
