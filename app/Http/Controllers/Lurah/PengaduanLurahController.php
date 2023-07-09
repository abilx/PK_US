<?php

namespace App\Http\Controllers\Lurah;

use Illuminate\Http\Request;
use App\Models\pengaduan;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PengaduanLurahController extends Controller
{
    public function index()
    {
        // $pengaduan = Pengaduan::with('kategori_pengaduans')->get();
        // dd($pengaduan);
        $pengaduan = Pengaduan::join(
            'kategori_pengaduan',
            'kategori_pengaduan.id_kategori_pengaduan',
            '=',
            'pengaduans.kategori_pengaduan'
        )
            ->join('wargas', 'wargas.nik', '=', 'pengaduans.nik')
            ->get(['pengaduans.*', 'kategori_pengaduan.nama_kategori_pengaduan', 'wargas.nama_lengkap']);

        return view('Lurah.Pengaduan.tabel_pengaduan', [
            'pengaduan' => $pengaduan,
            "title" => "tabel-pengaduan"
        ]);
    }

    // public function store(Request $request)
    // {
    //     //define validation rules
    //     $pengaduan = Pengaduan::make($request->all(), [
    //         'title'     => 'required',
    //         'content'   => 'required',
    //     ]);

    //     //check if validation fails
    //     if ($pengaduan->fails()) {
    //         return response()->json($pengaduan->errors(), 422);
    //     }

    //     //create post
    //     $post = Post::create([
    //         'title'     => $request->title,
    //         'content'   => $request->content
    //     ]);

    //     //return response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Berhasil Disimpan!',
    //         'data'    => $post
    //     ]);
    // }

    public function show(Pengaduan $pengaduan)
    {
        // $pengaduan = Pengaduan::with('pengaduans')->find($id);
        // dd($fasilitas->id_fasilitas_umum);
        // return view('Lurah.pengaduan.detail_pengaduan', [
        //     'pengaduan' => $pengaduan,
        //     'title' => 'detail-pengaduan'
        // ]);

        // Return response()->json([
        //     'success' => true,
        //     'message' => 'Detail Data Post',
        //     'data'    => $post
        // ]);
        return $pengaduan;
    }

    // public function update(Request $request, Post $post)
    // {
    //     //define validation rules
    //     $pengaduan = Pengaduan::make($request->all(), [
    //         'judul'     => 'required',
    //         'content'   => 'required',
    //     ]);

    //     //check if validation fails
    //     if ($pengaduan->fails()) {
    //         return response()->json($pengaduan->errors(), 422);
    //     }

    //     //create post
    //     $post->update([
    //         'title'     => $request->title,
    //         'content'   => $request->content
    //     ]);

    //     //return response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Berhasil Diudapte!',
    //         'data'    => $post
    //     ]);
    // }
}
