<?php

namespace Tests\Unit\LP;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Warga\LPController;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Models\Warga;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Fasilitas_umum;
use App\Models\Kegiatan;
use App\Models\Pengaduan;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\JsonResponse;

class LPControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }
    
    public function testHome()
    {

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method home() pada controller
        $response = $lpController->home();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'index'
        $this->assertEquals('index', $response->name());

        // Memastikan bahwa variabel-variabel pada view telah di-set dengan benar
        $this->assertArrayHasKey('title', $response->getData());
        $this->assertArrayHasKey('warga', $response->getData());
    }

    public function testKegiatan()
    {

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method kegiatan() pada controller
        $response = $lpController->kegiatan();

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.kegiatan.kegiatan'
        $this->assertEquals('Warga.kegiatan.kegiatan', $response->name());

        // Memastikan bahwa variabel 'kegiatan' pada view mengandung data kegiatan yang sesuai
        $this->assertArrayHasKey('kegiatan', $response->getData());
    }

    public function testKegiatanShow()
    {
        // Membuat data kegiatan untuk pengujian
        $kegiatan = Kegiatan::factory()->create();

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method kegiatan_show() pada controller dengan parameter id kegiatan
        $response = $lpController->kegiatan_show($kegiatan->id_kegiatan);

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.kegiatan.detail_kegiatan'
        $this->assertEquals('Warga.kegiatan.detail_kegiatan', $response->name());

        // Memastikan bahwa variabel 'kegiatan' pada view mengandung data kegiatan yang sesuai
        $this->assertArrayHasKey('kegiatan', $response->getData());
    }

    public function testPengumuman()
    {

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method pengumuman() pada controller
        $response = $lpController->pengumuman();

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.pengumuman.pengumuman'
        $this->assertEquals('Warga.pengumuman.pengumuman', $response->name());

        // Memastikan bahwa variabel 'pengumuman' pada view mengandung data pengumuman yang sesuai
        $this->assertArrayHasKey('pengumuman', $response->getData());
    }

    public function testPengumumanShow()
    {
        // Membuat data pengumuman untuk pengujian
        $pengumuman = Pengumuman::factory()->create();

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method pengumuman_show() pada controller dengan parameter id pengumuman
        $response = $lpController->pengumuman_show($pengumuman->id_pengumuman);

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.pengumuman.detail_pengumuman'
        $this->assertEquals('Warga.pengumuman.detail_pengumuman', $response->name());

        // Memastikan bahwa variabel 'pengumuman' pada view mengandung data pengumuman yang sesuai
        $this->assertArrayHasKey('pengumuman', $response->getData());
    }

    public function testFasilitas()
    {
        // Membuat data fasilitas umum untuk pengujian
        $fasilitas = Fasilitas_umum::factory()->count(10)->create(['status_fasilitas' => 1]);

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method fasilitas() pada controller
        $response = $lpController->fasilitas();

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.fasilitas.fasilitas'
        $this->assertEquals('Warga.fasilitas.fasilitas', $response->name());

        // Memastikan bahwa variabel 'fasilitas' pada view mengandung data fasilitas umum yang sesuai
        $this->assertArrayHasKey('fasilitas', $response->getData());
    }

    public function testFasilitasShow()
    {
        // Membuat data fasilitas umum untuk pengujian
        $fasilitas = Fasilitas_umum::factory()->create();

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method fasilitas_show() pada controller dengan parameter id fasilitas
        $response = $lpController->fasilitas_show($fasilitas->id_fasilitas);

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.fasilitas.detail_fasilitas'
        $this->assertEquals('Warga.fasilitas.detail_fasilitasw', $response->name());

        // Memastikan bahwa variabel 'fasilitas' pada view mengandung data fasilitas umum yang sesuai
        $this->assertArrayHasKey('fasilitas', $response->getData());
    }

    public function testBerita()
    {
        // Membuat data fasilitas umum untuk pengujian
        $fasilitas = Fasilitas_umum::factory()->count(10)->create(['status_fasilitas' => 1]);

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method fasilitas() pada controller
        $response = $lpController->berita();

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.fasilitas.fasilitas'
        $this->assertEquals('Warga.berita.berita', $response->name());

        // Memastikan bahwa variabel 'fasilitas' pada view mengandung data fasilitas umum yang sesuai
        $this->assertArrayHasKey('berita', $response->getData());
    }

    public function testBeritaShow()
    {
        // Membuat data fasilitas umum untuk pengujian
        $fasilitas = Fasilitas_umum::factory()->create();

        // Instansiasi controller LPController
        $lpController = new LPController();

        // Memanggil method fasilitas_show() pada controller dengan parameter id fasilitas
        $response = $lpController->berita_show($fasilitas->id_fasilitas);

        // Memastikan bahwa response statusnya adalah instance dari Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah view 'Warga.fasilitas.detail_fasilitas'
        $this->assertEquals('Warga.berita.detail_berita', $response->name());

        // Memastikan bahwa variabel 'fasilitas' pada view mengandung data fasilitas umum yang sesuai
        $this->assertArrayHasKey('berita', $response->getData());
    }

    public function testStorePengaduan()
    {

        // Membuat instance dari LPController
        $lpController = new LPController();

        // Membuat data pengaduan
        $warga = Warga::factory()->create();
        $data = [
            'judul_pengaduan' => 'Judul Pengaduan',
            'deskripsi_pengaduan' => 'Deskripsi Pengaduan',
            'kategori_pengaduan' => '1',
            'bukti_pengaduan' => UploadedFile::fake()->image('pengaduan.jpg'),
            'nik' => $warga->nik,
            'rt' => $warga->rt,
        ];


        // Memanggil metode store_pengaduan() pada LPController
        $response = $lpController->store_pengaduan(new Request($data));

        // Memastikan pengaduan berhasil disimpan
        $this->assertDatabaseHas('pengaduans', ['judul_pengaduan' => 'Judul Pengaduan']);

        // Memastikan redirect response
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);

        // Memastikan bahwa redirect route adalah 'pk.kegiatan.index'
        $this->assertEquals(route('warga.dashboard.home'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
    }

    public function testCekWarga()
    {
        // Membuat instance dari LPController
        $lpController = new LPController();

        // Membuat data warga
        $warga = Warga::factory()->create();
        $data = [
            'id' => $warga->nik,
        ];

        // Memanggil metode cek_warga() pada LPController
        $response = $lpController->cek_warga(new Request($data));

        // Memastikan response sukses
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        // Memastikan data warga ditemukan
        $this->assertEquals('Data ditemukan.', $responseData['success']);
        $this->assertEquals($warga->id_warga, $responseData['data']['id_warga']);
    }

}

