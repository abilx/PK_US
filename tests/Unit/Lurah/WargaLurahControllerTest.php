<?php

namespace Tests\Unit\Lurah;

use App\Http\Controllers\Lurah\wargaLurahController as WargaController;
use App\Models\Warga;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;


class WargaLurahControllerTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 4)->first();
        Auth::login($user);
    }

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexWarga()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('Lurah.Warga.warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaRw()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargaRw($warga->rw);
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('Lurah.Warga.tabel_warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaLansia()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargalansia();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('Lurah.Warga.warga-kelurahan-lansia', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    public function testWargaKepala()
    {
        // Membuat data warga palsu
        Warga::factory()->create();
        
        // Membuat instance dari WargaController
        $controller = new WargaController();
        
        // Memanggil metode index pada controller
        $response = $controller->wargakepala();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.tabel_warga'
        $this->assertEquals('Lurah.Warga.warga-kelurahan-kepala', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowWarga()
    {
        // Membuat data warga palsu
        $warga = Warga::factory()->create();

        // Membuat instance dari WargaController
        $controller = new WargaController();

        // Memanggil metode show pada controller
        $response = $controller->show($warga->id_warga);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Lurah.Warga.detail_warga'
        $this->assertEquals('Lurah.Warga.detail_warga', $response->name());
        
        // Memastikan bahwa data warga dikirim ke view
        $this->assertArrayHasKey('warga', $response->getData());
        
        // Add more assertions if needed
    }

}



