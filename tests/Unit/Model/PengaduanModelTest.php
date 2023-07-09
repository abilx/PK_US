<?php

namespace Tests\Unit\Model;

use App\Models\pengaduan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengaduanModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new Pengaduan.
     *
     * @return void
     */
    public function testCreatePengaduan()
    {
        $pengaduanData = [
            'judul_pengaduan' => 'Judul Pengaduan',
            'nik' => 1234567890,
            'kategori_pengaduan' => 1,
            'deskripsi_pengaduan' => 'Deskripsi Pengaduan',
            'bukti_pengaduan' => 'bukti.jpg',
            'tanggapan_pengaduan' => null,
            'id_rt' => 1,
            'status_pengaduan' => 0,
            'ditampilkan' => true,
        ];

        $pengaduan = pengaduan::create($pengaduanData);

        $this->assertInstanceOf(pengaduan::class, $pengaduan);
        $this->assertDatabaseHas('pengaduans', $pengaduanData);
    }

    /**
     * Test updating an existing Pengaduan.
     *
     * @return void
     */
    public function testUpdatePengaduan()
    {
        $pengaduan = pengaduan::factory()->create();

        $updatedData = [
            'status_pengaduan' => 1,
        ];

        $pengaduan->update($updatedData);

        $this->assertEquals($updatedData['status_pengaduan'], $pengaduan->status_pengaduan);
        $this->assertDatabaseHas('pengaduans', $updatedData);
    }

    /**
     * Test deleting a Pengaduan.
     *
     * @return void
     */
    public function testDeletePengaduan()
    {
        $pengaduanData = [
            'judul_pengaduan' => 'Judul Pengaduan',
            'nik' => 1234567890,
            'kategori_pengaduan' => 1,
            'deskripsi_pengaduan' => 'Deskripsi Pengaduan',
            'bukti_pengaduan' => 'bukti.jpg',
            'tanggapan_pengaduan' => null,
            'id_rt' => 1,
            'status_pengaduan' => 2,
            'ditampilkan' => true,
        ];

        $pengaduan = pengaduan::create($pengaduanData);

        $pengaduan->delete();

        $this->assertSoftDeleted('pengaduans', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
        ]);
    }

    public function testPengaduanModelHasCorrectAttributes()
    {
        $pengaduan = pengaduan::factory()->create();

        $this->assertNotNull($pengaduan->id_pengaduan);
        $this->assertNotNull($pengaduan->judul_pengaduan);
        $this->assertNotNull($pengaduan->nik);
        $this->assertNotNull($pengaduan->kategori_pengaduan);
        $this->assertNotNull($pengaduan->deskripsi_pengaduan);
        $this->assertNotNull($pengaduan->bukti_pengaduan);
        $this->assertNull($pengaduan->tanggapan_pengaduan);
        $this->assertNotNull($pengaduan->id_rt);
        $this->assertNotNull($pengaduan->status_pengaduan);
        $this->assertNotNull($pengaduan->ditampilkan);
        $this->assertNotNull($pengaduan->created_at);
        $this->assertNotNull($pengaduan->updated_at);
        $this->assertNull($pengaduan->deleted_at);
    }
}
