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

class FasilitasUmumTest extends TestCase
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
    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexFasilitasUmum()
    {
        $response = $this->get(route('pk.fasilitas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.fasilitas.fasilitas_umum');
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateFasilitasUmum()
    {
        $response = $this->get(route('pk.fasilitas.create'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.fasilitas.tambah_fasilitas');
        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreFasilitasUmum()
    {
        // Storage::fake('gambar-fasilitas');

        $data = [
            'fasilitas_umum' => $this->faker->sentence,
            'kategori_fasilitas_umum' => 1,
            'deskripsi_fasilitas' => $this->faker->paragraph,
            'foto_fasilitas' => UploadedFile::fake()->image('test.jpg'),
            'alamat_fasilitas' => $this->faker->address,
            'koordinant_fasilitas' => $this->faker->latitude . ',' . $this->faker->longitude,
        ];

        $response = $this->post(route('pk.fasilitas.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.fasilitas.index'));
        $this->assertDatabaseHas('fasilitas_umums', ['fasilitas_umum' => $data['fasilitas_umum']]);
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditFasilitasUmum()
    {
        $fasilitasUmum = Fasilitas_umum::factory()->create();

        $response = $this->get(route('pk.fasilitas.edit', $fasilitasUmum->id_fasilitas_umum));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.fasilitas.edit_fasilitas');
        $response->assertViewHas('fasilitas');
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateFasilitasUmum()
    {
        // Storage::fake('gambar-fasilitas');

        $fasilitasUmum = Fasilitas_umum::factory()->create();

        $data = [
            'fasilitas_umum' => $this->faker->sentence,
            'kategori_fasilitas_umum' => 1,
            'deskripsi_fasilitas' => $this->faker->paragraph,
            'foto_fasilitas' => UploadedFile::fake()->image('test.jpg'),
            'alamat_fasilitas' => $this->faker->address,
            'koordinant_fasilitas' => $this->faker->latitude . ',' . $this->faker->longitude,
        ];

        $response = $this->put(route('pk.fasilitas.update', $fasilitasUmum->id_fasilitas_umum), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.fasilitas.index'));
        $this->assertDatabaseHas('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum['id_fasilitas_umum']]);
        // Add more assertions if needed
    }

    public function testShowFasilitasUmum()
    {
        $FasilitasUmum = Fasilitas_umum::factory()->create();

        $response = $this->get("/PK/fasilitas/{$FasilitasUmum->id_fasilitas_umum}");

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.fasilitas.detail_fasilitas');
    }

    /**
     * Test delete method.
     *
     * @return void
     */
    public function testDeleteFasilitasUmum()
    {
        $fasilitasUmum = Fasilitas_umum::factory()->create();

        $response = $this->delete(route('pk.fasilitas.destroy', $fasilitasUmum->id_fasilitas_umum));

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.fasilitas.index'));
        // $this->assertDatabaseMissing('fasilitas_umums', ['id_fasilitas_umum' => $fasilitasUmum->id_fasilitas_umum]);
        // Add more assertions if needed

    }
}
