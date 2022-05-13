<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
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
            'full_address' => $this->faker->address(),
            'apartment' => $this->faker->word(),
            'postcode' => $this->faker->text(20),
            'contact_person_name' => $this->faker->firstName(),
            'contact_person_phone' => $this->faker->numerify('+27#########'),
        ];
    }
}
