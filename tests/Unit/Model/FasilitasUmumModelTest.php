<?php

namespace Tests\Unit\Model;

use App\Models\Fasilitas_umum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FasilitasUmumModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new FasilitasUmum.
     *
     * @return void
     */
    public function testCreateFasilitasUmum()
    {
        $fasilitasUmumData = [
            'kategori_fasilitas_umum' => 1,
            'rt' => null,
            'rw' => 1,
            'fasilitas_umum' => 'Nama Fasilitas',
            'deskripsi_fasilitas' => 'Deskripsi fasilitas',
            'koordinant_fasilitas' => null,
            'foto_fasilitas' => 'example.jpg',
            'status_fasilitas' => 1,
            'alamat_fasilitas' => 'Alamat fasilitas',
        ];

        $fasilitasUmum = Fasilitas_umum::create($fasilitasUmumData);

        $this->assertInstanceOf(Fasilitas_umum::class, $fasilitasUmum);
        $this->assertDatabaseHas('Fasilitas_umums', $fasilitasUmumData);
    }

    /**
     * Test updating an existing FasilitasUmum.
     *
     * @return void
     */
    public function testUpdateFasilitasUmum()
    {
        $fasilitasUmum = Fasilitas_umum::factory()->create();

        $updatedData = [
            'fasilitas_umum' => 'Nama Fasilitas Updated',
            'deskripsi_fasilitas' => 'Deskripsi fasilitas Updated',
            'foto_fasilitas' => 'updated.jpg',
            'status_fasilitas' => 0,
        ];

        $fasilitasUmum->update($updatedData);

        $this->assertEquals($updatedData['fasilitas_umum'], $fasilitasUmum->fasilitas_umum);
        $this->assertEquals($updatedData['deskripsi_fasilitas'], $fasilitasUmum->deskripsi_fasilitas);
        $this->assertEquals($updatedData['foto_fasilitas'], $fasilitasUmum->foto_fasilitas);
        $this->assertEquals($updatedData['status_fasilitas'], $fasilitasUmum->status_fasilitas);
        $this->assertDatabaseHas('Fasilitas_umums', $updatedData);
    }

    /**
     * Test deleting a FasilitasUmum.
     *
     * @return void
     */
    public function testDeleteFasilitasUmum()
    {
        $fasilitasUmumData = [
            'kategori_fasilitas_umum' => 1,
            'rt' => null,
            'rw' => 1,
            'fasilitas_umum' => 'Nama Fasilitas',
            'deskripsi_fasilitas' => 'Deskripsi fasilitas',
            'koordinant_fasilitas' => null,
            'foto_fasilitas' => 'example.jpg',
            'status_fasilitas' => 1,
            'alamat_fasilitas' => 'Alamat fasilitas',
        ];

        $fasilitasUmum = Fasilitas_umum::create($fasilitasUmumData);

        $fasilitasUmum->delete();

        $this->assertDeleted($fasilitasUmum);
    }

    public function testFasilitasUmumModelHasCorrectAttributes()
    {
        $fasilitasUmum = Fasilitas_umum::factory()->create();

        $this->assertNotNull($fasilitasUmum->id_fasilitas_umum);
        $this->assertNotNull($fasilitasUmum->kategori_fasilitas_umum);
        $this->assertNull($fasilitasUmum->rt);
        $this->assertNotNull($fasilitasUmum->rw);
        $this->assertNotNull($fasilitasUmum->fasilitas_umum);
        $this->assertNotNull($fasilitasUmum->deskripsi_fasilitas);
        $this->assertNull($fasilitasUmum->koordinant_fasilitas);
        $this->assertNotNull($fasilitasUmum->foto_fasilitas);
        $this->assertNotNull($fasilitasUmum->status_fasilitas);
        $this->assertNotNull($fasilitasUmum->alamat_fasilitas);
        $this->assertNotNull($fasilitasUmum->created_at);
        $this->assertNotNull($fasilitasUmum->updated_at);
    }
}
