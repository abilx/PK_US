<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Status_hubungan;
use Illuminate\Support\Facades\Storage;
use App\Models\Warga;
use App\Models\pengaduan;
use App\Models\Berita;
use App\Models\WargaMiskin;
use App\Models\Fasilitas_umum;
use App\Models\Kegiatan;
use App\Models\Pengumuman;

class WargaAdminController extends Controller
{
    public function index()
    {
        //$id_rw = auth()->user()->id;
        $warga = Warga::All();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Admin.Warga.tabel_warga',
            [
                'warga' => $warga,
            ]
        );
    }

    public function warga()
    {
        // $id_rw = auth()->user()->id_rw;
        $warga = Warga::where('jenis_warga', 1)->get();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Admin.Warga.tabel_warga',
            [
                'warga' => $warga,
            ]
        );
    }

    public function wargatetap()
    {

        $id_rw = auth()->user()->id_rw;
        $warga = Warga::where('jenis_warga', 1)->where('rw', $id_rw)->get();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Admin.Warga.warga-rw-tetap',
            [
                'warga' => $warga,
            ]
        );
    }

    public function wargapendatang()
    {

        $id_rw = auth()->user()->id_rw;
        $warga = Warga::where('jenis_warga', 0)->where('rw', $id_rw)->get();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Admin.Warga.warga-rw-pendatang',
            [
                'warga' => $warga,
            ]
        );
    }

    public function wargak()
    {

        $id_rw = auth()->user()->id_rw;
        $warga = Warga::where('status_hubungan_dalam_keluarga', 1)->where('rw', $id_rw)->get();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Admin.Warga.warga-rw-kepala',
            [
                'warga' => $warga,
            ]
        );
    }


    // function menampilkan halaman tambah warga
    public function create()
    {
        $warga = Warga::all();
        $data = Pekerjaan::all();
        $hubungan = Status_hubungan::all();
        $pendidikan = Pendidikan::all();
        $datakab = Kabupaten::all();
        $datakec = Kecamatan::all();
        $datakel = Kelurahan::all();
        $datapro = Provinsi::all();
        return view(
            'Admin.Warga.warga-tambah-rw',
            [
                'warga' => $warga,
                'pekerjaan' => $data,
                'hubungan' => $hubungan,
                'pendidikan' => $pendidikan,
                'kabupaten' => $datakab,
                'kecamatan' => $datakec,
                'kelurahan' => $datakel,
                'provinsi' => $datapro,
            ]
        );
    }

    //function tambah ke dalam database
    public function store(Request $request)
    {
        $validatedData = $request->except('_token');
        // $validatedData['tgl_lahir'] = strtotime($request->tgl_lahir);
        // $validatedData['tgl_keluar_kk'] = strtotime($request->tgl_keluar_kk);

        $validatedData = $request->validate([
            'no_kk' => 'required|numeric',
            'nik' => 'required|numeric|unique:wargas,nik',
            // 'username' => 'required|unique:wargas,username',
            // 'password' => 'required|min:6',
            'nama_kepala_keluarga' => 'required',
            'nokk_kepala_keluarga' => 'required|numeric',
            'status_hubungan_dalam_keluarga' => 'required|numeric',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama_dusun' => 'required',
            'kode_pos' => 'nullable|numeric',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'akta_kelahiran' => 'nullable|numeric', //
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'golongan_darah' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required', //
            'tgl_perkawinan' => 'nullable|date', //
            'akta_kawin' => 'nullable|numeric', //
            'akta_cerai' => 'nullable|numeric', //
            'tgl_cerai' => 'nullable|date', //
            'nomor_passport' => 'nullable|numeric|unique:wargas,nomor_passport', //
            'tgl_akhir_passport' => 'nullable|date', //
            'nomor_kitaskitap' => 'nullable|numeric|unique:wargas,nomor_kitaskitap', //
            'nik_ayah' => 'required', //
            'nama_ayah' => 'required', //
            'nik_ibu' => 'required', //
            'nama_ibu' => 'required', //
            'tgl_keluar_kk' => 'date', //
            'kelainan' => 'nullable', //
            'foto_warga' => 'nullable|image|file|max:4095', //
            'email_warga' => 'required',
            'no_hp_warga' => 'required',
            'jenis_warga' => 'required',
            'rt' => 'required|nullable',
            'rw' => 'required|nullable'
        ]);

        // $validatedData['username'] =  $request->nik;
        // $validatedData['password'] =  Hash::make(12345678);
        $validatedData['role_id']  = '6';

        // $next_id = User::orderBy('id','desc')->first()->id + 1;
        // $validatedData['user_id'] = $next_id;

        // User::create($validatedData);

        if ($request->file('foto_warga')) {
            $validatedData['foto_warga'] = $request->file('foto_warga')->store('foto-warga');
        }
        //  dd(Warga::create($validatedData));
        try {
            Warga::create($validatedData);
            return redirect()->route('warga.index')
                ->with('success', 'Data berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Gagal menambahkan data!');
        }

        // return Warga::create($validatedData);
    }

    public function edit(Warga $warga)
    {

        // $url = Storage::url('file.jpg');
        // dd($url);
        $data = Pekerjaan::all();
        $hubungan = Status_hubungan::all();
        $pendidikan = Pendidikan::all();
        $datakab = Kabupaten::all();
        $datakec = Kecamatan::all();
        $datakel = Kelurahan::all();
        $datapro = Provinsi::all();
        return view(
            'Admin.Warga.warga-edit-rw',
            [
                'warga' => $warga,
                'pekerjaan' => $data,
                'hubungan' => $hubungan,
                'pendidikan' => $pendidikan,
                'kabupaten' => $datakab,
                'kecamatan' => $datakec,
                'kelurahan' => $datakel,
                'provinsi' => $datapro,
            ]
        );
    }

    public function update(Request $request, Warga $warga)
    {
        $validatedData = $request->except(['_token', '_method']);
        $validatedData = $request->validate([
            'no_kk' => 'required|numeric',
            'nik' => 'required|numeric',
            // 'username' => 'required|unique:wargas,username',
            // 'password' => 'required|min:6',
            'nama_kepala_keluarga' => 'required',
            'nokk_kepala_keluarga' => 'required|numeric',
            'status_hubungan_dalam_keluarga' => 'required|numeric',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama_dusun' => 'required',
            'kode_pos' => 'nullable|numeric',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'akta_kelahiran' => 'nullable|numeric', //
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'golongan_darah' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required', //
            'tgl_perkawinan' => 'nullable|date', //
            'akta_kawin' => 'nullable|numeric', //
            'akta_cerai' => 'nullable|numeric', //
            'tgl_cerai' => 'nullable|date', //
            'nomor_passport' => 'nullable|numeric', //
            'tgl_akhir_passport' => 'nullable|date', //
            'nomor_kitaskitap' => 'nullable|numeric', //
            'nik_ayah' => 'required', //
            'nama_ayah' => 'required', //
            'nik_ibu' => 'required', //
            'nama_ibu' => 'required', //
            'tgl_keluar_kk' => 'date', //
            'kelainan' => 'nullable', //
            'email_warga' => 'required',
            'no_hp_warga' => 'required',
            'jenis_warga' => 'required',
            'rt' => 'required|nullable',
            'rw' => 'required|nullable'
        ]);

        if ($request->file('foto_warga')) {
            Storage::delete($request->oldImage);
            $validatedData['foto_warga'] = $request->file('foto_warga')->store('foto-warga');
        }

        warga::where('id_warga', $warga->id_warga)
            ->update($validatedData);
        return redirect()->route('warga.index')->with('success', 'Data berhasil diubah!');
    }

    public function show($id)
    {
        //
        $warga = Warga::with(['identitas_rws', 'rt_rel', 'pekerjaan', 'agamas', 'pendidikans', 'golongan_darahs'])->where('id_warga', $id)->first();

        // dd($warga->email_warga);

        return view('Admin.Warga.detail_warga', [
            'warga' => $warga,
        ]);
    }

    public function destroy(Warga $warga)
    {
        // $warga->delete();
        // if ($warga->foto_warga) {
        //     Storage::delete($warga->foto_pengumuman);
        // }
        // return redirect()->route('pengumuman.index');
        try {
            $user = User::find($warga->user_id);
            if($user )
            {
                $user->delete();
            }
            $warga->active = 0;
            $warga->save();
            $warga->delete();
            if ($warga->foto_warga) {
                Storage::delete($warga->foto_warga);
            }
            return redirect()->route('warga.index')
                ->with('success', 'data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }

    // public function show($id)
    // {
    //     $warga = Warga::with(['pekerjaan', 'agamas'])->where('id_warga', $id)->first();
    //     // dd($warga->agamas);

    //     return view('rt.warga.warga-detail-rt', [
    //         'warga' => $warga,
    //     ]);
    // }

    public function hapusFotoTidakTerpakai()
    {
        // Ambil semua nama file foto dari penyimpanan
        $storageFotoWarga = Storage::files('/foto-warga');
        $storageBuktiPengaduan = Storage::files('/bukti-pengduan');
        $storageGambarBerita = Storage::files('/gambar-berita');
        $storageGambarBukti = Storage::files('/gambar-bukti');
        $storageGambarFasilitas = Storage::files('/gambar-fasilitas');
        $storageGambarKegiatan = Storage::files('/gambar-kegiatan');
        $storageGambarPengumuman = Storage::files('/gambar-pengumuman');
    
        // Ambil semua foto yang ada dalam tabel "wargas"
        $wargaFotos = Warga::pluck('foto_warga')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "pengaduan"
        $pengaduanFotos = pengaduan::pluck('bukti_pengaduan')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "berita"
        $beritaGambars = Berita::pluck('gambar')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "warga_miskin"
        $wargaMiskinBuktis = WargaMiskin::pluck('bukti')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "fasilitas_umum"
        $fasilitasUmumFotos = Fasilitas_umum::pluck('foto_fasilitas')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "kegiatan"
        $kegiatanFotos = Kegiatan::pluck('foto_kegiatan')->toArray();
    
        // Ambil semua foto yang ada dalam tabel "pengumuman"
        $pengumumanFotos = Pengumuman::pluck('foto_pengumuman')->toArray();
    
        // Identifikasi file-foto yang tidak terkait dengan entri dalam tabel
        $unlinkedFotoWarga = array_diff($storageFotoWarga, $wargaFotos);
        $unlinkedBuktiPengaduan = array_diff($storageBuktiPengaduan, $pengaduanFotos);
        $unlinkedGambarBerita = array_diff($storageGambarBerita, $beritaGambars);
        $unlinkedGambarBukti = array_diff($storageGambarBukti, $wargaMiskinBuktis);
        $unlinkedGambarFasilitas = array_diff($storageGambarFasilitas, $fasilitasUmumFotos);
        $unlinkedGambarKegiatan = array_diff($storageGambarKegiatan, $kegiatanFotos);
        $unlinkedGambarPengumuman = array_diff($storageGambarPengumuman, $pengumumanFotos);
    
        // Hapus file-foto yang tidak terkait dengan entri dalam tabel
        $deletedFiles = [];

        foreach ($unlinkedFotoWarga as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedBuktiPengaduan as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedGambarBerita as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedGambarBukti as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedGambarFasilitas as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedGambarKegiatan as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        foreach ($unlinkedGambarPengumuman as $file) {
            Storage::delete($file);
            $deletedFiles[] = $file;
        }

        if (count($deletedFiles) > 0) {
            return "Foto yang tidak terkait dengan entri dalam tabel telah dihapus. Berikut adalah daftar file yang dihapus: <br>" . implode("<br> ", $deletedFiles);
        } else {
            return "Tidak ada foto yang dihapus karena tidak ada file yang tidak terkait dengan entri dalam tabel.";
        }
    }
}

