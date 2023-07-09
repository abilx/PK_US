<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\PK\PengaduanPKController as PengaduanController;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class PengaduanControllerTest extends TestCase
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

    public function testIndexPengaduan()
    {
        // Membuat instance dari PengaduanController
        $controller = new PengaduanController();

        // Memanggil metode index pada controller
        $response = $controller->index();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'PetugasKelurahan.pengaduan.tabel_pengaduan'
        $this->assertEquals('PetugasKelurahan.Pengaduan.tabel_pengaduan', $response->name());

        // Memastikan bahwa data pengaduan dikirim ke view
        $this->assertArrayHasKey('pengaduan', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    public function testShowPengaduan()
    {
        // Membuat pengaduan palsu
        $pengaduan = Pengaduan::factory()->create();

        // Membuat instance dari PengaduanController
        $controller = new PengaduanController();

        // Memanggil metode show pada controller dengan pengaduan palsu sebagai parameter
        $response = $controller->show($pengaduan);

        // Memastikan bahwa responsenya adalah objek dari kelas Pengaduan
        $this->assertInstanceOf(Pengaduan::class, $response);

        // Memastikan bahwa pengaduan yang dikembalikan adalah pengaduan yang diharapkan
        $this->assertEquals($pengaduan->id_pengaduan, $response->id_pengaduan);

        // Add more assertions if needed
    }

    public function testTanggapinPengaduan()
    {
        // Membuat data pengaduan palsu
        $pengaduan = Pengaduan::factory()->create();

        // Membuat instance dari PengaduanController
        $controller = new PengaduanController();

        // Membuat request palsu
        $request = Request::create('/pengaduan/' . $pengaduan->id_pengaduan, 'POST', [
            'id_validasi' => 1,
            'tanggapan_rw' => 'Tanggapan',
            'kategori_pengaduan' => 2,
        ]);

        // Memanggil metode tanggapin pada controller dengan parameter request
        $response = $controller->tanggapin($request);

        // Memastikan bahwa redirect telah dilakukan
        $this->assertNotNull($response);
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);

        // Memastikan bahwa redirect dilakukan ke route 'pk.pengaduan.index'
        $this->assertEquals(route('pk.pengaduan.index'), $response->getTargetUrl());

        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Pengaduan telah di validasi!', $response->getSession()->get('success'));

        // Add more assertions if needed
    }

    public function testUpdateStatusPengaduan()
    {
        // Membuat data pengaduan palsu
        $pengaduan = Pengaduan::factory()->create();

         // Membuat request palsu
         $request = Request::create('/pengaduan/updateStatus', 'POST', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'ditampilkan' => 0
        ]);

        // Membuat instance dari PengaduanController
        $controller = new PengaduanController();

        // Memanggil metode updateStatus pada controller dengan parameter request
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        // Memastikan bahwa status pengaduan telah berubah
        $pengaduan = Pengaduan::find(1);
        $this->assertEquals(1, $pengaduan->ditampilkan);

        // Memastikan bahwa response JSON berisi data yang benar
        $this->assertEquals('Status change successfully.', $response->getData()->success);
        $this->assertEquals(1, $response->getData()->status);


        //  // Memanggil metode updateStatus pada controller
        //  $response = $controller->updateStatus($request);
 
        //  // Memastikan bahwa response adalah instance dari JsonResponse
        //  $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
         
        //  // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        //  $this->assertArrayHasKey('success', $response->getData(true));

        // Add more assertions if needed
    }
}

