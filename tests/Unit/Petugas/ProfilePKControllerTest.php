<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\ProfilePKController as ProfileController;
use App\Models\User;
use App\Models\Warga;
use App\Models\pk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;


class ProfilePKControllerTest extends TestCase
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


    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditPk()
    {
        // Membuat data rw palsu
        $pk = PK::factory()->create();

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($pk);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rw.edit_rw'
        $this->assertEquals('Petugaskelurahan.profilePetugasKelurahan.edit_profile', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('petugas_kelurahan', $response->getData());
        
        // Memastikan bahwa data kategori rw dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdatePk()
    {
        // Membuat data rw palsu
        $pk = PK::factory()->create();
        $warga = Warga::factory()->create();

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $pk->id_pk, 'POST', [
            'id' => $pk->id_pk,
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
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $warga);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'rw.index'
        $this->assertEquals(route('pk.profile.show', $pk->id_pk), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /** @test */
    public function testUpdateUsername()
    {
        // Membuat data dummy
        $warga = Warga::factory()->create();
        $user = User::factory()->create();
        $newUsername = 'newusername';

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Membuat request dengan data yang diperlukan
        $request = new Request([
            'username' => $newUsername,
            'user_id' => $user->id,
            'id' => $user->id
        ]);

        // Memanggil method update() dari controller
        $response = $controller->update($request, $warga);

        // Memastikan redirect berhasil dilakukan
        $this->assertEquals(route('pk.profile.show', $user->id), $response->getTargetUrl());

        // Memastikan pesan berhasil ditampilkan
        $this->assertEquals('Username berhasil diubah!', session('success'));

        // Memastikan username telah berubah
        $this->assertEquals($newUsername, User::find($user->id)->username);
    }

    public function testUpdatePassword()
    {
        // Membuat data dummy
        $warga = Warga::factory()->create();
        $user = User::factory()->create();
        $newPassword = 'newpassword';

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Membuat request dengan data yang diperlukan
        $request = new Request([
            'password' => $newPassword,
            'user_id' => $user->id,
            'id' => $user->id
        ]);

        // Memanggil method update() dari controller
        $response = $controller->update($request, $warga);

        // Memastikan redirect berhasil dilakukan
        $this->assertEquals(route('pk.profile.show', $user->id), $response->getTargetUrl());
        
        // Memastikan pesan berhasil ditampilkan
        $this->assertEquals('Password berhasil diubah!', session('success'));

        // Memastikan password telah berubah
        $this->assertTrue(Hash::check($newPassword, User::find($user->id)->password));
    }


    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowPk()
    {
        // Membuat data rw palsu
        $warga = Warga::factory()->create();
        $pk = PK::factory()->create(['id_warga'=>$warga->id_warga]);

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Memanggil metode show pada controller
        $response = $controller->show($pk->id_pk);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rw.detail_rw'
        $this->assertEquals('PetugasKelurahan.ProfilePetugasKelurahan.profile-petugaskelurahan-tes', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('pk', $response->getData());
        
        // Add more assertions if needed
    }

}



