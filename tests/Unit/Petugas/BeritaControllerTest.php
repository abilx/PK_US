<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\BeritaController;
use App\Models\Berita;
use App\Models\User;
use App\Models\KategoriBerita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class BeritaControllerTest extends TestCase
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
     * Test index method.
     *
     * @return void
     */
    public function testIndexBerita()
    {
        // Membuat data Berita palsu
        Berita::factory()->create();
        
        // Membuat instance dari BeritaController
        $controller = new BeritaController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Berita.tabel_Berita'
        $this->assertEquals('PetugasKelurahan.berita.tabel_berita', $response->name());
        
        // Memastikan bahwa data Berita dikirim ke view
        $this->assertArrayHasKey('beritas', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateBerita()
    {
        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Berita.tambah_Berita'
        $this->assertEquals('PetugasKelurahan.berita.tambah_berita', $response->name());

        // Memastikan bahwa data kategori_berita dikirim ke view
        $this->assertArrayHasKey('kategori_kegiatan', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreBerita()
    {
        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        // Menyiapkan data untuk pengujian
        $data = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => UploadedFile::fake()->image('test.jpg'),
            'kategori_berita' => 1,
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.berita.index'
        $this->assertEquals(route('pk.berita.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditBerita()
    {
        // Membuat data Berita palsu
        $Berita = Berita::factory()->create();

        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($Berita);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.berita.edit_berita'
        $this->assertEquals('PetugasKelurahan.berita.edit_berita', $response->name());
        
        // Memastikan bahwa data Berita dikirim ke view
        $this->assertArrayHasKey('berita', $response->getData());
        
        // Memastikan bahwa data kategori Berita dikirim ke view
        $this->assertArrayHasKey('kategori_kegiatan', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateBerita()
    {
        // Membuat data Berita palsu
        $Berita = Berita::factory()->create();

        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        Storage::fake('public');

        // Membuat request palsu
        $request = Request::create('/berita/' . $Berita->id, 'POST', [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => UploadedFile::fake()->image('test.jpg'),
            'kategori_berita' => 1,
            'created_at' => '2023-10-23',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $Berita);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.berita.index'
        $this->assertEquals(route('pk.berita.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyBerita()
    {
        // Membuat data Berita palsu
        $Berita = Berita::factory()->create();

        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($Berita->id);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.berita.index'
        $this->assertEquals(route('pk.berita.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowBerita()
    {
        // Membuat data Berita palsu
        $Berita = Berita::factory()->create();

        // Membuat instance dari BeritaController
        $controller = new BeritaController();

        // Memanggil metode show pada controller
        $response = $controller->show($Berita->id);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Berita.detail_Berita'
        $this->assertEquals('PetugasKelurahan.berita.detail_berita', $response->name());
        
        // Memastikan bahwa data Berita dikirim ke view
        $this->assertArrayHasKey('berita', $response->getData());
        
        // Add more assertions if needed
    }
    
}

