<?php

namespace Tests\Unit\RW;

use App\Http\Controllers\RW\KegiatanController as KegiatanController;
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


class KegiatanRWControllerTest extends TestCase
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
        
        // Memastikan bahwa view yang digunakan adalah 'RW.Kegiatan.tabel_kegiatan'
        $this->assertEquals('RW.Kegiatan.kegiatan_warga', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kegiatan', $response->getData());
        
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
        
        // Memastikan bahwa view yang digunakan adalah 'RW.Kegiatan.detail_kegiatan'
        $this->assertEquals('RW.Kegiatan.detail_kegiatan_warga', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kegiatan', $response->getData());
        
        // Add more assertions if needed
    }
}

