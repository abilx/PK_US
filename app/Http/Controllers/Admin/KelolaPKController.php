<?php

namespace App\Http\Controllers\Admin;

use App\Models\pk;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KelolaPKController extends Controller
{

    public function index()
    {
        // $kelola_rw = rw::all();
        $kelola_pk = PK::with('identitas_pk')
            ->join('users', 'petugas_kelurahan.user_id', '=', 'users.id')
            ->orderBy('users.role_id')
            ->get();
        // dd($kelola_rw);
        return view('Admin.Kelola_pk.tabel_pk', [
            'kelola_pk' => $kelola_pk,
            "title" => "Kelola Petugas Kelurahan"
        ]);
    }

    public function create()
    {
        $users = User::all();
        $hasUserWithRoleId2 = $users->contains('role_id', 2);

        $pk = Warga::all();
        return view('Admin.Kelola_pk.tambah_pk', [
            'title' => 'tambah Petugas Kelurahan',
            'pk' => $pk,
            'hasUserWithRoleId2' => $hasUserWithRoleId2
        ]);
    }

    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'id_warga' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'tgl_awal_jabatan_petugas_kelurahan' => 'required',
            'tgl_akhir_jabatan_petugas_kelurahan' => 'required',
            'jenis_petugas' => 'required',
        ]);
        $validatedData['password'] = Hash::make($request->password);
        $validatedData['status_pk'] = 0;

        $next_id = User::orderBy('id','desc')->first()->id + 1;
        $validatedData['user_id'] = $next_id;

        if($request->jenis_petugas==1){ $validatedData['role_id'] = '2'; }
        else{ $validatedData['role_id'] = '3'; }
        
        
        try {
            User::create($validatedData);
            PK::create($validatedData);
            
            return redirect()->route('pk.index')
                ->with('success', 'Data berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect()->route('pk.index')
                ->with('error', 'Gagal menambahkan data!');
        }
    }

    public function edit(PK $pk)
    {
        $kelola_pk = Warga::All()->find($pk->id_warga);
        $user =  User::All()->find($pk->user_id);

        return view('Admin.Kelola_pk.edit_pk', [
            'pk' => $pk,
            'kelola_pk' => $kelola_pk,
            'user' => $user,
            'title' => 'edit-pk'
        ]);
    }

    public function update(Request $request, PK $pk)
    {
        $user =  User::All()->find($pk->user_id);
        $validatedData = $request->validate([
            'id_warga' => 'required',
            'tgl_awal_jabatan_petugas_kelurahan' => 'required',
            'tgl_akhir_jabatan_petugas_kelurahan' => 'required',
        ]);

        if($request->password != null){
            $validatedData2['password'] = Hash::make($request->password);
        }
        else{
            $validatedData2['password'] = $user->password;
        }
        
        $validatedData2['username'] = $request->username;

        User::where('id', $pk->user_id)->update($validatedData2);

        PK::where('id_pk', $pk->id_pk)->update($validatedData);
        return redirect()->route('pk.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(PK $pk)
    {
        try {
        
            $pk->delete();
            User::All()->find($pk->user_id)->delete();

            return redirect()->route('pk.index')
                ->with('success', 'data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pk.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }

    public function show($id)
    {
        $kelola_pk = PK::where('id_pk', $id)->get();
        $identitas_pk = PK::with('identitas_pk')->where('id_pk', $id)->get();
        // dd($kelola_rw);
        return view('Admin.Kelola_pk.detail_pk', [
            'kelola_pk' => $kelola_pk,
            'identitas_pk' => $identitas_pk,
            'title' => 'detail-pk'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $pre_status = $request->status_pk;

        // var_dump($pre_status);
        // echo "<br>/";
        $status = $request->status_pk == 0 ? 1 : 0;
        $product = PK::find($request->id_pk);
        $product->status_pk = $pre_status;
        // var_dump($status);
        // echo "<br>/";
        // dd($product);
        $product->save();
        return response()->json(['success' => 'Status change successfully.', 'status' => $status, 'product' => $product]);
        // return redirect()->route('rt.kegiatan.index')
        //     ->with('error', 'Gagal menghapus data!');
    }

}
