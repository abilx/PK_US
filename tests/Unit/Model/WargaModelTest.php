<?php

namespace Tests\Unit\Model;

use App\Models\Warga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class WargaModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');        
    }

    /**
     * Test creating a new warga.
     *
     * @return void
     */
    public function testCreateWarga()
    {
        
        $wargaData = [
            'nik' => $this->faker->numerify('############'),
            'nama_lengkap' => $this->faker->name,
            'no_kk' => $this->faker->numerify('############'),
            'nama_kepala_keluarga' => $this->faker->name,
            'nokk_kepala_keluarga' => $this->faker->numerify('############'),
            'status_hubungan_dalam_keluarga' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'alamat' => $this->faker->address,
            'kelurahan' => $this->faker->randomNumber(),
            'kecamatan' => $this->faker->randomNumber(),
            'kabupaten' => $this->faker->randomNumber(),
            'provinsi' => $this->faker->randomNumber(),
            'nama_dusun' => $this->faker->word,
            'kode_pos' => $this->faker->postcode,
            'tempat_lahir' => $this->faker->city,
            'tgl_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement([1, 2]),
            'agama' => $this->faker->randomNumber(),
            'golongan_darah' => $this->faker->randomNumber(),
            'pendidikan' => $this->faker->randomNumber(),
            'pekerjaan' => $this->faker->randomNumber(),
            'status_perkawinan' => $this->faker->randomElement(['belum_kawin', 'kawin', 'cerai_hidup', 'cerai']),
            'jenis_warga' => $this->faker->randomElement([0, 1]),
            'nomor_passport' => $this->faker->numerify('############'),
            'tgl_akhir_passport' => $this->faker->date(),
            'nomor_kitaskitap' => $this->faker->numerify('############'),
            'nik_ayah' => $this->faker->numerify('############'),
            'nama_ayah' => $this->faker->name,
            'nik_ibu' => $this->faker->numerify('############'),
            'nama_ibu' => $this->faker->name,
            'tgl_keluar_kk' => $this->faker->date(),
            'foto_warga' => 'avatar.jpg',
            'tgl_perkawinan' => $this->faker->date(),
            'akta_kawin' => $this->faker->randomNumber(),
            'akta_cerai' => $this->faker->randomNumber(),
            'tgl_cerai' => $this->faker->date(),
            'akta_kelahiran' => $this->faker->randomNumber(),
            'kelainan' => $this->faker->word,
            'email_warga' => $this->faker->email,
            'no_hp_warga' => $this->faker->phoneNumber,
            'rt' => 1,
            'rw' => 1,
            'penerima_beasiswa' => $this->faker->randomElement([0, 1]),
            'status_warga' => $this->faker->randomElement([0, 1, 3]),
            'active' => 1,
        ];

        $warga = Warga::create($wargaData);

        // dd($warga);

        $this->assertInstanceOf(Warga::class, $warga);
        $this->assertDatabaseHas('wargas', $wargaData);
    }

    /**
     * Test updating an existing warga.
     *
     * @return void
     */
    public function testUpdateWarga()
    {
        $warga = Warga::factory()->create();

        $updatedData = [
            'nama_lengkap' => 'Updated Name',
            'alamat' => 'Updated Address',
        ];

        $warga->update($updatedData);

        $this->assertEquals('Updated Name', $warga->nama_lengkap);
        $this->assertEquals('Updated Address', $warga->alamat);
        $this->assertDatabaseHas('wargas', $updatedData);
    }

    /**
     * Test deleting a warga.
     *
     * @return void
     */
    public function testDeleteWarga()
    {
        $wargaData = Warga::factory()->definition();

        $warga = Warga::create($wargaData);


        $warga->delete();

        $this->assertDeleted($warga);
    }

  


    public function testWargaModelHasCorrectAttributes()
    {
        $warga = Warga::factory()->create();

        $this->assertNotNull($warga->id_warga);
        $this->assertNull($warga->user_id);
        $this->assertNotNull($warga->nik);
        $this->assertNotNull($warga->nama_lengkap);
        $this->assertNotNull($warga->no_kk);
        $this->assertNotNull($warga->nama_kepala_keluarga);
        $this->assertNotNull($warga->nokk_kepala_keluarga);
        $this->assertNotNull($warga->status_hubungan_dalam_keluarga);
        $this->assertNotNull($warga->alamat);
        $this->assertNotNull($warga->kelurahan);
        $this->assertNotNull($warga->kecamatan);
        $this->assertNotNull($warga->kabupaten);
        $this->assertNotNull($warga->provinsi);
        $this->assertNotNull($warga->nama_dusun);
        $this->assertNotNull($warga->kode_pos);
        $this->assertNotNull($warga->tempat_lahir);
        $this->assertNotNull($warga->tgl_lahir);
        $this->assertNotNull($warga->jenis_kelamin);
        $this->assertNotNull($warga->agama);
        $this->assertNotNull($warga->golongan_darah);
        $this->assertNotNull($warga->pendidikan);
        $this->assertNotNull($warga->pekerjaan);
        $this->assertNotNull($warga->status_perkawinan);
        $this->assertNotNull($warga->jenis_warga);
        $this->assertNotNull($warga->nomor_passport);
        $this->assertNotNull($warga->tgl_akhir_passport);
        $this->assertNotNull($warga->nomor_kitaskitap);
        $this->assertNotNull($warga->nik_ayah);
        $this->assertNotNull($warga->nama_ayah);
        $this->assertNotNull($warga->nik_ibu);
        $this->assertNotNull($warga->nama_ibu);
        $this->assertNotNull($warga->tgl_keluar_kk);
        $this->assertEquals('no-image.png', $warga->foto_warga);
        $this->assertNotNull($warga->tgl_perkawinan);
        $this->assertNotNull($warga->akta_kawin);
        $this->assertNotNull($warga->akta_cerai);
        $this->assertNotNull($warga->tgl_cerai);
        $this->assertNotNull($warga->akta_kelahiran);
        $this->assertNotNull($warga->kelainan);
        $this->assertNotNull($warga->email_warga);
        $this->assertNotNull($warga->no_hp_warga);
        $this->assertNotNull($warga->rt);
        $this->assertNotNull($warga->rw);
        $this->assertNotNull($warga->penerima_beasiswa);
        $this->assertNotNull($warga->status_warga);
        $this->assertEquals(1, $warga->active);
    }

    public function testUniqueNomorKitasKitap()
    {
        $nomorKitasKitap = '12345678';

        // Create a warga with the specified nomor_kitaskitap
        Warga::factory()->create([
            'nomor_kitaskitap' => $nomorKitasKitap,
        ]);

        // Attempt to create another warga with the same nomor_kitaskitap
        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->expectExceptionMessageMatches('/Duplicate entry/');

        Warga::factory()->create([
            'nomor_kitaskitap' => $nomorKitasKitap,
        ]);
    }
}
