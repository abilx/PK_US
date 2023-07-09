<?php

namespace Database\Factories;

use App\Models\WargaMiskin;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class WargaMiskinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = WargaMiskin::class;

    public function definition()
    {
        return [
            'warga' => function () {
                return \App\Models\Warga::factory()->create()->id_warga;
            },
            'bukti' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->text(),
        ];
    }
}

