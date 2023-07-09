<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PendidikanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pendidikan' => 1, 
            'nama_pendidikan' => 'Tidak / Belum Sekolah'
        ];
    }
}
