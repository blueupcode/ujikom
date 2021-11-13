<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['P', 'L']),
            'tlp' => $this->faker->numerify('+628##########'),
            'id_outlet' => 1,
        ];
    }
}
