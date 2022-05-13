<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3]),
            'name' => $this->faker->text(20),
            'pages' => $this->faker->randomElement([50, 100]),
            'cover_id' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
