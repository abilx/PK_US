<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class PengaduanLurahTest extends TestCase
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

    public function testIndexPengaduan()
    {
        $response = $this->get(route('lurah.pengaduan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Lurah.Pengaduan.tabel_pengaduan');
    }

    public function testShowPengaduan()
    {
        $pengaduan = Pengaduan::factory()->create();

        $response = $this->get(route('lurah.pengaduan.show', $pengaduan));

        $response->assertStatus(200);
        $response->assertJson($pengaduan->toArray());
    }
}
