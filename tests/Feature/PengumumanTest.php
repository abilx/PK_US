<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PengumumanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::factory()->create(['role_id' => 3]);
        Auth::login($user);
    }

    public function testIndexPengumuman()
    {
        $response = $this->get(route('pk.pengumuman.index'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Pengumuman.tabel_pengumuman');
        $response->assertViewHas('pengumuman');
        $response->assertViewHas('title', 'tabel-pengumuman');
    }

    public function testCreatePengumuman()
    {
        $response = $this->get(route('pk.pengumuman.create'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Pengumuman.tambah_pengumuman');
        $response->assertViewHas('kategori_pengumuman');
        $response->assertViewHas('title', 'tambah-pengumuman');
    }

    public function testStorePengumuman()
    {
        Storage::fake('public');

        $data = [
            'kategori_pengumuman' => 1,
            'judul_pengumuman' => 'Judul Pengumuman',
            'isi_pengumuman' => 'Isi Pengumuman',
            'foto_pengumuman' =>  UploadedFile::fake()->image('avatar.jpg'),
            'status_pengumuman' => 1,
            'tgl_terbit' => '2021-12-23',
        ];

        $response = $this->post(route('pk.pengumuman.store'), $data);
        
        $response->assertStatus(302)
            ->assertRedirect(route('pk.pengumuman.index'))
            ->assertSessionHas('success', 'Data berhasil ditambah!');

    }

    public function testEditPengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->get(route('pk.pengumuman.edit', $pengumuman->id_pengumuman));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Pengumuman.edit_pengumuman');
        $response->assertViewHas('pengumuman', $pengumuman);
        $response->assertViewHas('kategori_pengumuman');
        $response->assertViewHas('title', 'edit-pengumuman');
    }

    public function testUpdatePengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();
        Storage::fake('public');

        $data = [
            'judul_pengumuman' => 'Judul Pengumuman Baru',
            'kategori_pengumuman' => 2,
            'isi_pengumuman' => 'Isi Pengumuman Baru',
            'tgl_terbit' => '2023-06-10',
        ];

        $response = $this->put(route('pk.pengumuman.update', $pengumuman->id_pengumuman), $data);
        
        $response->assertRedirect(route('pk.pengumuman.index'));
        $this->assertDatabaseHas('pengumuman', $data);
    }

    public function testDestroyPengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->delete(route('pk.pengumuman.destroy', $pengumuman->id_pengumuman));

        $response->assertRedirect(route('pk.pengumuman.index'));
        $this->assertDatabaseMissing('pengumuman', ['id_pengumuman' => $pengumuman->id_pengumuman]);
    }

    public function testShowPengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->get(route('pk.pengumuman.show', $pengumuman->id_pengumuman));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Pengumuman.detail_pengumuman');
        $response->assertViewHas('pengumuman', $pengumuman);
        $response->assertViewHas('title', 'detail-pengumuman');
    }

    public function testUpdateStatusPengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->get(route('pk.pengumuman.update.status', [
            'status_pengumuman' => 1, // Update objek RW dengan status_rw 1
            'id_pengumuman' => $pengumuman->id_pengumuman,
        ]));      

        $response->assertStatus(200); // Memastikan respons status adalah 200

        $response->assertJson(['success' => 'Status change successfully.']);
        $this->assertDatabaseHas('pengumuman', ['id_pengumuman' => $pengumuman->id_pengumuman, 'status_pengumuman' => 1]);

        $updatedPengumuman = Pengumuman::find($pengumuman->id_pengumuman);
        $this->assertEquals(1, $updatedPengumuman->status_pengumuman); // Memastikan status_rw telah diperbarui menjadi 1
    }
}

