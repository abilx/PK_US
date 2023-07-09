<?php

namespace Tests\Feature;

use App\Models\Fasilitas_umum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPengumuman;
use App\Models\KategoriKegiatan;
use App\Models\KategoriPengaduan;
use App\Models\Kategori_fasilitas_umum;

class UtilitasTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 1)->first();
        Auth::login($user);
    }

    public function testIndexKateogriPengumuman()
    {
        
        $response = $this->get(route('kategori_pengumuman.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengumuman.tabel_kategori_pengumuman');
        // Add more assertions if needed
    }

    public function testCreateKateogriPengumuman()
    {
        $response = $this->get(route('kategori_pengumuman.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengumuman.tambah_kategori_pengumuman');
        // Add more assertions if needed
    }

    public function testStoreKateogriPengumuman()
    {
         // Storage::fake('gambar-fasilitas');

         $data = [
            'nama_kategori_pengumuman' => 'nama_kategori_pengumuman',
        ];

        $response = $this->post(route('kategori_pengumuman.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_pengumuman.index'));
        $this->assertDatabaseHas('kategori_pengumuman', ['nama_kategori_pengumuman' => $data['nama_kategori_pengumuman']]);
        // Add more assertions if needed
    }

    public function testEditKateogriPengumuman()
    {
        $KategoriPengumuman = KategoriPengumuman::All()->first();

        $response = $this->get(route('kategori_pengumuman.edit', $KategoriPengumuman->id_kategori_pengumuman));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengumuman.edit_kategori_pengumuman');
        $response->assertViewHas('kategori_pengumuman');
        // Add more assertions if needed
    }

    public function testUpdateKateogriPengumuman()
    {
        // Storage::fake('gambar-fasilitas');

        $KategoriPengumuman = KategoriPengumuman::All()->first();

        $data = [
            'nama_kategori_pengumuman' => 'nama_kategori_pengumuman_update',
        ];

        $response = $this->put(route('kategori_pengumuman.update', $KategoriPengumuman->id_kategori_pengumuman), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_pengumuman.index'));
        // $this->assertDatabaseHas('kategori_pengumuman', ['nama_kategori_pengumuman' => $KategoriPengumuman['nama_kategori_pengumuman']]);
        // Add more assertions if needed
    }

    public function testDestroyKateogriPengumuman()
    {
        $KategoriPengumuman = KategoriPengumuman::All()->first();

        $response = $this->delete(route('kategori_pengumuman.destroy', $KategoriPengumuman->id_kategori_pengumuman));

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_pengumuman.index'));
        // $this->assertDatabaseMissing('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum->id_fasilitas_umum]);
    }

    // // Kategori Kegiatan

    public function testIndexKateogriKegiatan()
    {
        
        $response = $this->get(route('kategori_kegiatan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_kegiatan.tabel_kategori_kegiatan');
        // Add more assertions if needed
    }

    public function testCreateKateogriKegiatan()
    {
        $response = $this->get(route('kategori_kegiatan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_kegiatan.tambah_kategori_kegiatan');
        // Add more assertions if needed
    }

    public function testStoreKateogriKegiatan()
    {
        // Storage::fake('gambar-fasilitas');

        $data = [
            'kategori_kegiatan' => 'nama_kategori_kegiatan',
        ];

        $response = $this->post(route('kategori_kegiatan.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_kegiatan.index'));
        $this->assertDatabaseHas('kategori_kegiatan', ['kategori_kegiatan' => $data['kategori_kegiatan']]);
        // Add more assertions if needed
    }

    public function testEditKateogriKegiatan()
    {
        $KategoriPengumuman = KategoriKegiatan::All()->first();

        $response = $this->get(route('kategori_kegiatan.edit', $KategoriPengumuman->id_kategori_kegiatan));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_kegiatan.edit_kategori_kegiatan');
        $response->assertViewHas('kategori_kegiatan');
        // Add more assertions if needed
    }

    public function testUpdateKateogriKegiatan()
    {
        // Storage::fake('gambar-fasilitas');

        $KategoriPengumuman = KategoriKegiatan::All()->first();

        $data = [
            'kategori_kegiatan' => 'nama_kategori_kegiatan_update',
        ];

        $response = $this->put(route('kategori_kegiatan.update', $KategoriPengumuman->id_kategori_kegiatan), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_kegiatan.index'));
        // $this->assertDatabaseHas('kategori_kegiatan', ['kategori_kegiatan' => $KategoriPengumuman['kategori_kegiatan']]);
        // Add more assertions if needed
    }

    public function testDestroyKateogriKegiatan()
    {
        $KategoriPengumuman = KategoriKegiatan::All()->first();

        $response = $this->delete(route('kategori_kegiatan.destroy', $KategoriPengumuman->id_kategori_kegiatan));

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_kegiatan.index'));
        // $this->assertDatabaseMissing('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum->id_fasilitas_umum]);
    }


    // Kategori Pengaduan

    public function testIndexKateogriPengaduan()
    {
        
        $response = $this->get(route('kategori_pengaduan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengaduan.tabel_kategori_pengaduan');
        // Add more assertions if needed
    }

    public function testCreateKateogriPengaduan()
    {
        $response = $this->get(route('kategori_pengaduan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengaduan.tambah_kategori_pengaduan');
        // Add more assertions if needed
    }

    public function testStoreKateogriPengaduan()
    {
         // Storage::fake('gambar-fasilitas');

         $data = [
            'nama_kategori_pengaduan' => 'nama_kategori_pengaduan',
        ];

        $response = $this->post(route('kategori_pengaduan.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_pengaduan.index'));
        $this->assertDatabaseHas('kategori_pengaduan', ['nama_kategori_pengaduan' => $data['nama_kategori_pengaduan']]);
        // Add more assertions if needed
    }

    public function testEditKateogriPengaduan()
    {
        $KategoriPengumuman = KategoriPengaduan::All()->first();

        $response = $this->get(route('kategori_pengaduan.edit', $KategoriPengumuman->id_kategori_pengaduan));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_pengaduan.edit_kategori_pengaduan');
        $response->assertViewHas('kategori_pengaduan');
        // Add more assertions if needed
    }

    public function testUpdateKateogriPengaduan()
    {
         // Storage::fake('gambar-fasilitas');

         $KategoriPengumuman = KategoriPengaduan::All()->first();

         $data = [
             'nama_kategori_pengaduan' => 'nama_kategori_pengaduan_update',
         ];
 
         $response = $this->put(route('kategori_pengaduan.update', $KategoriPengumuman->id_kategori_pengaduan), $data);
 
         $response->assertStatus(302);
         $response->assertRedirect(route('kategori_pengaduan.index'));
        //  $this->assertDatabaseHas('kategori_pengaduan', ['nama_kategori_pengaduan' => $KategoriPengumuman['nama_kategori_pengaduan']]);
         // Add more assertions if needed
    }

    public function testDestroyKateogriPengaduan()
    {
        $KategoriPengumuman = KategoriPengaduan::All()->first();

        $response = $this->delete(route('kategori_pengaduan.destroy', $KategoriPengumuman->id_kategori_pengaduan));

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_pengaduan.index'));
        // $this->assertDatabaseMissing('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum->id_fasilitas_umum]);
        
    }


    // // Kategori Fasilitas

    public function testIndexKateogriFasilitas()
    {
        
        $response = $this->get(route('kategori_fasilitas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_fasilitas.tabel_kategori_fasilitas');
        // Add more assertions if needed
    }

    public function testCreateKateogriFasilitas()
    {
        $response = $this->get(route('kategori_fasilitas.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_fasilitas.tambah_kategori_fasilitas');
        // Add more assertions if needed
    }

    public function testStoreKateogriFasilitas()
    {
         // Storage::fake('gambar-fasilitas');

         $data = [
            'kategori_fasilitas' => 'nama_kategori_fasilitas',
        ];

        $response = $this->post(route('kategori_fasilitas.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_fasilitas.index'));
        $this->assertDatabaseHas('kategori_fasilitas_umums', ['kategori_fasilitas' => $data['kategori_fasilitas']]);
        // Add more assertions if needed
    }

    public function testEditKateogriFasilitas()
    {
        $KategoriPengumuman = Kategori_fasilitas_umum::All()->first();

        $response = $this->get(route('kategori_fasilitas.edit', $KategoriPengumuman->id_kategori_fasilitas));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_utilitas.kategori_fasilitas.edit_kategori_fasilitas');
        $response->assertViewHas('kategori_fasilitas');
        // Add more assertions if needed
    }

    public function testUpdateKateogriFasilitas()
    {
        // Storage::fake('gambar-fasilitas');

        $KategoriPengumuman = Kategori_fasilitas_umum::All()->first();

        $data = [
            'kategori_fasilitas' => 'nama_kategori_fasilitas_update',
        ];

        $response = $this->put(route('kategori_fasilitas.update', $KategoriPengumuman->id_kategori_fasilitas), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_fasilitas.index'));
       //  $this->assertDatabaseHas('kategori_fasilitas', ['kategori_fasilitas' => $KategoriPengumuman['kategori_fasilitas']]);
        // Add more assertions if needed
       
    }

    public function testDestroyKateogriFasilitas()
    {
        $KategoriPengumuman = Kategori_fasilitas_umum::All()->first();

        $response = $this->delete(route('kategori_fasilitas.destroy', $KategoriPengumuman->id_kategori_fasilitas));

        $response->assertStatus(302);
        $response->assertRedirect(route('kategori_fasilitas.index'));
        // $this->assertDatabaseMissing('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum->id_fasilitas_umum]);
        
    }
}
