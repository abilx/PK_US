<?php

namespace Database\Factories;

use App\Models\pengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengaduanFactory extends Factory
{
    protected $model = pengaduan::class;

    public function definition()
    {
        return [
            'judul_pengaduan' => $this->faker->sentence,
            'nik' => $this->faker->unique()->randomNumber(9),
            'kategori_pengaduan' => $this->faker->numberBetween(1, 2),
            'deskripsi_pengaduan' => $this->faker->paragraph,
            'bukti_pengaduan' => $this->faker->imageUrl(),
            'tanggapan_pengaduan' => null,
            'id_rt' => $this->faker->numberBetween(1, 10),
            'status_pengaduan' => 0,
            'ditampilkan' => 1,
        ];
    }
}
