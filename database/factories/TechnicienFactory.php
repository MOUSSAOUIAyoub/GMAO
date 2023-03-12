<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class TechnicienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->sentence(rand(2,3)),
            'email' => $this->faker->unique()->safeEmail(),
            'adresse' => $this->faker->sentence(14),
            'tel' => $this->faker->isbn10(),
            'observation' => $this->faker->date()
        ];
    }
}
