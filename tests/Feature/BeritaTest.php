<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class BeritaTest extends TestCase
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
    public function testIndexBerita()
    {
        $response = $this->get(route('pk.berita.index'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.berita.tabel_berita');
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateBerita()
    {
        $response = $this->get(route('pk.berita.create'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.berita.tambah_berita');
        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreBerita()
    {
        // Storage::fake('gambar-Berita');

        $data = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => UploadedFile::fake()->image('test.jpg'),
            'kategori_berita' => 1,
        ];

        $response = $this->post(route('pk.berita.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.berita.index'));
        $this->assertDatabaseHas('beritas', ['judul' => $data['judul']]);
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditBerita()
    {
        $Berita = Berita::factory()->create();

        $response = $this->get(route('pk.berita.edit', $Berita));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.berita.edit_berita');
        $response->assertViewHas('berita', $Berita);
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateBerita()
    {
        // Storage::fake('gambar-Berita');

        $Berita = Berita::factory()->create();

        $data = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => UploadedFile::fake()->image('test.jpg'),
            'kategori_berita' => 1,
            'created_at' => '2023-10-23',
        ];

        $response = $this->put(route('pk.berita.update', $Berita), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.berita.index'));
        $this->assertDatabaseHas('beritas', ['id' => $Berita['id']]);
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyBerita()
    {
        // Storage::fake('gambar-Berita');

        $Berita = Berita::factory()->create();

        $response = $this->delete(route('pk.berita.destroy', $Berita));

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.berita.index'));
        $this->assertDeleted($Berita);
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowBerita()
    {
        $Berita = Berita::factory()->create();

        $response = $this->get(route('pk.berita.show', $Berita));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.berita.detail_berita');
        $response->assertViewHas('berita', $Berita);
        // Add more assertions if needed
    }

}
