<?php

namespace Tests\Unit\Model;

use App\Models\rw;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RwModelTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

    }

    /**
     * Test creating a new rw.
     *
     * @return void
     */
    public function testCreateRw()
    {
        
        $rwData = [
            'user_id' => null,
            'no_rw' => 'RW001',
            'id_warga' => 1,
            'ketua_rw' => 'John Doe',
            'tgl_awal_jabatan_rw' => now(),
            'tgl_akhir_jabatan_rw' => null,
            'status_rw' => 1,
        ];

        $rw = rw::create($rwData);

        $this->assertInstanceOf(rw::class, $rw);
        $this->assertDatabaseHas('rws', $rwData);
    }

    /**
     * Test updating an existing rw.
     *
     * @return void
     */
    public function testUpdateRw()
    {
        $rw = rw::factory()->create();

        $updatedData = [
            'no_rw' => 'RW002',
            'ketua_rw' => 'Jane Smith',
            'status_rw' => 2,
        ];

        $rw->update($updatedData);

        $this->assertEquals('RW002', $rw->no_rw);
        $this->assertEquals('Jane Smith', $rw->ketua_rw);
        $this->assertEquals(2, $rw->status_rw);
        $this->assertDatabaseHas('rws', $updatedData);
    }

    /**
     * Test deleting a rw.
     *
     * @return void
     */
    public function testDeleteRw()
    {
        $rwData = [
            'user_id' => null,
            'no_rw' => 'RW001',
            'id_warga' => 1,
            'ketua_rw' => 'John Doe',
            'tgl_awal_jabatan_rw' => now(),
            'tgl_akhir_jabatan_rw' => null,
            'status_rw' => 1,
        ];

        $rw = rw::create($rwData);

        $rw->delete();

        $this->assertDeleted($rw);
    }

    public function testRwModelHasCorrectAttributes()
    {
        $rw = rw::factory()->create();

        $this->assertNotNull($rw->id_rw);
        $this->assertNotNull($rw->user_id);
        $this->assertNotNull($rw->no_rw);
        $this->assertNotNull($rw->id_warga);
        $this->assertNotNull($rw->ketua_rw);
        $this->assertNotNull($rw->tgl_awal_jabatan_rw);
        $this->assertNotNull($rw->tgl_akhir_jabatan_rw);
        $this->assertNotNull($rw->status_rw);
        $this->assertNotNull($rw->created_at);
        $this->assertNotNull($rw->updated_at);
        $this->assertNull($rw->deleted_at);
    }

}
