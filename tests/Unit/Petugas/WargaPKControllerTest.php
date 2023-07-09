<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\wargaPKController as WargaController;
use App\Models\Warga;
use App\Models\User;
use App\Models\Kategoriwarga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;


class WargaPKControllerTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 3)->first();
        Auth::login($user);
    }

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexWarga()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Warga.tabel_warga'
        $this->assertEquals('PetugasKelurahan.Warga.warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaRw()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargaRw($warga->rw);
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('PetugasKelurahan.Warga.tabel_warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaLansia()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargalansia();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('PetugasKelurahan.Warga.warga-pk-lansia', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaKepala()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargakepala();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('PetugasKelurahan.Warga.warga-pk-kepala', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateWarga()
    {
        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Warga.tambah_warga'
        $this->assertEquals('PetugasKelurahan.Warga.warga-tambah-pk', $response->name());

        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreWarga()
    {
        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Menyiapkan data untuk pengujian
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

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'warga.index'
        $this->assertEquals(route('pk.warga.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditWarga()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();

        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($warga);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Warga.edit_warga'
        $this->assertEquals('PetugasKelurahan.Warga.warga-edit-pk', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateWarga()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();

        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Membuat request palsu
        $request = Request::create('/warga/' . $warga->id_warga, 'POST', [
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
        
        // Memastikan bahwa redirect route adalah 'warga.index'
        $this->assertEquals(route('pk.warga.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyWarga()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();

        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($warga);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'warga.index'
        $this->assertEquals(route('pk.warga.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowWarga()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();

        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Memanggil metode show pada controller
        $response = $controller->show($warga->id_warga);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Warga.detail_warga'
        $this->assertEquals('PetugasKelurahan.Warga.detail_warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

}



