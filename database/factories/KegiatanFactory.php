<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    public function definition()
    {
        return [
            'nama_kegiatan' => $this->faker->sentence,
            'kategori_kegiatan' => $this->faker->numberBetween(1, 5),
            'id_penanggung_jawab' => $this->faker->unique()->randomDigit,
            'penanggung_jawab' => $this->faker->name,
            'isi_kegiatan' => $this->faker->paragraph,
            'foto_kegiatan' => 'no-image.jpg',
            'status_kegiatan' => $this->faker->randomElement([0, 1]),
            'tgl_mulai_kegiatan' => $this->faker->dateTime,
            'tgl_selesai_kegiatan' => $this->faker->dateTime,
        ];
    }
}
