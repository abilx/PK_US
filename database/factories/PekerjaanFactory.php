<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PekerjaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pekerjaan' => 1,
            'nama_pekerjaan' => 'BELUM/TIDAK BEKERJA'

             
        ];
    }
}
