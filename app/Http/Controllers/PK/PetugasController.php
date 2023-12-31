<?php

namespace App\Http\Controllers\PK;

use App\Http\Controllers\ChartController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WargaMiskin as Kemiskinan;
use App\Models\Warga;
use App\Models\Kegiatan;
use App\Models\Surat;
use App\Models\WargaMeninggal;
use App\Models\WargaMiskin;
use Carbon\Carbon;

class PetugasController extends Controller
{
  public function home_petugas()
  {
    $warga = Warga::where('status_warga', 0)->get();
    $wargaw = Warga::take(5)->where('status_warga', 0)->get();
    $lansia = Warga::ageGreaterThan60()->get();
    $wargatetap = Warga::where('jenis_warga', 1)->where('status_warga', 0)->get();
    $wargadatang = Warga::where('jenis_warga', 0)->where('status_warga', 0)->get();
    $kemiskinan = Kemiskinan::latest()->get();

    $lk = Warga::where('jenis_kelamin', 1)->where('status_warga', 0)->count('jenis_kelamin');
    $pr = Warga::where('jenis_kelamin', 2)->where('status_warga', 0)->count('jenis_kelamin');
    $kk = Warga::distinct()->where('status_warga', 0)->count('no_kk');
    $kegiatan = Kegiatan::with('Kategori_kegiatans')->take(5)->where('tgl_mulai_kegiatan', '>=', Carbon::now())->get();
    $surat = Surat::with('wargas')->take(5)->where('status_surat', 0)->latest()->get();
    $gruprt = Warga::withonly('rt_rel')->selectRaw('count(id_warga) as jumlah_warga, rt')->where('status_warga', 0)->groupBy('rt')->get();
    $meninggal = WargaMeninggal::count('id');
    $miskin = WargaMiskin::count('id');
    $gender = Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin2,rt')->where('jenis_kelamin', 1)->groupBy('rt')->get();
    $gender2 = Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin3,rt')->where('jenis_kelamin', 0)->groupBy('rt')->get();
    // dd($meninggal);

    // chart
    $kondisi_warga = ChartController::kondisi_warga();
    $jumlah_warga = ChartController::jumlah_warga();
    $jumlah_pengangguran = ChartController::jumlah_pengangguran();
    $jenis_kelamin = ChartController::jenis_kelamin();

    return view('PetugasKelurahan.Dashboard.home', [
      "title" => "Dashboard",
      'warga' => $warga,
      'surat' => $surat,
      'wargaw' => $wargaw,
      'wargatetap' => $wargatetap,
      'wargadatang' => $wargadatang,
      'kemiskinan' => $kemiskinan,
      'no_kk' => $kk,
      'lk' => $lk,
      'pr' => $pr,
      'kegiatan' => $kegiatan,
      'gruprt' => $gruprt,
      'meninggal' => $meninggal,
      'miskin' => $miskin,
      'gender' => $gender,
      'gender2' => $gender2,
      'lansia' => $lansia,
      'kondisi_warga' => $kondisi_warga,
      'jumlah_warga' => $jumlah_warga,
      'jumlah_pengangguran' => $jumlah_pengangguran,
      'jenis_kelamin' => $jenis_kelamin
    ]);
  }
}
