<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class KegiatanRWTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 4)->first();
        Auth::login($user);
    }
    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexKegiatan()
    {
        $response = $this->get(route('rw.kegiatan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('RW.Kegiatan.kegiatan_warga');
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowKegiatan()
    {
        $kegiatan = Kegiatan::factory()->create();

        $response = $this->get(route('rw.kegiatan.show', $kegiatan));

        $response->assertStatus(200);
        $response->assertViewIs('RW.Kegiatan.detail_kegiatan_warga');
        $response->assertViewHas('kegiatan', $kegiatan);
        // Add more assertions if needed
    }

}
