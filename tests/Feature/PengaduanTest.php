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

class PengaduanTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 3)->first();
        Auth::login($user);
    }

    public function testIndexPengaduan()
    {
        $response = $this->get(route('pk.pengaduan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Pengaduan.tabel_pengaduan');
    }

    public function testShowPengaduan()
    {
        $pengaduan = Pengaduan::factory()->create();

        $response = $this->get(route('pk.pengaduan.show', $pengaduan));

        $response->assertStatus(200);
        $response->assertJson($pengaduan->toArray());
    }

    public function testTanggapinPengaduan()
    {
        $pengaduan = Pengaduan::factory()->create();
        $data = [
            'id_validasi' => $pengaduan->id_pengaduan,
            'tanggapan_rw' => $this->faker->sentence,
        ];

        $response = $this->post(route('pk.pengaduan.tanggapin'), $data);

        $response->assertRedirect(route('pk.pengaduan.index'));
        $response->assertSessionHas('success', 'Pengaduan telah di validasi!');

        $this->assertDatabaseHas('pengaduans', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'tanggapan_pengaduan' => $data['tanggapan_rw'],
            'status_pengaduan' => 2,
            'ditampilkan' => 1,
        ]);
    }

    public function testUpdateStatusPengaduan()
    {
        $pengaduan = Pengaduan::factory()->create();

        $response = $this->get(route('pk.pengaduan.ditampilkan', [
            'ditampilkan' => 1,
            'id_pengaduan' => $pengaduan->id_pengaduan,
        ]));

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Status change successfully.']);

        $this->assertDatabaseHas('pengaduans', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'ditampilkan' => 1,
        ]);
    }
}
