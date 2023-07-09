<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Warga;

class PKFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'id_warga' => function () {
                return Warga::factory()->create()->id_warga;
            },
            'tgl_awal_jabatan_petugas_kelurahan' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'tgl_akhir_jabatan_petugas_kelurahan' => $this->faker->dateTimeBetween('now', '+2 years'),
            'status_pk' => $this->faker->randomElement([0, 1]),
        ];
    }
}
