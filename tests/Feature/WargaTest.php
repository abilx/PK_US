<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class WargaTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::factory()->create();
        Auth::login($user);
    }

    public function testIndexWarga()
    {
        $response = $this->get('/warga');

        $response->assertStatus(200)
            ->assertViewIs('Admin.Warga.tabel_warga');
    }

    public function testCreateWarga()
    {
        $response = $this->get('/warga/tambah');

        $response->assertStatus(200)
            ->assertViewIs('Admin.Warga.warga-tambah-rw');
    }

    public function testStoreWarga()
    {

        Storage::fake('public');

        $data = [
            'nik' => $this->faker->numerify('############'),
            'nama_lengkap' => $this->faker->name,
            'no_kk' => $this->faker->numerify('############'),
            'nama_kepala_keluarga' => $this->faker->name,
            'nokk_kepala_keluarga' => $this->faker->numerify('############'),
            'status_hubungan_dalam_keluarga' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'alamat' => $this->faker->address,
            'kelurahan' => $this->faker->randomNumber(),
            'kecamatan' => $this->faker->randomNumber(),
            'kabupaten' => $this->faker->randomNumber(),
            'provinsi' => $this->faker->randomNumber(),
            'nama_dusun' => $this->faker->word,
            'kode_pos' => $this->faker->postcode,
            'tempat_lahir' => $this->faker->city,
            'tgl_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement([1, 2]),
            'agama' => $this->faker->randomNumber(),
            'golongan_darah' => $this->faker->randomNumber(),
            'pendidikan' => $this->faker->randomNumber(),
            'pekerjaan' => $this->faker->randomNumber(),
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
            'foto_warga' => UploadedFile::fake()->image('avatar.jpg'),
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


        $response = $this->post('/warga', $data);

        $response->assertStatus(302)
            ->assertRedirect(route('warga.index'))
            ->assertSessionHas('success', 'Data berhasil ditambah!');
        $this->assertDatabaseHas('wargas', ['nik' => $data['nik']]);
    }

    public function testEditWarga()
    {
        $warga = Warga::factory()->create();

        $response = $this->get("/warga/{$warga->id_warga}/edit");

        $response->assertStatus(200)
            ->assertViewIs('Admin.Warga.warga-edit-rw')
            ->assertViewHas('warga', $warga);
    }

    public function testUpdateWarga()
    {
        Storage::fake('public');

        $warga = Warga::factory()->create();

        $data = [
            'nik' => $this->faker->numerify('############'),
            'nama_lengkap' => $this->faker->name,
            'no_kk' => $this->faker->numerify('############'),
            'nama_kepala_keluarga' => $this->faker->name,
            'nokk_kepala_keluarga' => $this->faker->numerify('############'),
            'status_hubungan_dalam_keluarga' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'alamat' => $this->faker->address,
            'kelurahan' => $this->faker->randomNumber(),
            'kecamatan' => $this->faker->randomNumber(),
            'kabupaten' => $this->faker->randomNumber(),
            'provinsi' => $this->faker->randomNumber(),
            'nama_dusun' => $this->faker->word,
            'kode_pos' => $this->faker->postcode,
            'tempat_lahir' => $this->faker->city,
            'tgl_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement([1, 2]),
            'agama' => $this->faker->randomNumber(),
            'golongan_darah' => $this->faker->randomNumber(),
            'pendidikan' => $this->faker->randomNumber(),
            'pekerjaan' => $this->faker->randomNumber(),
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
            'foto_warga' => UploadedFile::fake()->image('avatar.jpg'),
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

        $response = $this->put("/warga/{$warga->id_warga}", $data);

        $response->assertStatus(302)
            ->assertRedirect(route('warga.index'))
            ->assertSessionHas('success', 'Data berhasil diubah!');
        $this->assertDatabaseHas('wargas', ['nik' => $data['nik']]);
    }

    public function testDestroyWarga()
    {
        Storage::fake('public');

        $warga = Warga::factory()->create();

        $response = $this->delete("/warga/{$warga->id_warga}");

        $response->assertStatus(302)
            ->assertRedirect(route('warga.index'))
            ->assertSessionHas('success', 'data berhasil dihapus!');
        $this->assertDeleted($warga);
    }

    public function testShowWarga()
    {
        $warga = Warga::factory()->create();

        $response = $this->get("/warga/{$warga->id_warga}");

        $response->assertStatus(200)
            ->assertViewIs('Admin.Warga.detail_warga')
            ->assertViewHas('warga', $warga);
    }
}

