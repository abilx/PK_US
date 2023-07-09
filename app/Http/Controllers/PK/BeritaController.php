<?php

namespace App\Http\Controllers\PK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriKegiatan;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::all();

        return view('PetugasKelurahan.berita.tabel_berita', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_kegiatan = KategoriKegiatan::all();
        return view('PetugasKelurahan.berita.tambah_berita', [
            'kategori_kegiatan' => $kategori_kegiatan,
            'title' => 'tambah-berita'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_berita' => 'required',
            
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-berita');
        }
        
        try {
            
            Berita::create($validatedData);

            return redirect()->route('pk.berita.index')
                ->with('success', 'Data berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect()->route('pk.berita.index')
                ->with('error', 'Gagal menambahkan data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::find($id);

        return view('PetugasKelurahan.berita.detail_berita', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);

        return view('PetugasKelurahan.berita.edit_berita', [
            'berita' => $berita,
            'kategori_kegiatan' => KategoriKegiatan::all(),
            'title' => 'edit-berita'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'created_at' => 'required',
        ]);

        if ($request->file('gambar')) {
            Storage::delete($request->oldImage);
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-berita');
        }

        Berita::where('id', $request->id)
            ->update($validatedData);
        return redirect()->route('pk.berita.index')->with('success', 'Data berhasil diubah!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($berita)
    {
        $berita = Berita::find($berita);
        // dd($berita);
        try {
            $berita->delete();
            if ($berita->gambar) {
                Storage::delete($berita->gambar);
            }
            return redirect()->route('pk.berita.index')
                ->with('success', 'data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pk.berita.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }
}
