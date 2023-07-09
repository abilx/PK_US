<?php

namespace App\Http\Controllers\Warga;

use App\Models\Warga;
use App\Models\WargaMiskin as Kemiskinan;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\Fasilitas_umum;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LPController extends Controller
{
    public function home()
    {
        $warga = Warga::where('status_warga', 0)->get();
        $wargaw = Warga::take(5)->where('status_warga', 0)->get();
        $wargatetap = Warga::where('jenis_warga', 1)->where('status_warga', 0)->get();
        $wargadatang = Warga::where('jenis_warga', 0)->where('status_warga', 0)->get();
        $kemiskinan = Kemiskinan::latest()->get();
        $lansia = Warga::ageGreaterThan60()->get();

        $lk = Warga::where('jenis_kelamin', 1)->where('status_warga', 0)->count('jenis_kelamin');
        $pr = Warga::where('jenis_kelamin', 2)->where('status_warga', 0)->count('jenis_kelamin');
        $kk = Warga::distinct()->where('status_warga', 0)->count('no_kk');
        $kegiatan = Kegiatan::with('Kategori_kegiatans')->take(5)->where('tgl_mulai_kegiatan', '>=', Carbon::now())->get();
        // $surat = Surat::with('wargas')->take(5)->where('status_surat', 0)->latest()->get();
        $gruprt = Warga::withonly('rt_rel')->selectRaw('count(id_warga) as jumlah_warga, rt')->where('status_warga', 0)->groupBy('rt')->get();
        // $meninggal = WargaMeninggal::count('id');
        // $miskin = WargaMiskin::count('id');
        $gender = Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin2,rt')->where('jenis_kelamin', 1)->groupBy('rt')->get();
        $gender2 = Warga::withonly('rt_rel')->selectRaw('count(jenis_kelamin) as jenis_kelamin3,rt')->where('jenis_kelamin', 0)->groupBy('rt')->get();
        // dd($meninggal);
        $pengaduan = KategoriPengaduan::get();
        $berita = Berita::filter(request(['search', 'category']))->paginate(7)->withQueryString();

        // chart
        $kondisi_warga = ChartController::kondisi_warga();
        $jumlah_warga = ChartController::jumlah_warga();
        $jumlah_pengangguran = ChartController::jumlah_pengangguran();
        $jenis_kelamin = ChartController::jenis_kelamin();

        return view('index', [
            "title" => "Dashboard",
            'warga' => $warga,
            // 'surat' => $surat,
            'wargaw' => $wargaw,
            'wargatetap' => $wargatetap,
            'wargadatang' => $wargadatang,
            'no_kk' => $kk,
            'lk' => $lk,
            'pr' => $pr,
            'kegiatan' => $kegiatan,
            'gruprt' => $gruprt,
            // 'meninggal' => $meninggal,
            // 'miskin' => $miskin,
            'gender' => $gender,
            'gender2' => $gender2,
            'kondisi_warga' => $kondisi_warga,
            'jumlah_warga' => $jumlah_warga,
            'jumlah_pengangguran' => $jumlah_pengangguran,
            'jenis_kelamin' => $jenis_kelamin,
            'pengaduan' => $pengaduan,
            'berita' => $berita,
            'kemiskinan' => $kemiskinan,
            'lansia' => $lansia,
        ]);
    }
    
    public function kegiatan()
    {
        $kegiatan = Kegiatan::where('status_kegiatan', 1)->latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString();

        return view('Warga.kegiatan.kegiatan', [
            'kegiatan' => $kegiatan,
            "title" => "Kegiatan"
        ]);
    }

    public function kegiatan_show($id)
    {
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();
        return view('Warga.kegiatan.detail_kegiatan', [
            'kegiatan' => $kegiatan,
        ]);
    }

    public function pengumuman()
    {

        $pengumuman = Pengumuman::where('status_pengumuman', 1)
                        ->PengumumanActive()
                        ->latest()
                        ->filter(request(['search', 'category']))
                        ->paginate(7)
                        ->withQueryString();
        return view('Warga.pengumuman.pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }

    public function pengumuman_show($id)
    {
        $pengumuman = Pengumuman::where('id_pengumuman', $id)->first();
        // dd($rw);

        return view('Warga.pengumuman.detail_pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }

    public function fasilitas()
    {
        $fasilitas = Fasilitas_umum::where('status_fasilitas', 1)->latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString();
        return view('Warga.fasilitas.fasilitas', [
            'fasilitas' => $fasilitas,
            "title" => "Fasilitas_umum"
        ]);
    }

    public function fasilitas_show($id)
    {
        $fasilitas = Fasilitas_umum::where('id_fasilitas_umum', $id)->first();
        return view('Warga.fasilitas.detail_fasilitasw', [
            'fasilitas' => $fasilitas,
        ]);
    }

    public function berita()
    {

        $berita = Berita::filter(request(['search', 'category']))->paginate(7)->withQueryString();

        return view('Warga.berita.berita', [
            'berita' => $berita,
            "title" => "Berita"
        ]);
    }

    public function berita_show($id)
    {
        $berita = Berita::where('id', $id)->first();
        return view('Warga.berita.detail_berita', [
            'berita' => $berita,
        ]);
    }

    public function store_pengaduan(Request $request)
    {
        //
        $data = $request->except('_token');
        $data = $request->validate([
            'judul_pengaduan' => 'required|string',
            'deskripsi_pengaduan' => 'required|string',
            'kategori_pengaduan' => 'required',
            'bukti_pengaduan' => 'image|mimes:jpeg,jpg,png',
            'nik' => 'required|string',
        ]);
        $data['id_rt'] = $request->rt;
        //untuk mengecek apakah ada inputan gambar, jika ada gambar akan disimpan
        if ($request->file('bukti_pengaduan')) {
            $custom_file_name = time() . '-' . $request->file('bukti_pengaduan')->getClientOriginalName();
            $data['bukti_pengaduan'] = $request->file('bukti_pengaduan')->storeAs('gambar-pengduan-warga', $custom_file_name);
        }
        // else
        // {
        //     $data['bukti_pengaduan'] = 'assets/images/dashboard/bg.jpg';
        // }

        pengaduan::create($data);
        
        return redirect()->back()->with('success', 'Data berhasil ditambahkan')->with('focusBottom', true);
        
    }

    public function cek_warga(Request $request)
    {
        // $jenazah= Warga::where('nik', $warga->nik)->first();
        $warga = Warga::with('pekerjaans')->select('id_warga', 'nama_lengkap', 'jenis_kelamin', 'pekerjaan', 'agama', 'tempat_lahir', 'tgl_lahir', 'alamat', 'rt')
            ->where('nik', $request->id)
            ->first();
        if ($warga) {
            return response()->json(['success' => 'Data ditemukan.', 'data' => $warga]);
        }
        return response()->json(['success' => 'Data tidak ditemukan.', 'data' => $warga]);
        // dd($jenazah);
    }



    // public function index()
    // {
    //     //Tampilakan Pengduan yang boleh ditampilkan baik dalam kondisi proses , ditanggapi ataupun di tolak
    //     // $data = pengaduan::ShowOn()->where('id_rt', auth()->user()->_warga->rt)->latest()->get();
    //     $data = pengaduan::ShowOn()->latest()->get();
    //     return view('warga.pengaduan.pengaduan-warga', compact('data'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    //     $pengaduan = KategoriPengaduan::get();
    //     return view('warga.pengaduan.pengaduan-warga-tambah', compact('pengaduan'));
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\pengaduan  $pengaduan
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $data = pengaduan::find($id);
    //     return $data;
    // }

    // public function tanggapin(Request $request)
    // {
        
    //     //
    //     // dd( pengaduan::find($pengaduan->id_pengaduan));
    //     $data = Pengaduan::where('id_pengaduan', $request->id_validasi)
    //             ->update(['tanggapan_pengaduan' => $request->tanggapan_rt, 'status_pengaduan' => 2, 'ditampilkan' => 1]);
        
    //     if($data){
    //         return redirect()->route('rt.pengaduan.home')
    //         ->with('success', 'Pengaduan telah di validasi!');
    //     }

    //     return redirect()->route('rt.pengaduan.home')
    //     ->with('error', 'Terjadil kegagalan sistem, mohon maaf');
    // }

    // public function pengaduan_pribadi()
    // {
    //     $data = pengaduan::where('nik', auth()->user()->_warga->nik)
    //         ->latest()
    //         ->get();
    //     return view('warga.pengaduan.pengaduan-warga-pribadi', compact('data'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\pengaduan  $pengaduan
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(pengaduan $pengaduan)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\pengaduan  $pengaduan
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, pengaduan $pengaduan)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\pengaduan  $pengaduan
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(pengaduan $pengaduan)
    // {
    //     //
    //     try {
    //         $pengaduan->delete();
    //         if ($pengaduan->bukti_pengaduan) {
    //             Storage::delete($pengaduan->bukti_pengaduan);
    //         }
    //         return redirect()->route('warga.pengaduan.pribadi')
    //         ->with('success', 'Data berhasil dihapus!');
    //     } catch (\Exception $e) {
    //         return redirect()->route('warga.pengaduan.pribadi')
    //         ->with('error', 'Gagal menghapus data!');
    //     }
    // }
}
