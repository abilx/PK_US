<?php

namespace App\Http\Controllers\RW;

use Illuminate\Http\Request;
use App\Models\pengaduan;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PengaduanRWController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::join(
            'kategori_pengaduan',
            'kategori_pengaduan.id_kategori_pengaduan',
            '=',
            'pengaduans.kategori_pengaduan'
        )
            ->join('wargas', 'wargas.nik', '=', 'pengaduans.nik')
            ->get(['pengaduans.*', 'kategori_pengaduan.nama_kategori_pengaduan', 'wargas.nama_lengkap']);

        return view('RW.Pengaduan.tabel_pengaduan', [
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
        //
        // dd( pengaduan::find($pengaduan->id_pengaduan));
        // dd($pengaduan->created_at);
        // $current_date_time=Carbon::now();
        // echo $current_date_time;
        // $pengaduan['makan'] = $current_date_time;
        
        return $pengaduan;
     
    }
    public function tanggapin(Request $request)
    {
        
        //
        $data = Pengaduan::where('id_pengaduan', $request->id_validasi)
                ->update(['tanggapan_pengaduan' => $request->tanggapan_rw, 'status_pengaduan' => 2, 'ditampilkan' => 1]);
        
        if($data){
            return redirect()->route('rw.pengaduan.index')
            ->with('success', 'Pengaduan telah di validasi!');
        }

        return redirect()->route('rw.pengaduan.index')
        ->with('error', 'Terjadil kegagalan sistem, mohon maaf');
    }

    public function updateStatus(Request $request)
    {
        $pre_status = $request->ditampilkan;
        $status = $request->ditampilkan == 0 ? 1 : 0;

        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();
        $pengaduan->ditampilkan = $pre_status;
        $pengaduan->save();
        return response()->json(['success' => 'Status change successfully.', 'status' => $status, 'pengaduan' => $pengaduan]);
    }

    // public function show($id)
    // {
    //     $pengaduan = Pengaduan::with('pengaduans')->find($id);
    //     // dd($fasilitas->id_fasilitas_umum);
    //     return view('RW.pengaduan.detail_pengaduan', [
    //         'pengaduan' => $pengaduan,
    //         'title' => 'detail-pengaduan'
    //     ]);
    //     // Return response()->json([
    //     //     'success' => true,
    //     //     'message' => 'Detail Data Post',
    //     //     'data'    => $post
    //     // ]);
    // }

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
