<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\FasilitasUmumPKController as FasilitasUmumController;
use App\Models\Fasilitas_umum;
use App\Models\User;
use App\Models\KategoriFasilitasUmum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class FasilitasUmumControllerTest extends TestCase
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
    public function testIndexFasilitasUmum()
    {
        // Membuat data FasilitasUmum palsu
        Fasilitas_umum::factory()->create();
        
        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.FasilitasUmum.tabel_FasilitasUmum'
        $this->assertEquals('PetugasKelurahan.fasilitas.fasilitas_umum', $response->name());
        
        // Memastikan bahwa data FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('fasilitas', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateFasilitasUmum()
    {
        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah Fasilitas
        $this->assertEquals('PetugasKelurahan.fasilitas.tambah_fasilitas', $response->name());

        // Memastikan bahwa data kategori_fasilitas dikirim ke view
        $this->assertArrayHasKey('kategori_fasilitas', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreFasilitasUmum()
    {
        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Menyiapkan data untuk pengujian
        $data = [
            'kategori_fasilitas_umum' => 1,
            'fasilitas_umum' => 'Nama Fasilitas',
            'deskripsi_fasilitas' => 'Deskripsi fasilitas',
            'koordinant_fasilitas' => 'koordinat',
            'foto_fasilitas' => UploadedFile::fake()->image('test.jpg'),
            'alamat_fasilitas' => 'Alamat fasilitas',

        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.fasilitas.index'
        $this->assertEquals(route('pk.fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditFasilitasUmum()
    {
        // Membuat data FasilitasUmum palsu
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($FasilitasUmum);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.FasilitasUmum.edit_FasilitasUmum'
        $this->assertEquals('PetugasKelurahan.fasilitas.edit_fasilitas', $response->name());
        
        // Memastikan bahwa data FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('fasilitas', $response->getData());
        
        // Memastikan bahwa data kategori FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('kategori_fasilitas', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateFasilitasUmum()
    {
        // Membuat data FasilitasUmum palsu
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Membuat request palsu
        $request = Request::create('/fasilitas/' . $FasilitasUmum->id_fasilitas, 'POST', [
            'kategori_fasilitas_umum' => 1,
            'rt' => null,
            'rw' => 1,
            'fasilitas_umum' => 'Nama Fasilitas Update',
            'deskripsi_fasilitas' => 'Deskripsi fasilitas Update',
            'koordinant_fasilitas' => 'null',
            'foto_fasilitas' => UploadedFile::fake()->image('test.jpg'),
            'status_fasilitas' => 1,
            'alamat_fasilitas' => 'Alamat fasilitas Update',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $FasilitasUmum);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.FasilitasUmum.index'
        $this->assertEquals(route('pk.fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyFasilitasUmum()
    {
        // Membuat data FasilitasUmum palsu
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($FasilitasUmum);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.FasilitasUmum.index'
        $this->assertEquals(route('pk.fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowFasilitasUmum()
    {
        // Membuat data FasilitasUmum palsu
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        // Membuat instance dari FasilitasUmumController
        $controller = new FasilitasUmumController();

        // Memanggil metode show pada controller
        $response = $controller->show($FasilitasUmum->id_fasilitas_umum);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah Fasilitas
        $this->assertEquals('PetugasKelurahan.fasilitas.detail_fasilitas', $response->name());
        
        // Memastikan bahwa data FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('fasilitas', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    // public function testUpdateStatusFasilitasUmum()
    // {
    //     // Membuat data FasilitasUmum palsu
    //     $FasilitasUmum = Fasilitas_umum::factory()->create();

    //     // Membuat request palsu
    //     $request = Request::create('/fasilitas/updateStatus', 'POST', [
    //         'id_fasilitas_umum' => $FasilitasUmum->id_fasilitas_umum,
    //         'status_fasilitas' => 0
    //     ]);

    //     // Membuat instance dari FasilitasUmumController
    //     $controller = new FasilitasUmumController();

    //     // Memanggil metode updateStatus pada controller
    //     $response = $controller->updateStatus($request);

    //     // Memastikan bahwa response adalah instance dari JsonResponse
    //     $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
    //     // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
    //     $this->assertArrayHasKey('success', $response->getData(true));

        
    //     // Add more assertions if needed
    // }
}

