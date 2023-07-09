<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use App\Models\Fasilitas_umum;
use App\Models\Berita;
use App\Models\Warga;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LPTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

    }

    public function testHome()
    {

        $response = $this->get(route('warga.dashboard.home'));

        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    public function testKegiatan()
    {

        $response = $this->get(route('warga.kegiatan'));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.kegiatan.kegiatan');
    }

    public function testKegiatanShow()
    {
        $kegiatan = Kegiatan::factory()->create();

        $response = $this->get(route('warga.kegiatan.show', $kegiatan));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.kegiatan.detail_kegiatan');
        $response->assertViewHas('kegiatan', $kegiatan);
        // Add more assertions if needed
    }

    public function testPengumuman()
    {

        $response = $this->get(route('warga.pengumuman'));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.pengumuman.pengumuman');
    }

    public function testPengumumanShow()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->get(route('warga.pengumuman.show', $pengumuman));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.pengumuman.detail_pengumuman');
        $response->assertViewHas('pengumuman', $pengumuman);
        // Add more assertions if needed
    }

    public function testFasilitas()
    {
        $response = $this->get(route('warga.fasilitas'));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.fasilitas.fasilitas');
    }

    public function testFasilitasShow()
    {
        $fasilitas = Fasilitas_umum::factory()->create();

        $response = $this->get(route('warga.fasilitas.show', $fasilitas));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.fasilitas.detail_fasilitasw');
        $response->assertViewHas('fasilitas', $fasilitas);
        // Add more assertions if needed
    }

    public function testBerita()
    {
        $response = $this->get(route('warga.berita'));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.berita.berita');
    }

    public function testBeritaShow()
    {
        $berita = Berita::factory()->create();

        $response = $this->get(route('warga.berita.show', $berita));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.berita.detail_berita');
        $response->assertViewHas('berita', $berita);
        // Add more assertions if needed
    }

    public function testStorePengaduan()
    {
        $warga = Warga::factory()->create();
        $data = [
            'judul_pengaduan' => 'Judul Pengaduan',
            'deskripsi_pengaduan' => 'Deskripsi Pengaduan',
            'kategori_pengaduan' => '1',
            'bukti_pengaduan' => UploadedFile::fake()->image('pengaduan.jpg'),
            'nik' => $warga->nik,
            'rt' => $warga->rt,
        ];

        $response = $this->post(route('warga.pengaduan.store_pengaduan'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('warga.dashboard.home'));
        $this->assertDatabaseHas('pengaduans', ['judul_pengaduan' => $data['judul_pengaduan']]);

    }

    public function testCekWarga()
    {

        // Membuat data warga
        $warga = Warga::factory()->create();

        // Membuat permintaan dengan ID warga
        $response = $this->get(route('warga.cek_warga', ['id' => $warga->nik]));

        // Memastikan response sukses
        $response->assertStatus(200);
        $response->assertJson(['success' => 'Data ditemukan.']);
        
        // Memastikan data warga ditemukan
        $responseData = $response->json();
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals($warga->id_warga, $responseData['data']['id_warga']);
    }

}
