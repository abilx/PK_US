<?php

namespace Database\Factories;

use App\Models\fasilitas_umum;
use Illuminate\Database\Eloquent\Factories\Factory;

class fasilitas_umumFactory extends Factory
{
    protected $model = fasilitas_umum::class;

    public function definition()
    {
        return [
            'kategori_fasilitas_umum' => $this->faker->numberBetween(1, 5),
            'rt' => null,
            'rw' => 1,
            'fasilitas_umum' => $this->faker->word,
            'deskripsi_fasilitas' => $this->faker->paragraph,
            'koordinant_fasilitas' => null,
            'foto_fasilitas' => 'example.jpg',
            'status_fasilitas' => $this->faker->randomElement([0, 1]),
            'alamat_fasilitas' => $this->faker->address,
        ];
    }
}
