<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Warga;
use App\Models\User;
use App\Models\rw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;


class ProfileRWTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 4)->first();
        Auth::login($user);
    }

    public function testShowRw()
    {
        $warga = Warga::factory()->create();
        $rw = rw::factory()->create(['id_warga'=>$warga->id_warga]);

        $response = $this->get(route('rw.profile.show', $rw->id_rw));
        // $response->ddSession();
        $response->assertStatus(200);
        $response->assertViewIs('RW.ProfileRW.profile-rw-tes');
        $response->assertViewHas('rw');
        $response->assertViewHas('keluarga');
        $response->assertViewHas('title', 'profile-rw');
    }

    public function testEditRw()
    {
        $warga = Warga::factory()->create();
        $rw = rw::factory()->create(['id_warga'=>$warga->id_warga]);

        $response = $this->get(route('rw.profile.edit', $rw));

        $response->assertStatus(200);
        $response->assertViewIs('RW.profileRW.edit_profile');
        $response->assertViewHas('rw');
        $response->assertViewHas('warga');
        $response->assertViewHas('title', 'edit-profile');
    }

    public function testUpdateRw()
    {
        $warga = Warga::factory()->create();
        $rw = rw::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'id' => $rw->id_rw,
            'id_warga' => $rw->id_warga,
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

        $response = $this->put(route('rw.profile.update', $rw), $data);

        $this->assertDatabaseHas('rws', [
            'id_rw' => $rw->id_rw,
            'id_warga' => $data['id_warga'],
        ]);

        $response->assertRedirect(route('rw.profile.show', $rw->id_rw));
        $response->assertSessionHas('success', 'Data berhasil diubah!');
    }

    public function testUpdateUsername()
    {
        $warga = Warga::factory()->create();
        $rw = rw::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'username' => 'usernamebaru',
            'user_id' => $rw->user_id,
            'id' => $rw->id_rw

        ];

        $response = $this->put(route('rw.profile.update', $rw), $data);

        $this->assertDatabaseHas('users', [
            'username' => 'usernamebaru',
        ]);

        $response->assertRedirect(route('rw.profile.show', $rw->id_rw));
        $response->assertSessionHas('success', 'Username berhasil diubah!');
    }

    public function testUpdatePassword()
    {
        $warga = Warga::factory()->create();
        $rw = rw::factory()->create(['id_warga'=>$warga->id_warga]);

        $data = [
            'password' => 'passwordbaru',
            'user_id' => $rw->user_id,
            'id' => $rw->id_rw

        ];

        $response = $this->put(route('rw.profile.update', $rw), $data);

        $password = Hash::check('passwordbarus', User::find($rw->user_id)->password);

        $this->assertDatabaseHas('users', [
            'password' => $password,
        ]);

        $response->assertRedirect(route('rw.profile.show', $rw->id_rw));
        $response->assertSessionHas('success', 'Password berhasil diubah!');
    }


}

