<?php

namespace Tests\Unit\Lurah;

use App\Http\Controllers\RW\RWController;
use App\Http\Controllers\ChartController;
use App\Models\WargaMiskin as Kemiskinan;
use App\Models\Warga;
use App\Models\Kegiatan;
use App\Models\Surat;
use App\Models\WargaMeninggal;
use App\Models\WargaMiskin;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardLurahControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 2)->first();
        Auth::login($user);
    }

    public function testHomeRw()
    {

        // Execute the controller method
        $response = $this->get(route('lurah.dashboard.home'));

        // Assert the response
        $response->assertStatus(200)
            ->assertViewIs('Lurah.Dashboard.home')
            ->assertViewHasAll([
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
    }
}
