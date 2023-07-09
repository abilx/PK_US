<?php

namespace App\Http\Controllers\PK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;
use App\Models\KategoriKegiatan;

class KegiatanPKController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();

        return view('PetugasKelurahan.Kegiatan.tabel_kegiatan', [
            'kegiatan' => $kegiatan,
            "title" => "tabel-kegiatan"
        ]);
    }

    public function create()
    {
        $kategori_kegiatan = KategoriKegiatan::all();
        return view('PetugasKelurahan.Kegiatan.tambah_kegiatan', [
            'kategori_kegiatan' => $kategori_kegiatan,
            'title' => 'tambah-kegiatan'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
            'foto_kegiatan' => 'image|file|max:4095',
            'tgl_mulai_kegiatan' => 'required',
            'tgl_selesai_kegiatan' => 'required'
        ]);

        if ($request->file('foto_kegiatan')) {
            $validatedData['foto_kegiatan'] = $request->file('foto_kegiatan')->store('gambar-kegiatan');
        }

        $validatedData['status_kegiatan'] = 1;
        $validatedData['id_penanggung_jawab'] = auth()->user()->id;
        $validatedData['penanggung_jawab'] = "Petugas Kelurahan - " . auth()->user()->_warga->nama_lengkap;
        
        try {
            
            Kegiatan::create($validatedData);

            return redirect()->route('pk.kegiatan.index')
                ->with('success', 'Data berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect()->route('pk.kegiatan.index')
                ->with('error', 'Gagal menambahkan data!');
        }
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('PetugasKelurahan.Kegiatan.edit_kegiatan', [
            'kegiatan' => $kegiatan,
            'kategori_kegiatan' => KategoriKegiatan::all(),
            'title' => 'edit-kegiatan'
        ]);
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
            'foto_kegiatan' => 'image|file|max:4095',
            'tgl_mulai_kegiatan' => 'required',
            'tgl_selesai_kegiatan' => 'required'
        ]);

        if ($request->file('foto_kegiatan')) {
            Storage::delete($request->oldImage);
            $validatedData['foto_kegiatan'] = $request->file('foto_kegiatan')->store('gambar-kegiatan');
        }

        Kegiatan::where('id_kegiatan', $kegiatan->id_kegiatan)
            ->update($validatedData);
        return redirect()->route('pk.kegiatan.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(kegiatan $kegiatan)
    {
        // $kegiatan->delete();
        // if ($kegiatan->foto_kegiatan) {
        //     Storage::delete($kegiatan->foto_kegiatan);
        // }
        // return redirect()->route('rw.kegiatan.index');

        try {
            $kegiatan->delete();
            if ($kegiatan->foto_kegiatan) {
                Storage::delete($kegiatan->foto_kegiatan);
            }
            return redirect()->route('pk.kegiatan.index')
                ->with('success', 'data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pk.kegiatan.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }
    public function show($id)
    {
        try {
            $kegiatan = Kegiatan::find($id);
            return view('PetugasKelurahan.Kegiatan.detail_kegiatan', [
                'kegiatan' => $kegiatan,
                'title' => 'detail-kegiatan'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('pk.kegiatan.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }

    public function updateStatus(Request $request)
    {
        $pre_status = $request->status_kegiatan;

        // var_dump($pre_status);
        // echo "<br>/";
        $status = $request->status_kegiatan == 0 ? 1 : 0;
        $product = Kegiatan::find($request->id_kegiatan);
        $product->status_kegiatan = $pre_status;
        // var_dump($status);
        // echo "<br>/";
        // dd($product);
        $product->save();
        return response()->json(['success' => 'Status change successfully.', 'status' => $status, 'product' => $product]);
        // return redirect()->route('rt.kegiatan.index')
        //     ->with('error', 'Gagal menghapus data!');
    }
}
