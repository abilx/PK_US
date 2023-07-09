<?php

namespace Tests\Unit\Model;

use App\Models\PK;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PKModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new PetugasKelurahan.
     *
     * @return void
     */
    public function testCreatePetugasKelurahan()
    {
        $petugasKelurahanData = [
            'user_id' => null,
            'id_warga' => 1,
            'tgl_awal_jabatan_petugas_kelurahan' => now(),
            'tgl_akhir_jabatan_petugas_kelurahan' => null,
            'status_pk' => 1,
        ];

        $petugasKelurahan = PK::create($petugasKelurahanData);

        $this->assertInstanceOf(PK::class, $petugasKelurahan);
        $this->assertDatabaseHas('petugas_kelurahan', $petugasKelurahanData);
    }

    /**
     * Test updating an existing PetugasKelurahan.
     *
     * @return void
     */
    public function testUpdatePetugasKelurahan()
    {
        $petugasKelurahan = PK::factory()->create();

        $updatedData = [
            'tgl_awal_jabatan_petugas_kelurahan' => now(),
            'tgl_akhir_jabatan_petugas_kelurahan' => now()->addYear(),
            'status_pk' => 2,
        ];

        $petugasKelurahan->update($updatedData);

        $this->assertEquals(2, $petugasKelurahan->status_pk);
        $this->assertDatabaseHas('petugas_kelurahan', $updatedData);
    }

    /**
     * Test deleting a PetugasKelurahan.
     *
     * @return void
     */
    public function testDeletePetugasKelurahan()
    {
        $petugasKelurahanData = [
            'user_id' => null,
            'id_warga' => 1,
            'tgl_awal_jabatan_petugas_kelurahan' => now(),
            'tgl_akhir_jabatan_petugas_kelurahan' => null,
            'status_pk' => 1,
        ];

        $petugasKelurahan = PK::create($petugasKelurahanData);

        $petugasKelurahan->delete();

        $this->assertDeleted($petugasKelurahan);
    }

    public function testPetugasKelurahanModelHasCorrectAttributes()
    {
        $petugasKelurahan = PK::factory()->create();

        $this->assertNotNull($petugasKelurahan->id_pk);
        $this->assertNotNull($petugasKelurahan->user_id);
        $this->assertNotNull($petugasKelurahan->id_warga);
        $this->assertNotNull($petugasKelurahan->tgl_awal_jabatan_petugas_kelurahan);
        $this->assertNotNull($petugasKelurahan->tgl_akhir_jabatan_petugas_kelurahan);
        $this->assertNotNull($petugasKelurahan->status_pk);
        $this->assertNotNull($petugasKelurahan->created_at);
        $this->assertNotNull($petugasKelurahan->updated_at);
        $this->assertNull($petugasKelurahan->deleted_at);
    }
}
