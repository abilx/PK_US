<?php

namespace App\Http\Controllers\RW;

use PDF;
use App\Models\Surat;
// use Barryvdh\DomPDF\PDF;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;
use App\Models\WargaMiskin as Kemiskinan;

class WargaMiskinRWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kemiskinan = Kemiskinan::latest()->get();
        // $kemiskinan = Kemiskinan::all()->latest();
        // dd($kemiskinan);
        // $kemiskinan = Kemiskinan::all();
        // dd($kemiskinan);
        return view('RW.Warga.kemiskinan.tabel_kemiskinan', [
            'kemiskinan' => $kemiskinan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kategori_kegiatan = KategoriKegiatan::all();
        return view('RW.Warga.kemiskinan.tambah_kemiskinan');
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
        $request->validate([
            'warga' => 'required|unique:warga_miskin,warga',
            'nik' => 'required|exists:wargas,nik',
            'bukti' => 'required|mimes:pdf,jpeg,png,jpg',
            'nama_warga' => 'required',
        ], [
            'nik.exists'    => 'NIK tidak terdaftar',
            'warga.unique'    => 'Data ini sudah terdata warga miskin',
        ]);

        // $validator = Validator::make($request->all(), [
        //     'bukti' => 'required|mimes:pdf,jpeg,png,jpg',
        // ]);

        $dataentry = $request->only('warga', 'deskripsi', 'bukti');

        if ($request->file('bukti')) {
            $dataentry['bukti'] = $request->file('bukti')->store('gambar-bukti');
        }

        $dataWargaSame = Warga::find($request->warga);
        if (is_null($dataWargaSame)) {
            return redirect()->route('RW.warga.kemiskinan.create')
                ->with('error', 'Data ini tidak termasuk warga anda!');
        }
        try {
            //Memasukan data inputan kedalam tabel kematian pada database
            Kemiskinan::create($dataentry);
            return redirect()->route('rw.warga.wargamiskin')
                ->with('success', 'Berhasil menambahkan data!');
        } catch (\Exception $e) {
            //mengembalikan ke halaman RW.warga.kemiskinan.index dengan mengirimkan pesan

            return redirect()->route('rw.warga.wargamiskin')
                ->with('error', 'Gagal menambahkan data!' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WargaMiskin  $wargaMeninggal
     * @return \Illuminate\Http\Response
     */
    public function show($kemiskinan)
    {
        //
        $kemiskinan = Warga::find($kemiskinan)->first();
        //  dd($kemiskinan);
        //   return response()->json([ 'data' => $dataEntry]);
        // $kemiskinan = Warga::join('warga_miskin', 'warga_miskin.warga', '=', 'wargas.id_warga')
        //     ->get(['wargas.*',  'warga_miskin.*']);

        return view('RW.Warga.kemiskinan.detail_kemiskinan', [
            'kemiskinan' => $kemiskinan,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WargaMiskin  $wargaMeninggal
     * @return \Illuminate\Http\Response
     */
    public function edit(Kemiskinan $kemiskinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WargaMiskin  $wargaMeninggal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kemiskinan $kemiskinan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WargaMiskin  $wargaMeninggal
     * @return \Illuminate\Http\Response
     */
    public function destroy($kemiskinan)
    {
        $kemiskinan = Kemiskinan::find($kemiskinan);
        try {
            if ($kemiskinan->bukti) {
                Storage::delete($kemiskinan->bukti);
            }
            $kemiskinan->delete();
            return redirect()->back()
                ->with('success', 'data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data!');
        }
    }

    // public function show_jenazah(Warga $warga){
    public function show_warga(Request $request)
    {
        // $jenazah= Warga::where('nik', $warga->nik)->first();
        $jenazah = Warga::with('pekerjaans')->select('id_warga', 'nama_lengkap', 'jenis_kelamin', 'pekerjaan', 'agama', 'tempat_lahir', 'tgl_lahir', 'alamat')
            ->where('nik', $request->id)
            ->where('status_warga', 0)
            ->first();
        if ($jenazah) {
            return response()->json(['success' => 'Data ditemukan.', 'data' => $jenazah]);
        }
        return response()->json(['success' => 'Data tidak ditemukan.', 'data' => $jenazah]);
        // dd($jenazah);
    }

    public function requestSurat($kemiskinan)
    {
        //

        $dataKemiskinan = Kemiskinan::find($kemiskinan);
        //jika data tidak ditemukan
        if (!$dataKemiskinan) {
            return redirect()->route('RW.warga.kematian.index')
                ->with('error', 'Print Gagal! Data tidak temukan');
        }

        // // $data = $dataKemiskinan->get();
        // $dataKemiskinan['rt'] = auth()->user();
        // $dataKemiskinan['rw'] = auth()->user()->rw_rel;
        // $validatedData = $request->validate([
        //         'jenis_surat' => 'required',
        //         'nik' => 'required|exists:wargas,nik',
        //         'pengaju' => 'required|exists:wargas,id_warga',
        //     ]);
        // $input = $request->only('jenis_surat');
        // dd(auth()->user());
        $input['pengaju'] = $dataKemiskinan->warga;
        $input['rt'] = auth()->user()->id_rt;
        $input['rw'] = auth()->user()->rw_rel->id_rw;
        $input['status_tandatangan'] = '0';
        $input['status_surat'] = '4';
        $input['nomor_surat'] = CreateNomorSuratRT('SKM');
        $input['jenis_surat'] = 'Surat Keterangan Kemiskinan';
        $surat = Surat::create($input);
        $dataKemiskinan->no_surat = $surat->id_surat;
        $dataKemiskinan->cetak_surat = '1';
        $dataKemiskinan->save();
        return redirect()->route('RW.warga.kematian.index')
            ->with('success', 'Pengajuan surat berhasil!');
        // dd($dataKemiskinan['rt']);
        //    return view('RW.warga.kematian.surat_kematian_pdf', ['kematian' => $dataKemiskinan]);
        // $pdf = PDF::loadview('RW.warga.kematian.surat_kematian_pdf', ['kematian' => $dataKemiskinan]);
        // return $pdf->stream();
    }

}
