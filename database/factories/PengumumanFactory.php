<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengumumanFactory extends Factory
{
    protected $model = Pengumuman::class;

    public function definition()
    {
        return [
            'kategori_pengumuman' => 1,
            'id_penanggung_jawab' => $this->faker->numberBetween(1, 10),
            'penanggung_jawab' => $this->faker->name,
            'judul_pengumuman' => $this->faker->sentence,
            'isi_pengumuman' => $this->faker->paragraph,
            'foto_pengumuman' => $this->faker->imageUrl(),
            'status_pengumuman' => $this->faker->numberBetween(0, 2),
            'tgl_terbit' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
