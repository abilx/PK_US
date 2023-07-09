<?php

namespace Tests\Unit\Model;

use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KegiatanModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new Kegiatan.
     *
     * @return void
     */
    public function testCreateKegiatan()
    {
        $kegiatanData = [
            'nama_kegiatan' => 'Nama Kegiatan',
            'kategori_kegiatan' => 1,
            'id_penanggung_jawab' => 1,
            'penanggung_jawab' => 'Penanggung Jawab',
            'isi_kegiatan' => 'Isi Kegiatan',
            'foto_kegiatan' => 'no-image.jpg',
            'status_kegiatan' => 1,
            'tgl_mulai_kegiatan' => now(),
            'tgl_selesai_kegiatan' => null,
        ];

        $kegiatan = Kegiatan::create($kegiatanData);

        $this->assertInstanceOf(Kegiatan::class, $kegiatan);
        $this->assertDatabaseHas('kegiatan', $kegiatanData);
    }

    /**
     * Test updating an existing Kegiatan.
     *
     * @return void
     */
    public function testUpdateKegiatan()
    {
        $kegiatan = Kegiatan::factory()->create();

        $updatedData = [
            'nama_kegiatan' => 'Nama Kegiatan Updated',
            'penanggung_jawab' => 'Penanggung Jawab Updated',
            'isi_kegiatan' => 'Isi Kegiatan Updated',
            'status_kegiatan' => 0,
        ];

        $kegiatan->update($updatedData);

        $this->assertEquals($updatedData['nama_kegiatan'], $kegiatan->nama_kegiatan);
        $this->assertSame(strtolower($updatedData['penanggung_jawab']), strtolower($kegiatan->penanggung_jawab));
        $this->assertEquals($updatedData['isi_kegiatan'], $kegiatan->isi_kegiatan);
        $this->assertEquals($updatedData['status_kegiatan'], $kegiatan->status_kegiatan);
        $this->assertDatabaseHas('kegiatan', $updatedData);
    }

    /**
     * Test deleting a Kegiatan.
     *
     * @return void
     */
    public function testDeleteKegiatan()
    {
        $kegiatanData = [
            'nama_kegiatan' => 'Nama Kegiatan',
            'kategori_kegiatan' => 1,
            'id_penanggung_jawab' => 1,
            'penanggung_jawab' => 'Penanggung Jawab',
            'isi_kegiatan' => 'Isi Kegiatan',
            'foto_kegiatan' => 'no-image.jpg',
            'status_kegiatan' => 1,
            'tgl_mulai_kegiatan' => now(),
            'tgl_selesai_kegiatan' => null,
        ];

        $kegiatan = Kegiatan::create($kegiatanData);

        $kegiatan->delete();

        $this->assertDeleted($kegiatan);
    }

    public function testKegiatanModelHasCorrectAttributes()
    {
        $kegiatan = Kegiatan::factory()->create();

        $this->assertNotNull($kegiatan->id_kegiatan);
        $this->assertNotNull($kegiatan->nama_kegiatan);
        $this->assertNotNull($kegiatan->kategori_kegiatan);
        $this->assertNotNull($kegiatan->id_penanggung_jawab);
        $this->assertNotNull($kegiatan->penanggung_jawab);
        $this->assertNotNull($kegiatan->isi_kegiatan);
        $this->assertNotNull($kegiatan->foto_kegiatan);
        $this->assertNotNull($kegiatan->status_kegiatan);
        $this->assertNotNull($kegiatan->tgl_mulai_kegiatan);
        $this->assertNotNull($kegiatan->tgl_selesai_kegiatan);
        $this->assertNotNull($kegiatan->created_at);
        $this->assertNotNull($kegiatan->updated_at);
    }
}
