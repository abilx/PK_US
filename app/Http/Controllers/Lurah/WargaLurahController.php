<?php

namespace App\Http\Controllers\Lurah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\rw;
use App\Models\Pekerjaan;
use App\Models\WargaMiskin as Kemiskinan;

class WargaLurahController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $warga = rw::with('identitas_rw')->orderBy('no_rw', 'ASC')->get();

    return view('Lurah.Warga.warga', [
      'warga' => $warga,
      "title" => "Daftar RW"
    ]);
  }

  public function warga()
  {
    $warga = Warga::where('status_warga', 0)->get();

    return view('Lurah.Warga.tabel_warga', [
      'warga' => $warga,
      "title" => "tabel-warga"
    ]);
  }

  public function wargaRw($rw)
    {
        $id_rw = $rw;
        $warga = Warga::where('rw', $id_rw)->get();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
        'Lurah.Warga.tabel_warga',
        [
            'warga' => $warga,
        ]
        );
    }

  public function wargalansia()
  {
    $warga = Warga::ageGreaterThan60()->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'Lurah.Warga.warga-kelurahan-lansia',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargapendatanglurah()
  {
    $warga = Warga::where('status_warga', 0)->where('jenis_warga', 0)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'Lurah.warga.warga-kelurahan-pendatang',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargakepala()
  {
    $warga = Warga::where('status_hubungan_dalam_keluarga', 1)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'Lurah.Warga.warga-kelurahan-kepala',
      [
        'warga' => $warga,
      ]
    );
  }

    public function wargamiskinlurah()
    {
        $kemiskinan = Kemiskinan::all();
        // $warga = Warga::find(1);
        // dd($warga);
        return view(
            'Lurah.warga.tabel_kemiskinan_kelurahan',
            [
                'kemiskinan' => $kemiskinan,
            ]
        );
    }

  public function wargaLurah($rw)
  {
    $id_rw = $rw;
    $warga = Warga::where('rw', $id_rw)->get();
    // $warga = Warga::find(1);
    // dd($warga);
    return view(
      'Lurah.warga.tabel_warga',
      [
        'warga' => $warga,
      ]
    );
  }

  public function wargamrlurah($id)
  {
    $kemiskinan = Kemiskinan::where('id', $id)->first();
    // dd($kemiskinan);
    return view(
      'Lurah.warga.detail_kemiskinan_kelurahan',
      [
        'kemiskinan' => $kemiskinan,
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    
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
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function show_warga($id)
  {
      // //
      // // $warga = Warga::with(['identitas_rws', 'rt_rel', 'pekerjaan', 'agamas', 'pendidikans', 'golongan_darahs'])->where('id_warga', $id)->first();
      // $warga = Warga::All()->first();
      // //  dd($warga);

      // return view('PetugasKelurahan.Warga.detail_warga', [
      //     'warga' => $warga,
      // ]);
      $warga = Warga::find($id);
          return view('Lurah.Warga.detail_warga', [
              'warga' => $warga,
          ]);
  }

  public function show($id)
  {
    $warga = Warga::with(['identitas_rws', 'rt_rel', 'pekerjaan', 'agamas', 'pendidikans', 'kelurahans', 'kecamatans', 'kabupatens', 'provinsis', 'hubungans', 'golongan_darahs'])->where('id_warga', $id)->first();
    // dd($warga);

    return view('Lurah.Warga.detail_warga', [
      'warga' => $warga,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
