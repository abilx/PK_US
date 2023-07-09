<?php

namespace Tests\Unit\Admin;

use App\Http\Controllers\Admin\KategoriPengumumanController as PengumumanController;
use App\Http\Controllers\Admin\KategoriKegiatanController as KegiatanController;
use App\Http\Controllers\Admin\KategoriPengaduanController as PengaduanController;
use App\Http\Controllers\Admin\KategoriFasilitasUmumController as FasilitasController;
use App\Models\KategoriPengumuman;
use App\Models\KategoriKegiatan;
use App\Models\KategoriPengaduan;
use App\Models\Kategori_fasilitas_umum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class UtilitasControllerTest extends TestCase
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

    // Kategori Pengumuman

    public function testIndexKateogriPengumuman()
    {
        
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tabel_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengumuman.tabel_kategori_pengumuman', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_pengumuman', $response->getData());
        
        // Add more assertions if needed
    }

    public function testCreateKateogriPengumuman()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tambah_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengumuman.tambah_kategori_pengumuman', $response->name());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    public function testStoreKateogriPengumuman()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Menyiapkan data untuk pengujian
        $data = [
            'nama_kategori_pengumuman' => 'nama_kategori_pengumuman',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testEditKateogriPengumuman()
    {
        $data = KategoriPengumuman::All()->first();
        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($data);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.edit_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengumuman.edit_kategori_pengumuman', $response->name());

        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_pengumuman', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());
        
        // Add more assertions if needed
    }

    public function testUpdateKateogriPengumuman()
    {
        // Membuat data kegiatan palsu
        $data = KategoriPengumuman::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $data->id_kategori_pengumuman, 'POST', [
            'nama_kategori_pengumuman' => 'nama_kategori_pengumuman_update',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testDestroyKateogriPengumuman()
    {
        // Membuat data kegiatan palsu
        $data = KategoriPengumuman::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new PengumumanController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengumuman.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    // Kategori Kegiatan

    public function testIndexKateogriKegiatan()
    {
        
        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tabel_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_kegiatan.tabel_kategori_kegiatan', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_kegiatan', $response->getData());
        
        // Add more assertions if needed
    }

    public function testCreateKateogriKegiatan()
    {
        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tambah_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_kegiatan.tambah_kategori_kegiatan', $response->name());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    public function testStoreKateogriKegiatan()
    {
        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();

        // Menyiapkan data untuk pengujian
        $data = [
            'kategori_kegiatan' => 'nama_kategori_pengumuman',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testEditKateogriKegiatan()
    {
        $data = KategoriKegiatan::All()->first();
        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($data);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.edit_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_kegiatan.edit_kategori_kegiatan', $response->name());

        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_kegiatan', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());
        
        // Add more assertions if needed
    }

    public function testUpdateKateogriKegiatan()
    {
        // Membuat data kegiatan palsu
        $data = KategoriKegiatan::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $data->id_kategori_kegiatan, 'POST', [
            'kategori_kegiatan' => 'kategori_kegiatan_update',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testDestroyKateogriKegiatan()
    {
        // Membuat data kegiatan palsu
        $data = KategoriKegiatan::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new KegiatanController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_kegiatan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('error'));
        
        // Add more assertions if needed
    }


    // Kategori Pengaduan

    public function testIndexKateogriPengaduan()
    {
        
        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tabel_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengaduan.tabel_kategori_pengaduan', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_pengaduan', $response->getData());
        
        // Add more assertions if needed
    }

    public function testCreateKateogriPengaduan()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tambah_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengaduan.tambah_kategori_pengaduan', $response->name());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    public function testStoreKateogriPengaduan()
    {
        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();

        // Menyiapkan data untuk pengujian
        $data = [
            'nama_kategori_pengaduan' => 'nama_kategori_pengaduan',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengaduan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testEditKateogriPengaduan()
    {
        $data = KategoriPengaduan::All()->first();
        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($data);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.edit_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_pengaduan.edit_kategori_pengaduan', $response->name());

        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_pengaduan', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());
        
        // Add more assertions if needed
    }

    public function testUpdateKateogriPengaduan()
    {
        // Membuat data kegiatan palsu
        $data = KategoriPengaduan::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $data->id_kategori_pengaduan, 'POST', [
            'nama_kategori_pengaduan' => 'nama_kategori_pengaduan_update',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengaduan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testDestroyKateogriPengaduan()
    {
        // Membuat data kegiatan palsu
        $data = KategoriPengaduan::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new PengaduanController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_pengaduan.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('error'));
        
        // Add more assertions if needed
        
    }


    // Kategori Fasilitas

    public function testIndexKateogriFasilitas()
    {
        
        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tabel_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_fasilitas.tabel_kategori_fasilitas', $response->name());
        
        // Memastikan bahwa data kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_fasilitas', $response->getData());
        
        // Add more assertions if needed
    }

    public function testCreateKateogriFasilitas()
    {
        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.tambah_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_fasilitas.tambah_kategori_fasilitas', $response->name());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());

        // Add more assertions if needed
    }

    public function testStoreKateogriFasilitas()
    {
        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();

        // Menyiapkan data untuk pengujian
        $data = [
            'kategori_fasilitas' => 'kategori_fasilitas',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testEditKateogriFasilitas()
    {
        $data = kategori_fasilitas_umum::All()->first();
        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($data);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_kategori_pengumuman.edit_pk'
        $this->assertEquals('Admin.Kelola_utilitas.kategori_fasilitas.edit_kategori_fasilitas', $response->name());

        // Memastikan bahwa data kategori kegiatan dikirim ke view
        $this->assertArrayHasKey('kategori_fasilitas', $response->getData());

        // Memastikan bahwa title dikirim ke view
        $this->assertArrayHasKey('title', $response->getData());
        
        // Add more assertions if needed
    }

    public function testUpdateKateogriFasilitas()
    {
        // Membuat data kegiatan palsu
        $data = kategori_fasilitas_umum::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();

        // Membuat request palsu
        $request = Request::create('/pk/' . $data->id_kategori_pengaduan, 'POST', [
            'kategori_fasilitas' => 'kategori_fasilitas_update',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    public function testDestroyKateogriFasilitas()
    {
        // Membuat data kegiatan palsu
        $data = kategori_fasilitas_umum::All()->first();

        // Membuat instance dari PengumumanController
        $controller = new FasilitasController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($data);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'kategori_pengumuman.index'
        $this->assertEquals(route('kategori_fasilitas.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
        
    }
}



