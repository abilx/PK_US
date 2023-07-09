<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\rt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RtTest extends TestCase
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

    public function testIndexRt()
    {
        $response = $this->get(route('rt.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_rtrw.rt.tabel_rt');
        $response->assertViewHas('kelola_rt');
        $response->assertViewHas('title', 'Kelola RT');
    }

    public function testCreateRt()
    {
        $response = $this->get(route('rt.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_rtrw.rt.tambah_rt');
        $response->assertViewHas('title', 'tambah RT');
        $response->assertViewHas('rt');
        $response->assertViewHas('rw');
    }

    public function testStoreRt()
    {
        $data = [
            'id_warga' => 1,
            'no_rt' => 'RT001',
            'id_rw' => 1,
            'tgl_awal_jabatan_rt' => '2023-06-09',
            'tgl_akhir_jabatan_rt' => '2024-06-09',
        ];

        $response = $this->post(route('rt.store'), $data);

        $this->assertDatabaseHas('rts', [
            'id_warga' => $data['id_warga'],
            'no_rt' => $data['no_rt'],
            'id_rw' => $data['id_rw'],
            'tgl_awal_jabatan_rt' => $data['tgl_awal_jabatan_rt'],
            'tgl_akhir_jabatan_rt' => $data['tgl_akhir_jabatan_rt'],
        ]);

        $response->assertRedirect(route('rt.index'));
        $response->assertSessionHas('success', 'Data berhasil ditambah!');
    }

    public function testEditRt()
    {
        $rt = Rt::factory()->create();

        $response = $this->get(route('rt.edit', $rt));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_rtrw.rt.edit_rt');
        $response->assertViewHas('rt', $rt);
        $response->assertViewHas('rw');
        $response->assertViewHas('kelola_rt');
        $response->assertViewHas('title', 'edit-rt');
    }

    public function testUpdateRt()
    {
        $rt = Rt::factory()->create();

        $data = [
            'id_warga' => 1,
            'no_rt' => 'RT002',
            'id_rw' => 2,
            'tgl_awal_jabatan_rt' => '2023-06-09',
            'tgl_akhir_jabatan_rt' => '2024-06-09',
        ];

        $response = $this->put(route('rt.update', $rt), $data);

        $this->assertDatabaseHas('rts', [
            'id_rt' => $rt->id_rt,
            'id_warga' => $data['id_warga'],
            'no_rt' => $data['no_rt'],
            'id_rw' => $data['id_rw'],
            'tgl_awal_jabatan_rt' => $data['tgl_awal_jabatan_rt'],
            'tgl_akhir_jabatan_rt' => $data['tgl_akhir_jabatan_rt'],
        ]);

        $response->assertRedirect(route('rt.index'));
        $response->assertSessionHas('success', 'Data berhasil diubah!');
    }

    public function testDestroyRt()
    {
        $rt = Rt::factory()->create();

        $response = $this->delete(route('rt.destroy', $rt));

        $this->assertDeleted($rt);

        $response->assertRedirect(route('rt.index'));
        $response->assertSessionHas('success', 'data berhasil dihapus!');
    }

    public function testShowRt()
    {
        $rt = rt::factory()->create();

        $response = $this->get(route('rt.show', $rt->id_rt));
        // $response->ddSession();
        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_rtrw.rt.detail_rt');
        $response->assertViewHas('identitas_rw');
        $response->assertViewHas('identitas_rt');
        $response->assertViewHas('title', 'detail-rtrw');
    }

    // public function testUpdateStatusRt()
    // {
    //     $rt = Rt::factory()->create(['status_rt' => 0]);

    //     $data = [
    //         'id_rt' => $rt->id_rt,
    //         'status_rt' => 1,
    //     ];

    //     $response = $this->json('POST', route('rt.updateStatus'), $data);

    //     $this->assertDatabaseHas('rts', [
    //         'id_rt' => $rt->id_rt,
    //         'status_rt' => $data['status_rt'],
    //     ]);

    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'success' => 'Status change successfully.',
    //         'status' => 1,
    //         'product' => $rt->toArray(),
    //     ]);
    // }
}

