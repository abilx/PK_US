<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\KelolaRWPKController as RWController;
use App\Models\rw;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class RWPKControllerTest extends TestCase
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
    public function testIndexRw()
    {
        // Membuat data rw palsu
        rw::factory()->create();
        
        // Membuat instance dari RWController
        $controller = new RWController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kelola_rtrw.rw.tabel_rw'
        $this->assertEquals('PetugasKelurahan.Kelola_rtrw.rw.tabel_rw', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('kelola_rw', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateRw()
    {
        // Membuat instance dari RWController
        $controller = new RWController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kelola_rtrw.rw.tambah_rw'
        $this->assertEquals('PetugasKelurahan.Kelola_rtrw.rw.tambah_rw', $response->name());

        // Memastikan bahwa data kategori_rw dikirim ke view
        $this->assertArrayHasKey('rw', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreRw()
    {
        // Membuat instance dari RWController
        $controller = new RWController();

        // Menyiapkan data untuk pengujian
        $data = [
            'id_warga' => 11,
            'username' => 'username123',
            'password' => 'password123',
            'no_rw' => 'RW001',
            'tgl_awal_jabatan_rw' => '2023-06-01',
            'tgl_akhir_jabatan_rw' => '2023-06-30',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);

        // Memastikan bahwa redirect route adalah 'rw.index'
        $this->assertEquals(route('pk.rw.index'), $response->getTargetUrl());
        // $response->ddSession();
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('error'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditRw()
    {
        // Membuat data rw palsu
        $rw = rw::factory()->create();

        // Membuat instance dari RWController
        $controller = new RWController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($rw);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kelola_rtrw.rw.edit_rw'
        $this->assertEquals('PetugasKelurahan.Kelola_rtrw.rw.edit_rw', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('user', $response->getData());
        
        // Memastikan bahwa data kategori rw dikirim ke view
        $this->assertArrayHasKey('kelola_rw', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateRw()
    {
        // Membuat data rw palsu
        $rw = rw::factory()->create();

        // Membuat instance dari RWController
        $controller = new RWController();

        // Membuat request palsu
        $request = Request::create('/rw/' . $rw->id_rw, 'POST', [
            'id_warga' => $rw->id_warga,
            'username' => 'username123',
            'password' => 'password123',
            'no_rw' => 'RW002',
            'tgl_awal_jabatan_rw' => '2023-07-01',
            'tgl_akhir_jabatan_rw' => '2023-07-31',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $rw);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.rw.index'
        $this->assertEquals(route('pk.rw.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyRw()
    {
        // Membuat data rw palsu
        $rw = rw::factory()->create();

        // Membuat instance dari RWController
        $controller = new RWController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($rw);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'pk.rw.index'
        $this->assertEquals(route('pk.rw.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowRw()
    {
        // Membuat data rw palsu
        $rw = rw::factory()->create();

        // Membuat instance dari RWController
        $controller = new RWController();

        // Memanggil metode show pada controller
        $response = $controller->show($rw->id_rw);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.Kelola_rtrw.rw.detail_rw'
        $this->assertEquals('PetugasKelurahan.Kelola_rtrw.rw.detail_rw', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('identitas_rw', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusRw()
    {
        // Membuat data rw palsu
        $rw = rw::factory()->create();

        // Membuat request palsu
        $request = Request::create('/rw/updateStatus', 'POST', [
            'id_rw' => $rw->id_rw,
            'status_rw' => 0
        ]);

        // Membuat instance dari RWController
        $controller = new RWController();

        // Memanggil metode updateStatus pada controller
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
        // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        $this->assertArrayHasKey('success', $response->getData(true));

        
        // Add more assertions if needed
    }
}

