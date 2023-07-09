<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => 'example.jpg',
            'kategori_berita' => $this->faker->numberBetween(1, 5),
        ];
    }
}
