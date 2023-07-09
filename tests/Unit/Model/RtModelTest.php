<?php

namespace Tests\Unit\Model;

use App\Models\rt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RtModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new rt.
     *
     * @return void
     */
    public function testCreateRt()
    {
        $rtData = [
            'user_id' => null,
            'id_rw' => 1,
            'username' => 'rt_user',
            'password' => 'rt_password',
            'no_rt' => 'RT001',
            'id_warga' => 1,
            'ketua_rt' => 'John Doe',
            'tgl_awal_jabatan_rt' => now(),
            'tgl_akhir_jabatan_rt' => null,
            'status_rt' => 1,
        ];

        $rt = Rt::create($rtData);

        $this->assertInstanceOf(Rt::class, $rt);
        $this->assertDatabaseHas('rts', $rtData);
    }

    /**
     * Test updating an existing rt.
     *
     * @return void
     */
    public function testUpdateRt()
    {
        $rt = Rt::factory()->create();

        $updatedData = [
            'no_rt' => 'RT002',
            'ketua_rt' => 'Jane Smith',
            'status_rt' => 2,
        ];

        $rt->update($updatedData);

        $this->assertEquals('RT002', $rt->no_rt);
        $this->assertEquals('Jane Smith', $rt->ketua_rt);
        $this->assertEquals(2, $rt->status_rt);
        $this->assertDatabaseHas('rts', $updatedData);
    }

    /**
     * Test deleting a rt.
     *
     * @return void
     */
    public function testDeleteRt()
    {
        $rtData = [
            'user_id' => null,
            'id_rw' => 1,
            'no_rt' => 'RT001',
            'id_warga' => 1,
            'ketua_rt' => 'John Doe',
            'tgl_awal_jabatan_rt' => now(),
            'tgl_akhir_jabatan_rt' => null,
            'status_rt' => 1,
        ];

        $rt = Rt::create($rtData);

        $rt->delete();

        $this->assertDeleted($rt);
    }

    public function testRtModelHasCorrectAttributes()
    {
        $rt = Rt::factory()->create();

        $this->assertNotNull($rt->id_rt);
        $this->assertNull($rt->user_id);
        $this->assertNotNull($rt->id_rw);
        $this->assertNull($rt->username);
        $this->assertNull($rt->password);
        $this->assertNotNull($rt->no_rt);
        $this->assertNotNull($rt->id_warga);
        $this->assertNotNull($rt->ketua_rt);
        $this->assertNotNull($rt->tgl_awal_jabatan_rt);
        $this->assertNotNull($rt->tgl_akhir_jabatan_rt);
        $this->assertNotNull($rt->status_rt);
        $this->assertNotNull($rt->created_at);
        $this->assertNull($rt->updated_at);
        $this->assertNull($rt->deleted_at);
    }
}
