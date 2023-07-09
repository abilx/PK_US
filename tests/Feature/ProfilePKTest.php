<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Warga;
use App\Models\User;
use App\Models\PK;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;


class ProfilePKTest extends TestCase
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

    public function testShowPk()
    {
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        $response = $this->get(route('pk.profile.show', $pk->id_pk));
        // $response->ddSession();
        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.ProfilePetugasKelurahan.profile-petugaskelurahan-tes');
        $response->assertViewHas('pk');
        $response->assertViewHas('keluarga');
        $response->assertViewHas('title', 'profile-pk');
    }

    public function testEditPk()
    {
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        $response = $this->get(route('pk.profile.edit', $pk));

        $response->assertStatus(200);
        $response->assertViewIs('Petugaskelurahan.profilePetugasKelurahan.edit_profile');
        $response->assertViewHas('petugas_kelurahan');
        $response->assertViewHas('warga');
        $response->assertViewHas('title', 'edit-profile');
    }

    public function testUpdatePk()
    {
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'id' => $pk->id_pk,
            'id_warga' => $pk->id_warga,
            'tgl_awal_jabatan_petugas_kelurahan' => '2023-06-09',
            'tgl_akhir_jabatan_petugas_kelurahan' => '2024-06-09',
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

        $response = $this->put(route('pk.profile.update', $pk), $data);

        $this->assertDatabaseHas('petugas_kelurahan', [
            'id_pk' => $pk->id_pk,
            'id_warga' => $data['id_warga'],
        ]);

        $response->assertRedirect(route('pk.profile.show', $pk->id_pk));
        $response->assertSessionHas('success', 'Data berhasil diubah!');
    }

    public function testUpdateUsername()
    {
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'username' => 'usernamebaru',
            'user_id' => $pk->user_id,
            'id' => $pk->id_pk

        ];

        $response = $this->put(route('pk.profile.update', $pk), $data);

        $this->assertDatabaseHas('users', [
            'username' => 'usernamebaru',
        ]);

        $response->assertRedirect(route('pk.profile.show', $pk->id_pk));
        $response->assertSessionHas('success', 'Username berhasil diubah!');
    }

    public function testUpdatePassword()
    {
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'password' => 'passwordbaru',
            'user_id' => $pk->user_id,
            'id' => $pk->id_pk

        ];

        $response = $this->put(route('pk.profile.update', $pk), $data);

        $password = Hash::check('passwordbarus', User::find($pk->user_id)->password);

        $this->assertDatabaseHas('users', [
            'password' => $password,
        ]);

        $response->assertRedirect(route('pk.profile.show', $pk->id_pk));
        $response->assertSessionHas('success', 'Password berhasil diubah!');
    }


}

