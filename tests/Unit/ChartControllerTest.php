<?php

namespace Tests\Unit;

use App\Http\Controllers\ChartController;
use App\Models\Berita;
use App\Models\User;
use App\Models\KategoriBerita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Models\Warga;
use App\Models\WargaMiskin;
use Illuminate\Support\Facades\DB;


// class ChartControllerTest extends TestCase
// {
//     use RefreshDatabase, WithFaker;

//     protected function setUp(): void
//     {
//         parent::setUp();

//         // $this->artisan('migrate');
//         // $this->artisan('db:seed');

//         // $user = User::where('role_id', 3)->first();
//         // Auth::login($user);
//     }

//     // public function testKondisiWarga()
//     // {
//     //     // Setup: Create dummy data for testing
//     //     $wargaMampuCount = 5;
//     //     $wargaMiskinCount = 0;
        
//     //     // Create dummy records in the database
//     //     Warga::factory()->count($wargaMampuCount)->create();
        
//     //     // Act: Call the method to be tested
//     //     $result = ChartController::kondisi_warga();
        
//     //     // Assert: Verify the result
//     //     $expectedResult = [
//     //         "warga_mampu" => round($wargaMampuCount / ($wargaMampuCount + $wargaMiskinCount) * 100 / 100, 2) * 100,
//     //         "warga_miskin" => round($wargaMiskinCount / ($wargaMampuCount + $wargaMiskinCount) * 100 / 100, 2) * 100
//     //     ];
        
//     //     $this->assertEquals($expectedResult, $result);
//     // }

//     // public function testJumlahWarga()
//     // {
//     //     // Setup: Create dummy data for testing
//     //     $rw = 1;
//     //     $rtCount = 3;
//     //     $wargaCount = 5;
        
//     //     // Create dummy records in the database
//     //     Warga::factory()->count($wargaCount)->create(['rw' => $rw]);
        
//     //     $wargaData = [];
//     //     for ($i = 1; $i <= $rtCount; $i++) {
//     //         $wargaData[] = [
//     //             'count' => $wargaCount,
//     //             'rw' => $rw,
//     //             'no_rt' => $i,
//     //             'no_rw' => 1,
//     //         ];
//     //     }
        
//     //     // Act: Call the method to be tested
//     //     $result = ChartController::jumlah_warga();
        
//     //     // Assert: Verify the result
//     //     $expectedResult = [
//     //         'list_rt' => ["RT 1", "RT 2", "RT 3"],
//     //         'data' => [$wargaCount, $wargaCount, $wargaCount],
//     //     ];
        
//     //     $this->assertEquals($expectedResult, $result);

//     // }
//     // public function testJumlahPengangguran()
//     // {
//     //     // Setup: Create dummy data for testing
//     //     $yearCount = 5;
//     //     $wargaCount = 10;
        
//     //     // Create dummy records in the database
//     //     Warga::factory()->count($wargaCount)->create(['pekerjaan' => 1]);
        
//     //     $wargaData = [];
//     //     for ($i = 1; $i <= $yearCount; $i++) {
//     //         $wargaData[] = [
//     //             'year' => 2021 + $i,
//     //             'count' => $wargaCount,
//     //         ];
//     //     }
        
//     //     // Act: Call the method to be tested
//     //     $result = ChartController::jumlah_pengangguran();
        
//     //     // Assert: Verify the result
//     //     $expectedResult = [
//     //         'year' => range(2022, 2026),
//     //         'data' => array_fill(0, $yearCount, $wargaCount),
//     //     ];
        
//     //     $this->assertEquals($expectedResult, $result);
        
//     //     // Clean up: Remove the dummy records from the database
//     //     Warga::truncate();
//     // }
    
//     // public function testJenisKelamin()
//     // {
//     //     // Setup: Create dummy data for testing
//     //     $wargaCount = 10;
        
//     //     // Create dummy records in the database
//     //     Warga::factory()->count($wargaCount)->create();
        
//     //     $wargaData = [
//     //         [
//     //             'count' => $wargaCount / 2,
//     //             'jenis_kelamin' => 1,
//     //         ],
//     //         [
//     //             'count' => $wargaCount / 2,
//     //             'jenis_kelamin' => 2,
//     //         ],
//     //     ];
        
//     //     // Act: Call the method to be tested
//     //     $result = ChartController::jenis_kelamin();
        
//     //     // Assert: Verify the result
//     //     $expectedResult = [
//     //         "jenis" => ["Laki-laki", "Perempuan"],
//     //         "data" => [50, 50],
//     //     ];
        
//     //     $this->assertEquals($expectedResult, $result);
        
//     //     // Clean up: Remove the dummy records from the database
//     //     Warga::truncate();
//     // }
    
//     // public function testPertumbuhanAnak()
//     // {
//     //     // Setup: Create dummy data for testing
//     //     $status = "putus-sekolah";
//     //     $usia = "5-10";
        
//     //     // Create dummy records in the database
//     //     $putusSekolahData = [
//     //         [
//     //             'year' => 2021,
//     //             'count' => 5,
//     //             'jenis_kelamin' => 1,
//     //         ],
//     //         [
//     //             'year' => 2021,
//     //             'count' => 3,
//     //             'jenis_kelamin' => 2,
//     //         ],
//     //         [
//     //             'year' => 2022,
//     //             'count' => 4,
//     //             'jenis_kelamin' => 1,
//     //         ],
//     //         [
//     //             'year' => 2022,
//     //             'count' => 2,
//     //             'jenis_kelamin' => 2,
//     //         ],
//     //     ];
        
//     //     // Act: Call the method to be tested
//     //     $response = ChartController::pertumbuhanAnak(new Request([
//     //         'status' => $status,
//     //         'usia' => $usia,
//     //     ]));
        
//     //     // Assert: Verify the result
//     //     $expectedResult = [
//     //         "data" => [
//     //             "year" => [2021, 2022],
//     //             "data" => [
//     //                 "laki" => [5, 4],
//     //                 "perempuan" => [3, 2],
//     //             ],
//     //         ],
//     //     ];
        
//     //     $this->assertEquals($expectedResult, json_decode($response->getContent(), true));
//     // }
// }

