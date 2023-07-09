<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PK;
use Illuminate\Support\Facades\Auth;


class PKTest extends TestCase
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

    public function testIndexPk()
    {
        $response = $this->get(route('pk.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_pk.tabel_pk');
        $response->assertViewHas('kelola_pk');
        $response->assertViewHas('title', 'Kelola Petugas Kelurahan');
    }

    public function testCreatePk()
    {
        $response = $this->get(route('pk.create'));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_pk.tambah_pk');
        $response->assertViewHas('title', 'tambah Petugas Kelurahan');
        $response->assertViewHas('pk');
        $response->assertViewHas('hasUserWithRoleId2');
    }

    public function testStorePk()
    {
        $data = [
            'id_warga' => 1,
            'username' => 'test_user',
            'password' => 'password',
            'tgl_awal_jabatan_petugas_kelurahan' => '2023-06-09',
            'tgl_akhir_jabatan_petugas_kelurahan' => '2024-06-09',
            'jenis_petugas' => 1,
        ];

        $response = $this->post(route('pk.store'), $data);

        $this->assertDatabaseHas('petugas_kelurahan', [
            'id_warga' => $data['id_warga'],
            'status_pk' => 0,
        ]);

        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'role_id' => 2,
        ]);

        $response->assertRedirect(route('pk.index'));
        $response->assertSessionHas('success', 'Data berhasil ditambah!');
    }

    public function testEditPk()
    {
        $pk = PK::factory()->create();

        $response = $this->get(route('pk.edit', $pk));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_pk.edit_pk');
        $response->assertViewHas('pk', $pk);
        $response->assertViewHas('kelola_pk');
        $response->assertViewHas('user');
        $response->assertViewHas('title', 'edit-pk');
    }

    public function testUpdatePk()
    {
        $pk = PK::factory()->create();

        $data = [
            'id_warga' => $pk->id_warga,
            'username' => 'username123',
            'password' => 'password123',
            'tgl_awal_jabatan_petugas_kelurahan' => '2023-06-09',
            'tgl_akhir_jabatan_petugas_kelurahan' => '2024-06-09',
        ];

        $response = $this->put(route('pk.update', $pk), $data);

        $this->assertDatabaseHas('petugas_kelurahan', [
            'id_pk' => $pk->id_pk,
            'id_warga' => $data['id_warga'],
        ]);

        $response->assertRedirect(route('pk.index'));
        $response->assertSessionHas('success', 'Data berhasil diubah!');
    }

    public function testDestroyPk()
    {
        $pk = PK::factory()->create();

        $response = $this->delete(route('pk.destroy', $pk));

        $this->assertDeleted($pk);

        $response->assertRedirect(route('pk.index'));
        $response->assertSessionHas('success', 'data berhasil dihapus!');
    }

    public function testShowPk()
    {
        $pk = PK::factory()->create();

        $response = $this->get(route('pk.show', $pk->id_pk));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.Kelola_pk.detail_pk');
        $response->assertViewHas('kelola_pk');
        $response->assertViewHas('identitas_pk');
        $response->assertViewHas('title', 'detail-pk');
    }

    public function testUpdateStatusPk()
    {
        $pk = PK::factory()->create(['status_pk' => 0]);

        $response = $this->get(route('pk.update.status', [
            'status_pk' => 1, // Update objek RW dengan status_rw 1
            'id_pk' => $pk->id_pk,
        ]));

        $response->assertStatus(200); // Memastikan respons status adalah 200

        $updatedRw = PK::find($pk->id_pk);
        $this->assertEquals(1, $updatedRw->status_pk); // Memastikan status_rw telah diperbarui menjadi 1
    }

}

