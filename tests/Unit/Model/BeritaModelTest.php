<?php

namespace Tests\Unit\Model;

use App\Models\Berita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;

class BeritaModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new Berita.
     *
     * @return void
     */
    public function testCreateBerita()
    {
        $beritaData = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => 'example.jpg',
            'kategori_berita' => 1,
        ];

        $berita = Berita::create($beritaData);

        $this->assertInstanceOf(Berita::class, $berita);
        $this->assertDatabaseHas('beritas', $beritaData);
    }

    /**
     * Test updating an existing Berita.
     *
     * @return void
     */
    public function testUpdateBerita()
    {
        $berita = Berita::factory()->create();

        $updatedData = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => 'updated.jpg',
            'kategori_berita' => 2,
        ];

        $berita->update($updatedData);

        $this->assertEquals($updatedData['judul'], $berita->judul);
        $this->assertEquals($updatedData['isi'], $berita->isi);
        $this->assertEquals($updatedData['gambar'], $berita->gambar);
        $this->assertEquals($updatedData['kategori_berita'], $berita->kategori_berita);
        $this->assertDatabaseHas('beritas', $updatedData);
    }

    /**
     * Test deleting a Berita.
     *
     * @return void
     */
    public function testDeleteBerita()
    {
        $beritaData = [
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'gambar' => 'example.jpg',
            'kategori_berita' => 1,
        ];

        $berita = Berita::create($beritaData);

        $berita->delete();

        $this->assertDeleted($berita);
    }

    public function testBeritaModelHasCorrectAttributes()
    {
        $berita = Berita::factory()->create();

        $this->assertNotNull($berita->id);
        $this->assertNotNull($berita->judul);
        $this->assertNotNull($berita->isi);
        $this->assertNotNull($berita->gambar);
        $this->assertNotNull($berita->kategori_berita);
        $this->assertNotNull($berita->created_at);
        $this->assertNotNull($berita->updated_at);
    }
}
