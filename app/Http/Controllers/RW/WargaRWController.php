<?php

namespace App\Http\Controllers\RW;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Usia;
use App\Models\rt;
use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\WargaMiskin as Kemiskinan;
use App\Helper\Helpers;
use App\Models\Pendidikan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Status_hubungan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class WargaRWController extends Controller
{
  public function index()
  {
    $id_rw = auth()->user()->user_rel->id_rw;
    $warga = rt::where('id_rw', $id_rw)->with('identitas_rt')->orderBy('no_rt', 'ASC')->get();

    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'RW.Warga.warga',
      [
        'warga' => $warga,
        "title" => "Daftar RT"
      ]
    );


  }

  public function warga()
  {
    $id_rw = auth()->user()->id_rw;
    $warga = Warga::where('jenis_warga', 1)->where('rw', $id_rw)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'RW.Warga.tabel_warga',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargaRw($rt)
  {
    $id_rt = $rt;
    $id_rw = auth()->user()->user_rel->id_rw;
    $warga = Warga::where('rt', $id_rt)->where('rw', $id_rw)->get();

    $usia = usia::selectRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) AS usia')
              ->where('rt', $id_rt)
              ->where('rw', $id_rw)
              ->get();

    return view(
      'RW.Warga.tabel_warga',
      [
        'warga' => $warga,
        'usia' => $usia,
      ]
    );
  }

  public function wargaRw2($rt)
  {
    $id_rt = $rt;
    $id_rw = auth()->user()->user_rel->id_rw;
    $warga = Warga::where('rt', $id_rt)->where('rw', $id_rw)->get();

    // $usia = Warga::where('rt', $id_rt)
    //            ->where('rw', $id_rw)
    //            ->select('tgl_lahir')
    //            ->get();
    // $tglSekarang = date('Y-m-d');
    // $umur = date_diff(date_create($usia), date_create($tglSekarang))->y;
    // $warga = Warga::find(1);
    // dd($id_rw);
    // dd($usia);
    $usia = Usia::selectRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) AS usia')
              ->where('rt', $id_rt)
              ->where('rw', $id_rw)
              ->get();


    dd($usia);
    }


  public function wargatetap()
  {

    $id_rw = auth()->user()->id_rw;
    $warga = Warga::where('jenis_warga', 1)->where('rw', $id_rw)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'RW.Warga.warga-rw-tetap',
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
      'RW.Warga.warga-rw-lansia',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargakepala()
  {

    // $id_rw = auth()->user()->id_rw;
    $warga = Warga::where('status_hubungan_dalam_keluarga', 1)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'RW.Warga.warga-rw-kepala',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargalansia()
    {


        // $id_pk = auth()->user()->id_pk;

        $warga = Warga::ageGreaterThan60()->get();


        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'RW.Warga.warga-rw-lansia',
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
      'RW.Warga.warga-tambah-rw',
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
      'foto_warga' => 'image|file|max:4095', //
      'email_warga' => 'required',
      'no_hp_warga' => 'required',
      'jenis_warga' => 'required',
      'rt' => 'required|nullable',
      'rw' => 'required|nullable'
    ]);

    $validatedData['username'] =  $request->nik;
    $validatedData['password'] =  Hash::make(12345678);

    if ($request->file('foto_warga')) {
      $validatedData['foto_warga'] = $request->file('foto_warga')->store('foto-warga');
    }
    //dd(Warga::create($validatedData));
    try {
      Warga::create($validatedData);
      return redirect()->route('rw.warga.index')
        ->with('success', 'Data berhasil ditambah!');
    } catch (\Exception $e) {
      return redirect()->route('rw.warga.index')
        ->with('error', 'Gagal menambahkan data!');
    }

    // return Warga::create($validatedData);
  }

  public function edit(Warga $warga)
  {
    // dd($warga->all());
    $data = Pekerjaan::all();
    $hubungan = Status_hubungan::all();
    $pendidikan = Pendidikan::all();
    $datakab = Kabupaten::all();
    $datakec = Kecamatan::all();
    $datakel = Kelurahan::all();
    $datapro = Provinsi::all();
    return view(
      'RW.Warga.warga-edit-rw',
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
    return redirect()->route('rw.warga.index')->with('success', 'Data berhasil diubah!');
  }

  public function show_warga($id)
  {
    //
    // $warga = Warga::with(['identitas_rws', 'rt_rel', 'pekerjaan', 'agamas', 'pendidikans', 'golongan_darahs'])->where('id_warga', $id)->first();
    // // dd($warga->email_warga);

    // return view('RW.Warga.detail_warga', [
    //   'warga' => $warga,
    // ]);
    $warga = Warga::find($id);
    return view('RW.Warga.detail_warga', [
        'warga' => $warga,
    ]);
  }

  public function show($id)
  {
    //
    // $warga = Warga::with(['identitas_rws', 'rt_rel', 'pekerjaan', 'agamas', 'pendidikans', 'golongan_darahs'])->where('id_warga', $id)->first();
    // // dd($warga->email_warga);

    // return view('RW.Warga.detail_warga', [
    //   'warga' => $warga,
    // ]);
    $warga = Warga::find($id);
    return view('RW.Warga.detail_warga', [
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
      $warga->delete();
      if ($warga->foto_warga) {
        Storage::delete($warga->foto_warga);
      }
      return redirect()->route('rw.warga.index')
        ->with('success', 'data berhasil dihapus!');
    } catch (\Exception $e) {
      return redirect()->route('rw.warga.index')
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
}
