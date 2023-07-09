<?php

namespace Tests\Unit\Admin;

use App\Http\Controllers\Admin\KelolaPKController as PKController;
use App\Models\PK;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class PKControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::factory()->create();
        Auth::login($user);
    }

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexPk()
    {
        // Membuat data kegiatan palsu
        PK::factory()->create();
        
        // Membuat instance dari PKController
        $controller = new PKController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_pk.tabel_pk'
        $this->assertEquals('Admin.Kelola_pk.tabel_pk', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kelola_pk', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreatePk()
    {
        // Membuat instance dari PKController
        $controller = new PKController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_pk.tambah_pk'
        $this->assertEquals('Admin.Kelola_pk.tambah_pk', $response->name());

        // Memastikan bahwa data kategori_pk dikirim ke view
        $this->assertArrayHasKey('pk', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStorePk()
    {
        // Membuat instance dari PKController
        $controller = new PKController();

        // Menyiapkan data untuk pengujian
        $data = [
            'id_warga' => 1,
            'username' => 'test_user',
            'password' => 'password',
            'tgl_awal_jabatan_petugas_kelurahan' => '2023-06-09',
            'tgl_akhir_jabatan_petugas_kelurahan' => '2024-06-09',
            'jenis_petugas' => 1,
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.index'
        $this->assertEquals(route('pk.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditPk()
    {
        // Membuat data kegiatan palsu
        $pk = PK::factory()->create();

        // Membuat instance dari PKController
        $controller = new PKController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($pk);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_pk.edit_pk'
        $this->assertEquals('Admin.Kelola_pk.edit_pk', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kelola_pk', $response->getData());
        
        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('user', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdatePk()
    {
        // Membuat data kegiatan palsu
        $pk = PK::factory()->create();

        // Membuat instance dari PKController
        $controller = new PKController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $pk->id_pk, 'POST', [
            'id_warga' => $pk->id_warga,
            'username' => 'username123',
            'password' => 'password123',
            'tgl_awal_jabatan_petugas_kelurahan' => '2023-06-09',
            'tgl_akhir_jabatan_petugas_kelurahan' => '2024-06-09',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $pk);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.index'
        $this->assertEquals(route('pk.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyPk()
    {
        // Membuat data kegiatan palsu
        $pk = PK::factory()->create();

        // Membuat instance dari PKController
        $controller = new PKController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($pk);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.index'
        $this->assertEquals(route('pk.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowPk()
    {
        // Membuat data kegiatan palsu
        $pk = PK::factory()->create();

        // Membuat instance dari PKController
        $controller = new PKController();

        // Memanggil metode show pada controller
        $response = $controller->show($pk->id_pk);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_pk.detail_pk'
        $this->assertEquals('Admin.Kelola_pk.detail_pk', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kelola_pk', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusPk()
    {
        // Membuat data kegiatan palsu
        $pk = PK::factory()->create();

        // Membuat request palsu
        $request = Request::create('/pk/updateStatus', 'POST', [
            'id_pk' => $pk->id_pk,
            'status_pk' => 0
        ]);

        // Membuat instance dari PKController
        $controller = new PKController();

        // Memanggil metode updateStatus pada controller
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
        // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        $this->assertArrayHasKey('success', $response->getData(true));

        
        // Add more assertions if needed
    }
}



