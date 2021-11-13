<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_transaksi' => $this->faker->numberBetween(1, 30),
            'id_paket' => $this->faker->numberBetween(1, 5),
            'qty' => $this->faker->numberBetween(1, 10),
            'keterangan' => $this->faker->sentence(6),
        ];
    }
}
