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
use App\Models\Warga;
use App\Http\Controllers\ChartController;
use App\Models\WargaMeninggal;
use App\Models\WargaMiskin;

class DashboardLurahTest extends TestCase
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
    public function testHomeLurah()
    {
        $response = $this->get(route('lurah.dashboard.home'));

        $response->assertStatus(200);
        $response->assertViewIs('Lurah.Dashboard.home');
        $response->assertViewHasAll([
            'warga',
            'wargaw',
            'wargatetap' => Warga::where('jenis_warga', 1)->where('status_warga', 0)->get(),
            'wargadatang' => Warga::where('jenis_warga', 0)->where('status_warga', 0)->get(),
            'kemiskinan',
            'surat',
            'no_kk' => Warga::distinct()->where('status_warga', 0)->count('no_kk'),
            'lk' => Warga::where('jenis_kelamin', 1)->where('status_warga', 0)->count('jenis_kelamin'),
            'pr' => Warga::where('jenis_kelamin', 2)->where('status_warga', 0)->count('jenis_kelamin'),
            'kegiatan',
            'gruprt' => Warga::withonly('rt_rel')->selectRaw('count(id_warga) as jumlah_warga, rt')->where('status_warga', 0)->groupBy('rt')->get(),
            'meninggal' => WargaMeninggal::count('id'),
            'miskin' => WargaMiskin::count('id'),
            'gender' => Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin2,rt')->where('jenis_kelamin', 1)->groupBy('rt')->get(),
            'gender2' => Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin3,rt')->where('jenis_kelamin', 0)->groupBy('rt')->get(),
            'lansia' => Warga::ageGreaterThan60()->get(),
            'kondisi_warga' => ChartController::kondisi_warga(),
            'jumlah_warga' => ChartController::jumlah_warga(),
            'jumlah_pengangguran' => ChartController::jumlah_pengangguran(),
            'jenis_kelamin' => ChartController::jenis_kelamin()
        ]);
        // Add more assertions if needed
    }
}
