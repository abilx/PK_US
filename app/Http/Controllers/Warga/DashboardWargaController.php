<?php

namespace App\Http\Controllers\Warga;

use App\Charts\DashboardRWChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Surat;
use App\Models\WargaMeninggal;
use App\Models\WargaMiskin;
use Carbon\Carbon;

class DashboardWargaController extends Controller
{
    //
    public function index()
    {
        $id_rt = auth()->user()->_warga->rt;
        $id_rw = auth()->user()->_warga->rw;
        $warga = Warga::where('rt', $id_rt)->where('rw', $id_rw)->get();
        $wargaw = Warga::where('rt', $id_rt)->where('rw', $id_rw)->take(5)->get();
        $wargatetap = Warga::where('rt', $id_rt)->where('rw', $id_rw)->where('jenis_warga', 1)->get();
        $wargadatang = Warga::where('rt', $id_rt)->where('rw', $id_rw)->where('jenis_warga', 0)->get();
        $lk = Warga::where('rt', $id_rt)->where('rw', $id_rw)->where('jenis_kelamin', 1)->count('jenis_kelamin');
        $pr = Warga::where('rt', $id_rt)->where('rw', $id_rw)->where('jenis_kelamin', 2)->count('jenis_kelamin');
        $kk = Warga::distinct()->where('rt', $id_rt)->where('rw', $id_rw)->count('no_kk');
        $kegiatan = Kegiatan::with('Kategori_kegiatans')->take(5)->where('tgl_mulai_kegiatan', '>=', Carbon::now()->format('Y-m-d'))->where('penanggung_jawab', 'RT')->where('id_penanggung_jawab', $id_rt)->get();
        $pengumuman = Pengumuman::with('Kategori_pengumumans')->take(5)->where('tgl_terbit', '<=', Carbon::now()->format('Y-m-d'))->where('penanggung_jawab', 'RT')->where('id_penanggung_jawab', $id_rt)->get();
        $surat = Surat::with('wargas')->take(5)->where('status_surat', 0)->whereHas('wargas', function ($q) {
            $q->where('id_warga', auth()->user()->id_warga);
        })->latest()->get();
        // $meninggal = WargaMeninggal::where('rt', $id_rt)->where('rw', $id_rw)->count('id');
        $meninggal = WargaMeninggal::whereHas('wargas', function ($q) {
            $q->where('rt', auth()->user()->rt)->where('rw', auth()->user()->_warga->rw);
        })->whereYear('tgl_kematian', now()->year)->count('id');
        $miskin = WargaMiskin::whereHas('wargas', function ($q) {
            $q->where('rt', auth()->user()->rt)->where('rw', auth()->user()->_warga->rw);
        })->whereYear('created_at', now()->year)->count('id');
        return view(
            'Warga.dashboard-warga',
            [
                'warga' => $warga,
                'surat' => $surat,
                'wargaw' => $wargaw,
                'wargatetap' => $wargatetap,
                'wargadatang' => $wargadatang,
                'no_kk' => $kk,
                'lk' => $lk,
                'pr' => $pr,
                'kegiatan' => $kegiatan,
                'pengumuman' => $pengumuman,
                'meninggal' => $meninggal,
                'miskin' => $miskin,
                //'dashboardRWChart' => $DashboardRWChart->build(),
            ]
        );
    }
}
