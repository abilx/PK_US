<?php

namespace Tests\Unit\Lurah;

use App\Http\Controllers\Lurah\PengaduanLurahController as PengaduanController;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class PengaduanLurahControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 2)->first();
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

        // Memastikan bahwa view yang digunakan adalah 'Lurah.pengaduan.tabel_pengaduan'
        $this->assertEquals('Lurah.Pengaduan.tabel_pengaduan', $response->name());

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
}

