<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\rw;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RwPKTest extends TestCase
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

    public function testIndexRw()
    {
        
        $response = $this->get('/PK/rw');

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Kelola_rtrw.rw.tabel_rw');
    }

    public function testCreateRw()
    {

        $response = $this->get('/PK/rw/tambah');

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Kelola_rtrw.rw.tambah_rw');
    }

    public function testStoreRw()
    {

        $data = [
            'id_warga' => 1,
            'username' => 'username123',
            'password' => 'password123',
            'no_rw' => 'RW001',
            'tgl_awal_jabatan_rw' => '2023-06-01',
            'tgl_akhir_jabatan_rw' => '2023-06-30',
        ];

        $response = $this->post('/PK/rw', $data);

        $response->assertStatus(302)
            ->assertRedirect(route('pk.rw.index'));
            // ->assertSessionHas('success', 'Data berhasil ditambah!');
    }

    public function testEditRw()
    {

        $rw = rw::factory()->create();

        $response = $this->get("/PK/rw/{$rw->id_rw}/edit");

        $response->assertStatus(200)
            ->assertViewIs('PetugasKelurahan.Kelola_rtrw.rw.edit_rw')
            ->assertViewHas('rw', $rw);
    }

    public function testUpdateRw()
    {

        $rw = rw::factory()->create();

        $data = [
            'id_warga' => $rw->id_warga,
            'username' => 'username123',
            'password' => 'password123',
            'no_rw' => 'RW002',
            'tgl_awal_jabatan_rw' => '2023-07-01',
            'tgl_akhir_jabatan_rw' => '2023-07-31',
        ];

        $response = $this->put("/PK/rw/{$rw->id_rw}", $data);

        $response->assertStatus(302)
            ->assertRedirect(route('pk.rw.index'))
            ->assertSessionHas('success', 'Data berhasil diubah!');
    }

    public function testDestroyRw()
    {

        $rw = rw::factory()->create();

        $response = $this->delete("/PK/rw/{$rw->id_rw}");

        $response->assertStatus(302)
            ->assertRedirect(route('pk.rw.index'))
            ->assertSessionHas('success', 'data berhasil dihapus!');
        $this->assertDeleted($rw);
    }

    public function testShowRw()
    {

        $rw = rw::factory()->create();

        $response = $this->get("/PK/rw/{$rw->id_rw}");

        $response->assertStatus(200)
                ->assertViewIs('PetugasKelurahan.Kelola_rtrw.rw.detail_rw')
                ->assertViewHas('identitas_rw')
                ->assertViewHas('identitas_rt');
    }

    public function testUpdateStatus()
    {
        $rw = rw::factory()->create(['status_rw' => 0]); // Membuat objek RW dengan status_rw awal 0
        
        $response = $this->get(route('rw.update.status', [
            'status_rw' => 1, // Update objek RW dengan status_rw 1
            'id_rw' => $rw->id_rw,
        ]));

        $response->assertStatus(200); // Memastikan respons status adalah 200

        $updatedRw = rw::find($rw->id_rw);
        $this->assertEquals(1, $updatedRw->status_rw); // Memastikan status_rw telah diperbarui menjadi 1
        $response->assertJson(['success' => 'Status change successfully.']);
        $this->assertDatabaseHas('rws', ['id_rw' => $rw->id_rw, 'status_rw' => 1]);
    }
}
