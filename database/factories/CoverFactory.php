<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CoverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'path' => 'user/covers/default/' . $this->faker->unique()->randomElement(['cover_table', 'cover_art', 'cover_message']) . '.png'
        ];
    }
}
