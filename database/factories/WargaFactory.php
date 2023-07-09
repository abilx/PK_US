<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class WargaFactory extends Factory
{
    protected $model = Warga::class;

    public function definition()
    {
        Storage::fake('public');
        return [
            // 'id_warga' => 80,
            'nik' => $this->faker->numerify('############'),
            'nama_lengkap' => $this->faker->name,
            'no_kk' => $this->faker->numerify('############'),
            'nama_kepala_keluarga' => $this->faker->name,
            'nokk_kepala_keluarga' => $this->faker->numerify('############'),
            'status_hubungan_dalam_keluarga' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'alamat' => $this->faker->address,
            'kelurahan' => 1471121003,
            'kecamatan' => 147112,
            'kabupaten' => 1471,
            'provinsi' => 14,
            'nama_dusun' => $this->faker->word,
            'kode_pos' => $this->faker->postcode,
            'tempat_lahir' => $this->faker->city,
            'tgl_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement([1, 2]),
            'agama' => 1,
            'golongan_darah' => 1,
            'pendidikan' => 1,
            'pekerjaan' => 1,
            'status_perkawinan' => $this->faker->randomElement(['belum_kawin', 'kawin', 'cerai_hidup', 'cerai']),
            'jenis_warga' => $this->faker->randomElement([0, 1]),
            'nomor_passport' => $this->faker->numerify('############'),
            'tgl_akhir_passport' => $this->faker->date(),
            'nomor_kitaskitap' => $this->faker->numerify('############'),
            'nik_ayah' => $this->faker->numerify('############'),
            'nama_ayah' => $this->faker->name,
            'nik_ibu' => $this->faker->numerify('############'),
            'nama_ibu' => $this->faker->name,
            'tgl_keluar_kk' => $this->faker->date(),
            'foto_warga' => 'no-image.png',
            'tgl_perkawinan' => $this->faker->date(),
            'akta_kawin' => $this->faker->randomNumber(),
            'akta_cerai' => $this->faker->randomNumber(),
            'tgl_cerai' => $this->faker->date(),
            'akta_kelahiran' => $this->faker->randomNumber(),
            'kelainan' => $this->faker->word,
            'email_warga' => $this->faker->email,
            'no_hp_warga' => $this->faker->phoneNumber,
            'rt' => 1,
            'rw' => 1,
            'penerima_beasiswa' => $this->faker->randomElement([0, 1]),
            'status_warga' => $this->faker->randomElement([0, 1, 3]),
            'active' => 1,
            
        ];
    }
}
