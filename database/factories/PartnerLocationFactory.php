<?php

namespace Database\Factories;

use App\Models\PartnerLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PartnerLocation>
 */
class PartnerLocationFactory extends Factory
{
    protected $model = PartnerLocation::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'type' => fake()->randomElement(PartnerLocation::TYPES),
            // Vancouver bounding box
            'lat' => fake()->randomFloat(6, 49.20, 49.31),
            'lng' => fake()->randomFloat(6, -123.22, -123.02),
            'address' => fake()->streetAddress().', Vancouver',
            'city' => 'Vancouver',
            'is_published' => true,
            'verified_at' => now(),
        ];
    }
}
