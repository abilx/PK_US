<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\PengumumanPKController as PengumumanController;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class PengumumanControllerTest extends TestCase
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
    public function testIndexPengumuman()
    {
        // Membuat data pengumuman palsu
        Pengumuman::factory()->create();
        
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Pengumuman.tabel_pengumuman'
        $this->assertEquals('PetugasKelurahan.Pengumuman.tabel_pengumuman', $response->name());
        
        // Memastikan bahwa data pengumuman dikirim ke view
        $this->assertArrayHasKey('pengumuman', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreatePengumuman()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Pengumuman.tambah_pengumuman'
        $this->assertEquals('PetugasKelurahan.Pengumuman.tambah_pengumuman', $response->name());

        // Memastikan bahwa data kategori_pengumuman dikirim ke view
        $this->assertArrayHasKey('kategori_pengumuman', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStorePengumuman()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Menyiapkan data untuk pengujian
        $data = [
            'kategori_pengumuman' => 1,
            'judul_pengumuman' => 'Judul Pengumuman',
            'isi_pengumuman' => 'Isi Pengumuman',
            'foto_pengumuman' =>  UploadedFile::fake()->image('avatar.jpg'),
            'status_pengumuman' => 1,
            'tgl_terbit' => '2021-12-23',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.pengumuman.index'
        $this->assertEquals(route('pk.pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditPengumuman()
    {
        // Membuat data pengumuman palsu
        $pengumuman = Pengumuman::factory()->create();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($pengumuman);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Pengumuman.edit_pengumuman'
        $this->assertEquals('PetugasKelurahan.Pengumuman.edit_pengumuman', $response->name());
        
        // Memastikan bahwa data pengumuman dikirim ke view
        $this->assertArrayHasKey('pengumuman', $response->getData());
        
        // Memastikan bahwa data kategori pengumuman dikirim ke view
        $this->assertArrayHasKey('kategori_pengumuman', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdatePengumuman()
    {
        // Membuat data pengumuman palsu
        $pengumuman = Pengumuman::factory()->create();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Membuat request palsu
        $request = Request::create('/pengumuman/' . $pengumuman->id_pengumuman, 'POST', [
            'judul_pengumuman' => 'Judul Pengumuman Baru',
            'kategori_pengumuman' => 2,
            'isi_pengumuman' => 'Isi Pengumuman Baru',
            'tgl_terbit' => '2023-06-10',
        ]);      

        // Memanggil metode update pada controller
        $response = $controller->update($request, $pengumuman);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.pengumuman.index'
        $this->assertEquals(route('pk.pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyPengumuman()
    {
        // Membuat data pengumuman palsu
        $pengumuman = Pengumuman::factory()->create();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($pengumuman);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.pengumuman.index'
        $this->assertEquals(route('pk.pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowPengumuman()
    {
        // Membuat data pengumuman palsu
        $pengumuman = Pengumuman::factory()->create();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode show pada controller
        $response = $controller->show($pengumuman->id_pengumuman);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Pengumuman.detail_pengumuman'
        $this->assertEquals('PetugasKelurahan.Pengumuman.detail_pengumuman', $response->name());
        
        // Memastikan bahwa data pengumuman dikirim ke view
        $this->assertArrayHasKey('pengumuman', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusPengumuman()
    {
        // Membuat data pengumuman palsu
        $pengumuman = Pengumuman::factory()->create();

        // Membuat request palsu
        $request = Request::create('/pengumuman/updateStatus', 'POST', [
            'id_pengumuman' => $pengumuman->id_pengumuman,
            'status_pengumuman' => 0
        ]);

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode updateStatus pada controller
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
        // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        $this->assertArrayHasKey('success', $response->getData(true));

        
        // Add more assertions if needed
    }
}



