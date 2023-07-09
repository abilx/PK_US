<?php

namespace Database\Factories;

use App\Models\PetugasKelurahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetugasKelurahanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PetugasKelurahan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'id_warga' => $this->faker->randomNumber(),
            'tgl_awal_jabatan_petugas_kelurahan' => $this->faker->dateTime(),
            'tgl_akhir_jabatan_petugas_kelurahan' => $this->faker->dateTime(),
            'status_pk' => $this->faker->randomElement([0, 1]),
        ];
    }
}
