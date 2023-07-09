<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Kegiatan;
use App\Models\Surat;
use App\Models\WargaMeninggal;
use App\Models\WargaMiskin;
use Carbon\Carbon;
use Database\Seeders\WargaMiskinTableSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
  public static function kondisi_warga()
  {
    $warga_mampu = Warga::leftJoin('warga_miskin', 'wargas.id_warga', '=', 'warga_miskin.warga')
      ->whereNull('warga_miskin.warga')
      ->count();

    $warga_miskin = WargaMiskin::count();

    $total_warga = $warga_mampu + $warga_miskin;

    $kondisi_warga =  [
      "warga_mampu" => round($warga_mampu / $total_warga * 100 / 100, 2) * 100,
      "warga_miskin" => round($warga_miskin / $total_warga * 100 / 100, 2) * 100
    ];

    return $kondisi_warga;
  }

  public static function jumlah_warga()
  {
    $rt = [];
    $data = [];
    if(Auth::check() && auth()->user()->role_id == 4)
    {
        $warga = DB::table('wargas')
        ->join('rts', 'wargas.rt', '=', 'rts.id_rt')
        ->join('rws', 'wargas.rw', '=', 'rws.id_rw')
        ->whereNotNull('wargas.created_at')
        ->where('wargas.rw', auth()->user()->user_rel->id_rw)
        ->groupBy('wargas.rw', 'rts.no_rt', 'rws.no_rw')
        ->select(DB::raw('COUNT(wargas.id_warga) as count, wargas.rw, rts.no_rt, rws.no_rw'))
        ->orderBy('rts.no_rt')
        ->get();

        foreach ($warga as $w) {
          array_push($rt, "RT " . $w->no_rt);
          array_push($data, $w->count);
       
        }
      }
    else
    {
      $warga = DB::table('wargas')
        ->join('rws', 'wargas.rw', '=', 'rws.id_rw')
        ->whereNotNull('wargas.created_at')
        ->groupBy('wargas.rw', 'rws.no_rw')
        ->select(DB::raw('COUNT(wargas.id_warga) as count, wargas.rw, rws.no_rw'))
        ->orderBy('rws.no_rw')
        ->get();

      foreach ($warga as $w) {
        array_push($rt, "RW $w->no_rw");
        array_push($data, $w->count);
      }
    }
    
    return [
      'list_rt' => $rt,
      'data' => $data,
    ];
  }

  public static function jumlah_pengangguran()
  {
    $warga = Warga::without('pekerjaans')->where('pekerjaan', '=', 1)->selectRaw('YEAR(created_at) as year, count(*) as count')->groupBy('year')->get();

    $year = [];
    $data = [];

    foreach ($warga as $w) {
      if (isset($w->year)) {
        array_push($year, $w->year);
        array_push($data, $w->count);
      }
    }

    return [
      'year' => $year,
      'data' => $data
    ];
  }

  public static function jenis_kelamin()
  {
    $warga = Warga::without('pekerjaans')->selectRaw('count(*) as count, jenis_kelamin')->groupBy('jenis_kelamin')->get();

    $jenis = [];
    $data = [];

    $total = 0;

    foreach ($warga as $w) {
      $total += $w->count;
    }

    foreach ($warga as $w) {
      $kelamin = "";
      if ($w->jenis_kelamin == 1) {
        $kelamin = "Laki-laki";
      } else if ($w->jenis_kelamin == 2) {
        $kelamin = "Perempuan";
      }

      array_push($jenis, $kelamin);

      $percentage = round($w->count / $total * 100 / 100, 2) * 100;

      array_push($data, $percentage);
    }

    return [
      "jenis" => $jenis,
      "data" => $data
    ];
  }

  public function getPutusSekolah($usia)
  {
    $usia = explode("-", $usia);

    $warga = DB::select("SELECT YEAR(created_at) AS year, COUNT(*) AS count, jenis_kelamin
    FROM (
      SELECT *, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tgl_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tgl_lahir, '00-%m-%d')) AS usia
      FROM wargas
    ) AS subquery
    WHERE pendidikan = 2 AND usia BETWEEN $usia[0] AND $usia[1]
    GROUP BY jenis_kelamin, year
    ORDER BY year");

    return $warga;
  }

  public function getBeasiswa($usia)
  {
    $usia = explode("-", $usia);

    $warga = DB::select("SELECT YEAR(created_at) AS year, COUNT(*) AS count, jenis_kelamin
    FROM (
      SELECT *, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tgl_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tgl_lahir, '00-%m-%d')) AS usia
      FROM wargas
    ) AS subquery
    WHERE penerima_beasiswa = 1 AND usia BETWEEN $usia[0] AND $usia[1]
    GROUP BY jenis_kelamin, year
    ORDER BY year");

    return $warga;
  }

  public function getYatim($usia)
  {
    $usia = explode("-", $usia);

    $warga = DB::select("SELECT YEAR(w.created_at) AS year, COUNT(*) AS count, w.jenis_kelamin
    FROM (
      SELECT w.created_at, w.status_hubungan_dalam_keluarga, w.jenis_kelamin, w.no_kk,
        DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tgl_lahir, '%Y') - (DATE_FORMAT(NOW(),
      '00-%m-%d') < DATE_FORMAT(tgl_lahir, '00-%m-%d')) AS usia
      FROM wargas w, warga_meninggal wm
      where w.id_warga = wm.warga
    ) AS wm, (
      SELECT *, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tgl_lahir, '%Y') - (DATE_FORMAT(NOW(), 
	  '00-%m-%d') < DATE_FORMAT(tgl_lahir, '00-%m-%d')) AS usia
      FROM wargas
    ) AS  w
    WHERE wm.no_kk = w.no_kk
    AND w.status_hubungan_dalam_keluarga = 4
    AND w.usia BETWEEN $usia[0] AND $usia[1]
    GROUP BY w.jenis_kelamin, year
    ORDER BY year");

    return $warga;
  }

  public function pertumbuhanAnak(Request $request)
  {
    $status = $request->input('status');
    $usia = $request->input('usia');

    $laki = [];
    $perempuan = [];
    $year = [];
    $warga = [];

    if ($status == "putus-sekolah") {
      $warga = $this->getPutusSekolah($usia);
    } else if ($status == "beasiswa") {
      $warga = $this->getBeasiswa($usia);
    } else if ($status == "yatim") {
      $warga = $this->getYatim($usia);
    }

    foreach ($warga as $w) {
      if ($w->jenis_kelamin == 1) {
        array_push($laki, $w->count);
      } else if ($w->jenis_kelamin == 2) {
        array_push($perempuan, $w->count);
      }

      array_push($year, $w->year);
    }

    return response()->json([
      "data" => [
        "year" => array_values(array_unique($year)),
        "data" => [
          "laki" => $laki,
          "perempuan" => $perempuan
        ]
      ],
    ]);
  }
}
