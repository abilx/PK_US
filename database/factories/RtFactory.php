<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => NULL,
            'id_rw' => 1,
            'username' => NULL,
            'password' => NULL,
            'no_rt' => '01',
            'id_warga' => 1,
            'ketua_rt' => 'Sarifudin',
            'tgl_awal_jabatan_rt' => '2023-05-31 22:19:45',
            'tgl_akhir_jabatan_rt' => '2023-06-30 22:19:45',
            'status_rt' => 0,
            'created_at' => '2023-05-31 22:19:45',
            'updated_at' => NULL,
            'deleted_at' => NULL,
        ];
    }
}
