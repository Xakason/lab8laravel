<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_type_id' => RoomType::factory(),
            'number' => fake()->unique()->numerify('###'),
            'description' => fake()->optional()->realText(100),
            'floor' => fake()->numberBetween(1, 8),
            'night_price' => fake()->randomFloat(2, 8000, 80000),
            'beds' => fake()->numberBetween(1, 4),
            'has_balcony' => fake()->boolean(40),
        ];
    }
}
