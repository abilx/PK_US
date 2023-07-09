<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\KegiatanPKController as KegiatanController;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\KategoriKegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class KegiatanControllerTest extends TestCase
{
    use RefreshDatabase;

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
    public function testIndexKegiatan()
    {
        // Membuat data kegiatan palsu
        Kegiatan::factory()->create();
        
        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kegiatan.tabel_kegiatan'
        $this->assertEquals('PetugasKelurahan.Kegiatan.tabel_kegiatan', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kegiatan', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateKegiatan()
    {
        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kegiatan.tambah_kegiatan'
        $this->assertEquals('PetugasKelurahan.Kegiatan.tambah_kegiatan', $response->name());

        // Memastikan bahwa data kategori_kegiatan dikirim ke view
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
    public function testStoreKegiatan()
    {
        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Menyiapkan data untuk pengujian
        $data = [
            'nama_kegiatan' => 'Nama Kegiatan',
            'kategori_kegiatan' => 1,
            'isi_kegiatan' => 'Isi Kegiatan',
            'foto_kegiatan' => UploadedFile::fake()->image('test.jpg'),
            'tgl_mulai_kegiatan' => '2023-06-10',
            'tgl_selesai_kegiatan' => '2023-06-15',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.kegiatan.index'
        $this->assertEquals(route('pk.kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditKegiatan()
    {
        // Membuat data kegiatan palsu
        $kegiatan = Kegiatan::factory()->create();

        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($kegiatan);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kegiatan.edit_kegiatan'
        $this->assertEquals('PetugasKelurahan.Kegiatan.edit_kegiatan', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kegiatan', $response->getData());
        
        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_kegiatan', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateKegiatan()
    {
        // Membuat data kegiatan palsu
        $kegiatan = Kegiatan::factory()->create();

        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Membuat request palsu
        $request = Request::create('/kegiatan/' . $kegiatan->id_kegiatan, 'POST', [
            'nama_kegiatan' => 'Nama Kegiatan',
            'kategori_kegiatan' => 1,
            'isi_kegiatan' => 'Isi Kegiatan',
            'foto_kegiatan' => UploadedFile::fake()->image('test.jpg'),
            'tgl_mulai_kegiatan' => '2023-06-09',
            'tgl_selesai_kegiatan' => '2023-06-10'
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $kegiatan);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.kegiatan.index'
        $this->assertEquals(route('pk.kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyKegiatan()
    {
        // Membuat data kegiatan palsu
        $kegiatan = Kegiatan::factory()->create();

        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($kegiatan);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.kegiatan.index'
        $this->assertEquals(route('pk.kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowKegiatan()
    {
        // Membuat data kegiatan palsu
        $kegiatan = Kegiatan::factory()->create();

        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Memanggil metode show pada controller
        $response = $controller->show($kegiatan->id_kegiatan);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kegiatan.detail_kegiatan'
        $this->assertEquals('PetugasKelurahan.Kegiatan.detail_kegiatan', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kegiatan', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusKegiatan()
    {
        // Membuat data kegiatan palsu
        $kegiatan = Kegiatan::factory()->create();

        // Membuat request palsu
        $request = Request::create('/kegiatan/updateStatus', 'POST', [
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'status_kegiatan' => 0
        ]);

        // Membuat instance dari KegiatanController
        $controller = new KegiatanController();

        // Memanggil metode updateStatus pada controller
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
        // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        $this->assertArrayHasKey('success', $response->getData(true));

        
        // Add more assertions if needed
    }
}

