<?php

namespace App\Http\Controllers\Warga;

use App\Models\Warga;
use App\Models\pengaduan;
use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tampilakan Pengduan yang boleh ditampilkan baik dalam kondisi proses , ditanggapi ataupun di tolak
        // $data = pengaduan::ShowOn()->where('id_rt', auth()->user()->_warga->rt)->latest()->get();
        $data = pengaduan::ShowOn()->latest()->get();
        return view('Warga.pengaduan.pengaduan-warga', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pengaduan = KategoriPengaduan::get();
        return view('Warga.pengaduan.pengaduan-warga-tambah', compact('pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $data = $request->validate([
            'judul_pengaduan' => 'required|string',
            'deskripsi_pengaduan' => 'required|string',
            'kategori_pengaduan' => 'required',
            'bukti_pengaduan' => 'image|mimes:jpeg,jpg,png'
        ]);
        $data['nik'] = auth()->user()->_warga->nik;
        $data['id_rt'] = auth()->user()->_warga->rt;
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
        return redirect()->route('warga.pengaduan.pribadi')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = pengaduan::find($id);
        return $data;
    }

    public function tanggapin(Request $request)
    {
        
        //
        // dd( pengaduan::find($pengaduan->id_pengaduan));
        $data = Pengaduan::where('id_pengaduan', $request->id_validasi)
                ->update(['tanggapan_pengaduan' => $request->tanggapan_rt, 'status_pengaduan' => 2, 'ditampilkan' => 1]);
        
        if($data){
            return redirect()->route('rt.pengaduan.home')
            ->with('success', 'Pengaduan telah di validasi!');
        }

        return redirect()->route('rt.pengaduan.home')
        ->with('error', 'Terjadil kegagalan sistem, mohon maaf');
    }

    public function pengaduan_pribadi()
    {
        $data = pengaduan::where('nik', auth()->user()->_warga->nik)
            ->latest()
            ->get();
        return view('warga.pengaduan.pengaduan-warga-pribadi', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengaduan $pengaduan)
    {
        //
        try {
            $pengaduan->delete();
            if ($pengaduan->bukti_pengaduan) {
                Storage::delete($pengaduan->bukti_pengaduan);
            }
            return redirect()->route('warga.pengaduan.pribadi')
            ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('warga.pengaduan.pribadi')
            ->with('error', 'Gagal menghapus data!');
        }
    }
}
