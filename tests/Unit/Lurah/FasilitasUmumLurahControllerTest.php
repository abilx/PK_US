<?php

namespace Tests\Unit\Petugas;

use App\Http\Controllers\Lurah\FasilitasUmumLurahController as FasilitasUmumController;
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


class FasilitasUmumLurahControllerTest extends TestCase
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
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.FasilitasUmum.tabel_FasilitasUmum'
        $this->assertEquals('Lurah.fasilitas.fasilitas_umum', $response->name());
        
        // Memastikan bahwa data FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('fasilitas', $response->getData());
        
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
        $this->assertEquals('Lurah.fasilitas.detail_fasilitas', $response->name());
        
        // Memastikan bahwa data FasilitasUmum dikirim ke view
        $this->assertArrayHasKey('fasilitas', $response->getData());
        
        // Add more assertions if needed
    }
}

