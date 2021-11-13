<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'id_outlet' => 1,
            'kode_invoice' => $this->faker->uuid(),
            'id_member' => $this->faker->numberBetween(1, 10),
            'batas_waktu' => $this->faker->dateTimeBetween(Carbon::now()->addDays(3), Carbon::now()->addDays(7)),
            'biaya_tambahan' => $this->faker->randomElement([0, 500, 1000, 2000]),
            'diskon' => $this->faker->randomElement([0, 500, 1000, 2000]),
            'pajak' => 1000,
            'status' => $this->faker->randomElement(['baru', 'proses', 'selesai', 'diambil']),
            'dibayar' => $this->faker->randomElement(['dibayar', 'belum_dibayar']),
            'id_user' => $this->faker->numberBetween(1, 2),
        ];

        if ($data['dibayar'] === 'dibayar') {
            $data['tgl_bayar'] = $this->faker->dateTimeBetween(Carbon::now()->addDays(3), Carbon::now()->addDays(7));
        } else {
            $data['tgl_bayar'] = null;
        }

        return $data;
    }
}
