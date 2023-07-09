<?php

namespace Tests\Unit\Model;

use App\Models\Pengumuman;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengumumanModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new Pengumuman.
     *
     * @return void
     */
    public function testCreatePengumuman()
    {
        $pengumumanData = [
            'kategori_pengumuman' => 1,
            'id_penanggung_jawab' => 1,
            'penanggung_jawab' => 'John Doe',
            'judul_pengumuman' => 'Judul Pengumuman',
            'isi_pengumuman' => 'Isi Pengumuman',
            'foto_pengumuman' => null,
            'status_pengumuman' => 1,
            'tgl_terbit' => null,
        ];

        $pengumuman = Pengumuman::create($pengumumanData);

        $this->assertInstanceOf(Pengumuman::class, $pengumuman);
        $this->assertDatabaseHas('pengumuman', $pengumumanData);
    }

    /**
     * Test updating an existing Pengumuman.
     *
     * @return void
     */
    public function testUpdatePengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $updatedData = [
            'judul_pengumuman' => 'Judul Pengumuman Updated',
            'isi_pengumuman' => 'Isi Pengumuman Updated',
            'status_pengumuman' => 2,
        ];

        $pengumuman->update($updatedData);

        $this->assertEquals($updatedData['judul_pengumuman'], $pengumuman->judul_pengumuman);
        $this->assertEquals($updatedData['isi_pengumuman'], $pengumuman->isi_pengumuman);
        $this->assertEquals($updatedData['status_pengumuman'], $pengumuman->status_pengumuman);
        $this->assertDatabaseHas('pengumuman', $updatedData);
    }

    /**
     * Test deleting a Pengumuman.
     *
     * @return void
     */
    public function testDeletePengumuman()
    {
        $pengumumanData = [
            'kategori_pengumuman' => 1,
            'id_penanggung_jawab' => 1,
            'penanggung_jawab' => 'John Doe',
            'judul_pengumuman' => 'Judul Pengumuman',
            'isi_pengumuman' => 'Isi Pengumuman',
            'foto_pengumuman' => null,
            'status_pengumuman' => 1,
            'tgl_terbit' => null,
        ];

        $pengumuman = Pengumuman::create($pengumumanData);

        $pengumuman->delete();

        $this->assertDeleted($pengumuman);
    }

    public function testPengumumanModelHasCorrectAttributes()
    {
        $pengumuman = Pengumuman::factory()->create();

        $this->assertNotNull($pengumuman->id_pengumuman);
        $this->assertNotNull($pengumuman->kategori_pengumuman);
        $this->assertNotNull($pengumuman->id_penanggung_jawab);
        $this->assertNotNull($pengumuman->penanggung_jawab);
        $this->assertNotNull($pengumuman->judul_pengumuman);
        $this->assertNotNull($pengumuman->isi_pengumuman);
        $this->assertNotNull($pengumuman->status_pengumuman);
        $this->assertNotNull($pengumuman->tgl_terbit);
        $this->assertNotNull($pengumuman->created_at);
        $this->assertNotNull($pengumuman->updated_at);
    }
}
