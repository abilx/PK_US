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

class KegiatanTest extends TestCase
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
    public function testIndexKegiatan()
    {
        $response = $this->get(route('pk.kegiatan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Kegiatan.tabel_kegiatan');
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateKegiatan()
    {
        $response = $this->get(route('pk.kegiatan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Kegiatan.tambah_kegiatan');
        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreKegiatan()
    {
        // Storage::fake('gambar-kegiatan');

        $data = [
            'nama_kegiatan' => $this->faker->sentence,
            'kategori_kegiatan' => 1,
            'isi_kegiatan' => $this->faker->paragraph,
            'foto_kegiatan' => UploadedFile::fake()->image('test.jpg'),
            'tgl_mulai_kegiatan' => now(),
            'tgl_selesai_kegiatan' => now(),
        ];

        $response = $this->post(route('pk.kegiatan.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.kegiatan.index'));
        $this->assertDatabaseHas('kegiatan', ['nama_kegiatan' => $data['nama_kegiatan']]);
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditKegiatan()
    {
        $kegiatan = Kegiatan::factory()->create();

        $response = $this->get(route('pk.kegiatan.edit', $kegiatan));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Kegiatan.edit_kegiatan');
        $response->assertViewHas('kegiatan', $kegiatan);
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateKegiatan()
    {
        // Storage::fake('gambar-kegiatan');

        $kegiatan = Kegiatan::factory()->create();

        $data = [
            'nama_kegiatan' => $this->faker->sentence,
            'kategori_kegiatan' => 1,
            'isi_kegiatan' => $this->faker->paragraph,
            'foto_kegiatan' => UploadedFile::fake()->image('test.jpg'),
            'tgl_mulai_kegiatan' => now(),
            'tgl_selesai_kegiatan' => now(),
        ];

        $response = $this->put(route('pk.kegiatan.update', $kegiatan), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.kegiatan.index'));
        $this->assertDatabaseHas('kegiatan', ['nama_kegiatan' => $data['nama_kegiatan']]);
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyKegiatan()
    {
        // Storage::fake('gambar-kegiatan');

        $kegiatan = Kegiatan::factory()->create();

        $response = $this->delete(route('pk.kegiatan.destroy', $kegiatan));

        $response->assertStatus(302);
        $response->assertRedirect(route('pk.kegiatan.index'));
        $this->assertDeleted($kegiatan);
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

        $response = $this->get(route('pk.kegiatan.show', $kegiatan));

        $response->assertStatus(200);
        $response->assertViewIs('PetugasKelurahan.Kegiatan.detail_kegiatan');
        $response->assertViewHas('kegiatan', $kegiatan);
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusKegiatan()
    {
        $kegiatan = Kegiatan::factory()->create();

        $response = $this->get(route('pk.kegiatan.update.status', [
            'status_kegiatan' => 1, // Update objek RW dengan status_rw 1
            'id_kegiatan' => $kegiatan->id_kegiatan,
        ]));    

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Status change successfully.']);
        $this->assertDatabaseHas('kegiatan', ['id_kegiatan' => $kegiatan->id_kegiatan, 'status_kegiatan' => 1]);
        // Add more assertions if needed
    }
}
