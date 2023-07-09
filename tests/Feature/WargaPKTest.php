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

class WargaPKTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 3)->first();
        Auth::login($user);
    }

    public function testIndexWarga()
    {
        $response = $this->get('/PK/warga');

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.warga');
    }

    public function testListWarga()
    {
        $warga = Warga::factory()->create();
        $response = $this->get("/PK/list-warga/{$warga->rw}");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.tabel_warga');
    }

    public function testWargaKepala()
    {
        $response = $this->get("/PK/warga/wargakepala");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.warga-pk-kepala');
    }

    public function testWargaMiskin()
    {
        $warga = Warga::factory()->create();
        $response = $this->get("/PK/warga/wargamiskin");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.kemiskinan.tabel_kemiskinan');
    }

    public function testWargaLansia()
    {
        $response = $this->get("/PK/warga/wargalansia");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.warga-pk-lansia');
    }

    public function testCreateWarga()
    {
        $response = $this->get('/PK/warga/tambah');

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.warga-tambah-pk');
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


        $response = $this->post('/PK/warga', $data);

        $response->assertStatus(302)
            ->assertRedirect(route('pk.warga.index'))
            ->assertSessionHas('success', 'Data berhasil ditambah!');
        $this->assertDatabaseHas('wargas', ['nik' => $data['nik']]);
    }

    public function testEditWarga()
    {
        $warga = Warga::factory()->create();

        $response = $this->get("/PK/warga/{$warga->id_warga}/edit");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.warga-edit-pk')
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

        $response = $this->put("/PK/warga/{$warga->id_warga}", $data);

        $response->assertStatus(302)
            ->assertRedirect(route('pk.warga.index'))
            ->assertSessionHas('success', 'Data berhasil diubah!');
        $this->assertDatabaseHas('wargas', ['nik' => $data['nik']]);
    }

    public function testDestroyWarga()
    {
        Storage::fake('public');

        $warga = Warga::factory()->create();

        $response = $this->delete("/PK/warga/{$warga->id_warga}");

        $response->assertStatus(302)
            ->assertRedirect(route('pk.warga.index'))
            ->assertSessionHas('success', 'data berhasil dihapus!');
        $this->assertDeleted($warga);
    }

    public function testShowWarga()
    {
        $warga = Warga::factory()->create();

        $response = $this->get("/PK/warga/detail/{$warga->id_warga}");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Warga.detail_warga')
            ->assertViewHas('warga', $warga);
    }
}

