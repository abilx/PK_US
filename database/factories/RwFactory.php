<?php

namespace Database\Factories;
use App\Models\rw;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RwFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = rw::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id; // Menggunakan factory User untuk membuat user baru dan mengambil ID-nya
            },
            'no_rw' => '01',
            'id_warga' => 1,
            'ketua_rw' => 'M. Alparadi, M.Pd',
            'tgl_awal_jabatan_rw' => '2023-05-05 14:16:00',
            'tgl_akhir_jabatan_rw' => '2023-06-02 14:16:00',
            'status_rw' => 1,
            'created_at' => '2023-05-05 07:16:37',
            'updated_at' => '2023-05-05 07:16:42',
            'deleted_at' => null,
        ];
    }
}
