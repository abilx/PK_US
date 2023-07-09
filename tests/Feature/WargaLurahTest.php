<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class WargaLurahTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 2)->first();
        Auth::login($user);
    }

    public function testIndexWarga()
    {
        $response = $this->get('/Lurah/warga');

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.warga');
    }

    public function testListWarga()
    {
        $warga = Warga::factory()->create();
        $response = $this->get("/Lurah/list-warga/{$warga->rw}");

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.tabel_warga');
    }

    public function testWargaKepala()
    {
        $response = $this->get("/Lurah/warga/wargakepala");

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.warga-kelurahan-kepala');
    }

    public function testWargaMiskin()
    {
        $warga = Warga::factory()->create();
        $response = $this->get("/Lurah/warga/wargamiskin");

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.kemiskinan.tabel_kemiskinan');
    }

    public function testWargaLansia()
    {
        $response = $this->get("/Lurah/warga/wargalansia");

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.warga-kelurahan-lansia');
    }

    public function testShowWarga()
    {
        $warga = Warga::factory()->create();

        $response = $this->get("/Lurah/warga/detail/{$warga->id_warga}");

        $response->assertStatus(200)
            ->assertViewIs('Lurah.Warga.detail_warga')
            ->assertViewHas('warga', $warga);
    }
}

