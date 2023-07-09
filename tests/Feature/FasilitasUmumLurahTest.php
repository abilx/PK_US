<?php

namespace Tests\Feature;

use App\Models\Fasilitas_umum;
use App\Models\User;
use App\Models\Kategori_fasilitas_umum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class FasilitasUmumLurahTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 2)->first();
        Auth::login($user);
    }
    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexFasilitasUmum()
    {
        $response = $this->get(route('lurah.fasilitas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Warga.fasilitas.fasilitas_warga');
        // Add more assertions if needed
    }

    public function testShowFasilitasUmum()
    {
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        $response = $this->get("/Lurah/fasilitas/{$FasilitasUmum->id_fasilitas_umum}");

        $response->assertStatus(200);
        $response->assertViewIs('Warga.fasilitas.detail_fasilitas');
    }
}
