<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Стандарт',
                'Комфорт',
                'Полулюкс',
                'Люкс',
            ]),
            'capacity' => fake()->numberBetween(1, 4),
        ];
    }
}
