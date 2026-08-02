<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('+1 day', '+2 months');

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'starts_at' => $start,
            'ends_at' => (clone $start)->modify('+3 hours'),
            'location' => fake()->streetAddress().', Vancouver',
            'is_published' => true,
        ];
    }
}
