<?php

namespace Database\Factories;

use App\Models\Sort;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sort>
 */
class SortFactory extends Factory
{
    protected $model = Sort::class;

    public function definition(): array
    {
        $score = fake()->numberBetween(1, 4);
        $decision = match ($score) {
            4 => 'resell',
            3 => 'donate',
            2 => 'repair',
            default => 'recycle',
        };

        return [
            'user_id' => User::factory(),
            'status' => Sort::STATUS_ANALYZED,
            'decision' => $decision,
            'condition_score' => $score,
            'price_low' => $decision === 'resell' ? fake()->numberBetween(10, 40) : null,
            'price_high' => $decision === 'resell' ? fake()->numberBetween(41, 80) : null,
            'brand' => fake()->optional()->randomElement(['Nike', 'Aritzia', 'H&M', 'Zara', "Levi's", 'Lululemon']),
            'category' => fake()->randomElement(['shirt', 'pants', 'dress', 'outerwear', 'shoes', 'accessory']),
            'analysis' => [
                'reasons' => ['Factory-generated sort'],
                'damages' => [],
            ],
            'analysis_source' => 'rules-only',
            'tree_version' => '1.0',
            'analyzed_at' => now(),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => Sort::STATUS_PENDING,
            'decision' => null,
            'condition_score' => null,
            'analysis' => null,
            'analyzed_at' => null,
        ]);
    }
}
