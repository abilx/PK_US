<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChartController;

use App\Http\Controllers\RW\RwController;
use App\Http\Controllers\RW\IuranController;
use App\Http\Controllers\RW\LoginRWController;
use App\Http\Controllers\RW\WargaRWController;
use App\Http\Controllers\RW\KegiatanController;
use App\Http\Controllers\RW\ProfileRWController;
use App\Http\Controllers\RW\PengumumanController;
use App\Http\Controllers\RW\PengaduanRWController;
use App\Http\Controllers\RW\PembayaranRWController;
use App\Http\Controllers\RW\SuratRWController;
use App\Http\Controllers\RW\FasilitasUmumRWController;
use App\Http\Controllers\RW\WargaMiskinRWController;

use App\Http\Controllers\Admin\KelolaRTController;
use App\Http\Controllers\Admin\KelolaRWController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WargaAdminController;
use App\Http\Controllers\Admin\KategoriKegiatanController;
use App\Http\Controllers\Admin\KategoriPengaduanController;
use App\Http\Controllers\Admin\KategoriPengumumanController;
use App\Http\Controllers\Admin\KategoriFasilitasUmumController;
use App\Http\Controllers\Admin\KelolaPKController;
use App\Http\Controllers\Admin\ProfileAdminController;

use App\Http\Controllers\WargaController;
use App\Http\Controllers\Warga\OtherController;
use App\Http\Controllers\Warga\IuranWargaController;
use App\Http\Controllers\Warga\LoginWargaController;
use App\Http\Controllers\Warga\DashboardWargaController;
use App\Http\Controllers\Warga\PengaduanController as WargaPengaduanController;
use App\Http\Controllers\Warga\KegiatanWargaController;
use App\Http\Controllers\Warga\PengumumanWargaController;
use App\Http\Controllers\Warga\FasilitasWargaController;
use App\Http\Controllers\Warga\ProfileWargaController;
use App\Http\Controllers\Warga\SuratWargaController;
use App\Http\Controllers\Warga\LPController;

use App\Http\Controllers\Lurah\LurahController;
use App\Http\Controllers\Lurah\WargaLurahController;
use App\Http\Controllers\Lurah\FasilitasUmumLurahController;
use App\Http\Controllers\Lurah\KegiatanLurahController;
use App\Http\Controllers\Lurah\PembayaranLurahController;
use App\Http\Controllers\Lurah\PengaduanLurahController;
use App\Http\Controllers\Lurah\PengumumanLurahController;
use App\Http\Controllers\Lurah\ProfileLurahController;
use App\Http\Controllers\Lurah\SuratLurahController;
use App\Http\Controllers\Lurah\WargaMiskinLurahController;
use App\Http\Controllers\Lurah\KelolaRWLurahController;

use App\Http\Controllers\PK\PetugasController;
use App\Http\Controllers\PK\FasilitasUmumPKController;
use App\Http\Controllers\PK\PembayaranPKController;
use App\Http\Controllers\PK\SuratPKController;
use App\Http\Controllers\PK\KegiatanPKController;
use App\Http\Controllers\PK\PengaduanPKController;
use App\Http\Controllers\PK\PengumumanPKController;
use App\Http\Controllers\PK\ProfilePKController;
use App\Http\Controllers\PK\WargaPKController;
use App\Http\Controllers\PK\WargaMiskinPKController;
use App\Http\Controllers\PK\KelolaRTPKController;
use App\Http\Controllers\PK\KelolaRWPKController;
use App\Http\Controllers\PK\BeritaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::view('/coba', 'coba');


// Route::get('/coba', function () {
//     $barang = array('smart-tv', 'iphone', 'mobile-phone', 'laptop', 'canon-camera');
//     return view('coba', [
//         "barang" => $barang
//     ]);
// });
// Route::get('/kelola-rtrw', function () {
//     return view('Admin.kelola_rtrw.kelola_rtrw', [
//         "title" => "Kelola RT/RW"
//     ]);
// });

// Route::get('/login-admin', function () {
//     return view('login_admin', [
//         "title" => "Login Admin"
//     ]);
// });

// Route::get('/c_login_rw', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/c_login_rw', [LoginController::class, 'authenticate']);

//route CRUD iuran
// Route::get('/view-iuran', [IuranController::class, 'index']);
// Route::get('/create-iuran', [IuranController::class, 'create']);
// Route::post('/store-iuran', [IuranController::class, 'store']);
// Route::get('/edit-iuran/{id}', [IuranController::class, 'edit']);
// Route::post('/update-iuran', [IuranController::class, 'update']);
// Route::get('/hapus-iuran/{id}', [IuranController::class, 'hapus']);
// Route::get('/detail-iuran/{id}', [IuranController::class, 'detail']);

//contoh penggunana prefix grup dan name
// Route::prefix('user')->name('user.')->middleware(['user', 'auth'])->group(function () {
//     Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
//     Route::get('profile', [UserController::class, 'profile'])->name('profile');
//     Route::get('setting', [UserController::class, 'setting'])->name('setting');
// });
// Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
//     Route::view('/', 'Warga.login-warga')->name('warga.login');
//     Route::post('/', [LoginWargaController::class, 'authenticate'])->name('login.warga');
// });

// Route::get('/', function () {
//     return view('Warga.login-warga');
// })->name('warga.login')->middleware(['guest:web', 'PreventBackHistory']);

// Route::get('/ProfilKelurahanUmbanSari', function () {
//     return view('index');
// });

Route::get('/', function () {
    return view('login');
});



Route::prefix('/')->name('warga.')->group(function () {
    Route::get('/', [LPController::class, 'home'])->name('dashboard.home');
    Route::post('pengaduan/store', [LPController::class, 'store_pengaduan'])->name('pengaduan.store_pengaduan');
    Route::get('kegiatan', [LPController::class, 'kegiatan'])->name('kegiatan');
    Route::get('kegiatan/{id}', [LPController::class, 'kegiatan_show'])->name('kegiatan.show');
    Route::get('pengumuman', [LPController::class, 'pengumuman'])->name('pengumuman');
    Route::get('pengumuman/{id}', [LPController::class, 'pengumuman_show'])->name('pengumuman.show');
    Route::get('berita', [LPController::class, 'berita'])->name('berita');
    Route::get('berita/{id}', [LPController::class, 'berita_show'])->name('berita.show');
    Route::get('fasilitas', [LPController::class, 'fasilitas'])->name('fasilitas');
    Route::get('fasilitas/{id}', [LPController::class, 'fasilitas_show'])->name('fasilitas.show');
    route::get('cek_warga', [LPController::class, 'cek_warga'])->name('cek_warga');
    Route::get('MapKelurahan', function () { return view('map'); })->name('MapKelurahan');
    Route::get('AboutKelurahan', function () { return view('about'); })->name('AboutKelurahan');
    Route::get('Visi-misiKelurahan', function () { return view('visimisi'); })->name('Visi-misiKelurahan');
    Route::get('PerangkatKelurahan', function () { return view('perangkat'); })->name('PerangkatKelurahan');
    Route::get('KontakKelurahan', function () { return view('contact'); })->name('KontakKelurahan');
    Route::get('LandingKelurahan', function () { return view('landingpage'); })->name('LandingKelurahan');
});


// Route::get('/ProfilKelurahanUmbanSari', function () {
//     return view('index');
// });

Route::group(['middleware' => 'auth'], function() { // Route authenticated users

    Route::group(['middleware' => 'role:admin'], function () { // Group route administrator

        Route::get('/Admin', [AdminController::class, 'home_admin'])->name('admin.dashboard.home');
        route::resource('rw', KelolaRWController::class);
        route::resource('rt', KelolaRTController::class);
        route::resource('pk', KelolaPKController::class);
        route::resource('warga', WargaAdminController::class);

        Route::get('/hapus-foto-tidak-terpakai', [WargaAdminController::class, 'hapusFotoTidakTerpakai']);

        route::resource('kategori_pengumuman', KategoriPengumumanController::class);
        route::resource('kategori_kegiatan', KategoriKegiatanController::class);
        route::resource('kategori_pengaduan', KategoriPengaduanController::class);
        route::resource('kategori_fasilitas', KategoriFasilitasUmumController::class);

        route::resource('profile', ProfileAdminController::class);

        Route::get('/warga/getKab/{id}', function ($id) {
            $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
            return response()->json($kab);
        });
        Route::get('/warga/{idw}/getKab/{id}', function ($idw, $id) {
            $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
            return response()->json($kab);
        });
        Route::get('/warga/getKec/{id}', function ($id) {
            $kec = App\Models\Kecamatan::where('id_kab', $id)->get();
            return response()->json($kec);
        });
        Route::get('/warga/getKel/{id}', function ($id) {
            $kel = App\Models\Kelurahan::where('id_kec', $id)->get();
            return response()->json($kel);
        });

    });

    Route::group(['middleware' => 'role:RW'], function () { // Group route RW
        Route::prefix('RW')->name('rw.')->group(function () {
            Route::get('dashboard', [RWController::class, 'home_rw'])->name('dashboard.home');
            route::resource('pengumuman', PengumumanController::class);
            route::resource('fasilitasrw', FasilitasUmumRWController::class);
            route::resource('iuran', IuranController::class);
            Route::get('/kegiatan/status/update', [KegiatanController::class, 'updateStatus'])->name('kegiatan.update.status');
            route::resource('kegiatan', KegiatanController::class);

            route::resource('warga', WargaRWController::class)->except(['show']);
            Route::get('/warga/detail/{id}', [WargaRWController::class, 'show_warga'])->name('warga.show_warga');
            Route::get('/list-rt/{rw}', [WargaRWController::class, 'wargaRw'])->name('list-rt');
            Route::get('/warga/wargakepala', [WargaRWController::class, 'wargakepala'])->name('warga.wargakepala');
            route::resource('/warga/wargamiskin', WargaMiskinRWController::class)->only([
                'index', 'create', 'store', 'destroy', 'show', 'show_warga', 'requestSurat', 'print'
            ]);
            Route::get('/warga/wargamiskin', [WargaMiskinRWController::class, 'index'])->name('warga.wargamiskin');
             route::get('kemiskinan/show_warga', [WargaMiskinRWController::class, 'show_warga'])->name('kemiskinan.show_pelapor');
            // Route::get('/warga/wargamiskin', [WargaPKController::class, 'wargamiskin'])->name('warga.wargamiskin');
            Route::get('/warga/wargalansia', [WargaRWController::class, 'wargalansia'])->name('warga.wargalansia');

            // route::resource('warga', WargaRWController::class);
            // Route::get('/list-warga/{rw}', [WargaRWController::class, 'wargaRw'])->name('warga.wargaRw');
            // Route::get('/wargat/tetap', [WargaRWController::class, 'wargatetap'])->name('wargaw.tetapw');
            // Route::get('/wargatt/pendatang', [WargaRWController::class, 'wargapendatang'])->name('wargatw.pendatanw');
            // Route::get('/warga/wargakepala', [WargaRWController::class, 'wargakepala'])->name('warga.wargakepala');

            // Route::get('/warga/wargamiskin', [WargaRWController::class, 'wargamiskin'])->name('warga.wargamiskin');
            // Route::get('/warga/wargapendatang', [WargaRWController::class, 'wargapendatang'])->name('warga.wargapendatang');

            Route::get('/warga/getKab/{id}', function ($id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/{idw}/getKab/{id}', function ($idw, $id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/getKec/{id}', function ($id) {
                $kec = App\Models\Kecamatan::where('id_kab', $id)->get();
                return response()->json($kec);
            });
            Route::get('/warga/getKel/{id}', function ($id) {
                $kel = App\Models\Kelurahan::where('id_kec', $id)->get();
                return response()->json($kel);
            });

            Route::get('/wargarw/wargam', [WargaRWController::class, 'wargamrw'])->name('wargamrw.wargamrw');
            Route::get('/wargarw/wargamd/{id}', [WargaRWController::class, 'wargamrwd'])->name('wargamrwd.wargamrwd');
            Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
                Route::get('/', [PengaduanRWController::class, 'index'])->name('index');
                Route::get('/show/{pengaduan}', [PengaduanRWController::class, 'show'])->name('show');
                Route::post('/tanggapin', [PengaduanRWController::class, 'tanggapin'])->name('tanggapin');
                Route::get('/ditampilkan', [PengaduanRWController::class, 'updateStatus'])->name('ditampilkan');
            });
            route::resource('rw/profile', ProfileRWController::class);
            Route::prefix('surat')->name('surat.')->group(function () {
                Route::get('/', [SuratRWController::class, 'index'])->name('index');
                Route::get('/nomorsurat', [SuratRWController::class, 'nomorsurat'])->name('nomorsurat');
                Route::get('/surat_keterangan', [SuratRWController::class, 'surat_keterangan'])->name('form.surat_keterangan');
                Route::get('/surat_keterangan/{surat}', [SuratRWController::class, 'detailSuratKeterangan'])->name('detail.surat_keterangan');
                Route::put('/surat_keterangan/{surat}/proses', [SuratRWController::class, 'prosesSurat'])->name('terima.surat_keterangan');
                Route::get('/surat_keterangan/{surat}/print_surat', [SuratRWController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                // Route::put('/surat_keterangan/{surat}/tolak', [SuratRWController::class, 'tolakSuratKeterangan'])->name('tolak.surat_keterangan');
                // Route::get('/surat_keterangan/{surat}/print_surat', [SuratRWController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                Route::get('/detail/{id}', [SuratRWController::class, 'show'])->name('show');
                route::get('/show_pengaju', [SuratRWController::class, 'show_pengaju'])->name('show_pengaju');
                Route::get('cek_surat', [SuratRWController::class, 'cekSurat'])->name('cekSurat');
                Route::post('validasi/qrcode', [SuratRWController::class, 'validasiCode'])->name('validasi_qrcode');
            });
            route::post('pembayaran/store', [PembayaranRWController::class, 'store'])->name("pembayaran.store");
            //Route::post('logout', [LoginRWController::class, 'logout'])->name('logout');
            Route::get('/pengumuman/status/update', [PengumumanController::class, 'updateStatus'])->name('pengumuman.update.status');
        });
    });

    Route::group(['middleware' => 'role:Petugas Lurah'], function () { // Group route Petugas Kelurahan
        Route::prefix('PK')->name('pk.')->group(function () {
            Route::get('dashboard', [PetugasController::class, 'home_petugas'])->name('dashboard.home');

            route::resource('fasilitas', FasilitasUmumPKController::class);
            route::resource('kegiatan', KegiatanPKController::class);
            Route::get('/kegiatan/status/update', [KegiatanPKController::class, 'updateStatus'])->name('kegiatan.update.status');
            route::resource('pengumuman', PengumumanPKController::class);
            Route::get('/pengumuman/status/update', [PengumumanPKController::class, 'updateStatus'])->name('pengumuman.update.status');

            route::resource('warga', WargaPKController::class)->except(['show']);
            Route::get('/warga/detail/{id}', [WargaPKController::class, 'show_warga'])->name('warga.show_warga');
            Route::get('/list-warga/{rw}', [WargaPKController::class, 'wargaRw']);
            Route::get('/warga/wargakepala', [WargaPKController::class, 'wargakepala'])->name('warga.wargakepala');
            route::resource('/warga/wargamiskin', WargaMiskinPKController::class)->only([
                'index', 'create', 'store', 'destroy', 'show', 'show_warga', 'requestSurat', 'print'
            ]);
            Route::get('/warga/wargamiskin', [WargaMiskinPKController::class, 'index'])->name('warga.wargamiskin');
             route::get('kemiskinan/show_warga', [WargaMiskinPKController::class, 'show_warga'])->name('kemiskinan.show_pelapor');
            // Route::get('/warga/wargamiskin', [WargaPKController::class, 'wargamiskin'])->name('warga.wargamiskin');
            Route::get('/warga/wargalansia', [WargaPKController::class, 'wargalansia'])->name('warga.wargalansia');

            route::resource('rw', KelolaRWPKController::class);
            route::resource('rt', KelolaRTPKController::class);

            Route::resource('berita', BeritaController::class);

            Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
                Route::get('/', [PengaduanPKController::class, 'index'])->name('index');
                Route::get('/show/{pengaduan}', [PengaduanPKController::class, 'show'])->name('show');
                Route::post('/tanggapin', [PengaduanPKController::class, 'tanggapin'])->name('tanggapin');
                Route::get('/ditampilkan', [PengaduanPKController::class, 'updateStatus'])->name('ditampilkan');
            });

            Route::get('/warga/getKab/{id}', function ($id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/{idw}/getKab/{id}', function ($idw, $id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/getKec/{id}', function ($id) {
                $kec = App\Models\Kecamatan::where('id_kab', $id)->get();
                return response()->json($kec);
            });
            Route::get('/warga/getKel/{id}', function ($id) {
                $kel = App\Models\Kelurahan::where('id_kec', $id)->get();
                return response()->json($kel);
            });

            Route::get('/wargarw/wargam', [WargaPKController::class, 'wargamrw'])->name('wargamrw.wargamrw');
            Route::get('/wargarw/wargamd/{id}', [WargaPKController::class, 'wargamrwd'])->name('wargamrwd.wargamrwd');

            route::resource('profile', ProfilePKController::class);
            Route::prefix('surat')->name('surat.')->group(function () {
                Route::get('/', [SuratPKController::class, 'index'])->name('index');
                Route::get('/nomorsurat', [SuratPKController::class, 'nomorsurat'])->name('nomorsurat');
                Route::get('/surat_keterangan', [SuratPKController::class, 'surat_keterangan'])->name('form.surat_keterangan');
                Route::get('/surat_keterangan/{surat}', [SuratPKController::class, 'detailSuratKeterangan'])->name('detail.surat_keterangan');
                Route::put('/surat_keterangan/{surat}/proses', [SuratPKController::class, 'prosesSurat'])->name('terima.surat_keterangan');
                Route::get('/surat_keterangan/{surat}/print_surat', [SuratPKController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                // Route::put('/surat_keterangan/{surat}/tolak', [SuratRWController::class, 'tolakSuratKeterangan'])->name('tolak.surat_keterangan');
                // Route::get('/surat_keterangan/{surat}/print_surat', [SuratRWController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                Route::get('/detail/{id}', [SuratPKController::class, 'show'])->name('show');
                route::get('/show_pengaju', [SuratPKController::class, 'show_pengaju'])->name('show_pengaju');
                Route::get('cek_surat', [SuratPKController::class, 'cekSurat'])->name('cekSurat');
                Route::post('validasi/qrcode', [SuratPKController::class, 'validasiCode'])->name('validasi_qrcode');
            });
            route::post('pembayaran/store', [PembayaranPKController::class, 'store'])->name("pembayaran.store");
            //Route::post('logout', [LoginRWController::class, 'logout'])->name('logout');
            
            route::resource('iuran', IuranController::class);
        });
    });

    Route::group(['middleware' => 'role:Lurah'], function () { // Group route Lurah
        Route::prefix('Lurah')->name('lurah.')->group(function () {
            Route::get('dashboard', [LurahController::class, 'home_lurah'])->name('dashboard.home');
            route::resource('pengumuman', PengumumanWargaController::class);
            Route::get('/pengumuman/status/update', [PengumumanLurahController::class, 'updateStatus'])->name('pengumuman.update.status');
            route::resource('fasilitas', FasilitasWargaController::class);
            route::resource('kegiatan', KegiatanWargaController::class);
            Route::get('/kegiatan/status/update', [KegiatanLurahController::class, 'updateStatus'])->name('kegiatan.update.status');
            route::resource('pengaduan', PengaduanLurahController::class);
            Route::get('/pengaduan/show/{pengaduan}', [PengaduanLurahController::class, 'show'])->name('show');

            route::resource('warga', WargaLurahController::class)->except(['show']);
            Route::get('/warga/detail/{id}', [WargaLurahController::class, 'show_warga'])->name('warga.show_warga');
            Route::get('/list-warga/{rw}', [WargaLurahController::class, 'wargaRw'])->name('list-warga');
            Route::get('/warga/wargakepala', [WargaLurahController::class, 'wargakepala'])->name('warga.wargakepala');
            route::resource('/warga/wargamiskin', WargaMiskinLurahController::class)->only([
                'index', 'create', 'store', 'destroy', 'show', 'show_warga', 'requestSurat', 'print'
            ]);
            Route::get('/warga/wargamiskin', [WargaMiskinLurahController::class, 'index'])->name('warga.wargamiskin');
             route::get('kemiskinan/show_warga', [WargaMiskinLurahController::class, 'show_warga'])->name('kemiskinan.show_pelapor');
            // Route::get('/warga/wargamiskin', [WargaPKController::class, 'wargamiskin'])->name('warga.wargamiskin');
            Route::get('/warga/wargalansia', [WargaLurahController::class, 'wargalansia'])->name('warga.wargalansia');

            Route::get('/list-rw/{rw}', [KelolaRWLurahController::class, 'show'])->name('list.rw');
            route::resource('rw', KelolaRWLurahController::class);

            // route::resource('warga', WargaLurahController::class);
            // Route::get('/list-warga/{rw}', [WargaLurahController::class, 'wargaLurah'])->name('lurah.warga.index');
            // Route::get('/warga/wargakklurah', [WargaLurahController::class, 'wargakklurah'])->name('warga.wargakklurah');
            // Route::get('/warga/wargamlurah', [WargaLurahController::class, 'wargamlurah'])->name('warga.wargamlurah');
            // Route::get('/warga/wargalansialurah', [WargaLurahController::class, 'wargalansialurah'])->name('warga.wargalansialurah');
            // Route::get('/wargat/tetap', [WargaLurahController::class, 'wargatetap'])->name('wargaw.tetapw');
            // Route::get('/wargatt/pendatang', [WargaLurahController::class, 'wargapendatang'])->name('wargatw.pendatanw');
            // Route::get('/wargak/wargak', [WargaLurahController::class, 'wargak'])->name('wargaww.wargaww');

            Route::get('/warga/getKab/{id}', function ($id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/{idw}/getKab/{id}', function ($idw, $id) {
                $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
                return response()->json($kab);
            });
            Route::get('/warga/getKec/{id}', function ($id) {
                $kec = App\Models\Kecamatan::where('id_kab', $id)->get();
                return response()->json($kec);
            });
            Route::get('/warga/getKel/{id}', function ($id) {
                $kel = App\Models\Kelurahan::where('id_kec', $id)->get();
                return response()->json($kel);
            });

            Route::get('/wargarw/wargam', [WargaLurahController::class, 'wargamrw'])->name('wargamrw.wargamrw');
            Route::get('/wargarw/wargamd/{id}', [WargaLurahController::class, 'wargamrwd'])->name('wargamrwd.wargamrwd');

            route::resource('lurah/profile', ProfileLurahController::class);
            route::resource('iuran', IuranController::class);
            Route::prefix('surat')->name('surat.')->group(function () {
                Route::get('/', [SuratLurahController::class, 'index'])->name('index');
                Route::get('/nomorsurat', [SuratLurahController::class, 'nomorsurat'])->name('nomorsurat');
                Route::get('/surat_keterangan', [SuratLurahController::class, 'surat_keterangan'])->name('form.surat_keterangan');
                Route::get('/surat_keterangan/{surat}', [SuratLurahController::class, 'detailSuratKeterangan'])->name('detail.surat_keterangan');
                Route::put('/surat_keterangan/{surat}/proses', [SuratLurahController::class, 'prosesSurat'])->name('terima.surat_keterangan');
                Route::get('/surat_keterangan/{surat}/print_surat', [SuratLurahController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                // Route::put('/surat_keterangan/{surat}/tolak', [SuratRWController::class, 'tolakSuratKeterangan'])->name('tolak.surat_keterangan');
                // Route::get('/surat_keterangan/{surat}/print_surat', [SuratRWController::class, 'printSuratKeterangan'])->name('print.surat_keterangan');
                Route::get('/detail/{id}', [SuratLurahController::class, 'show'])->name('show');
                route::get('/show_pengaju', [SuratLurahController::class, 'show_pengaju'])->name('show_pengaju');
                Route::get('cek_surat', [SuratLurahController::class, 'cekSurat'])->name('cekSurat');
                Route::post('validasi/qrcode', [SuratLurahController::class, 'validasiCode'])->name('validasi_qrcode');
            });
            route::post('pembayaran/store', [PembayaranLurahController::class, 'store'])->name("pembayaran.store");
            //Route::post('logout', [LoginRWController::class, 'logout'])->name('logout');

        });
    });

    // Route::group(['middleware' => 'role:Warga'], function () { // Group route Warga
    //         Route::get('Warga', [DashboardWargaController::class, 'index'])->name('home');
    //         Route::resource('pengaduan', WargaPengaduanController::class);
    //         Route::get('pengaduan/pribadi', [WargaPengaduanController::class, 'pengaduan_pribadi'])->name('pengaduan.pribadi');
            // Route::resource('kegiatan_warga', KegiatanWargaController::class);
    //         Route::resource('pengumuman_warga', PengumumanWargaController::class);
    //         Route::resource('fasilitaswarga', FasilitasWargaController::class);
    //         Route::resource('profilewarga', ProfileWargaController::class);
    //         Route::get('/kategori_pengumuman/{id}', [PengumumanWargaController::class, 'filter_kategori_pengumuman'])->name('filter_kategori');
    //         Route::get('/rw-rt', [OtherController::class, 'rtrw'])->name('rw-rt');

    //         //Route::post('logout', [LoginWargaController::class, 'logout'])->name('logout');
    //         Route::get('getKab/{id}', function ($id) {
    //             $kab = App\Models\Kabupaten::where('id_prov', $id)->get();
    //             return response()->json($kab)->name('getkab');
    //         });
    //         Route::prefix('surat')->name('surat.')->group(function () {
    //             Route::get('/', [SuratWargaController::class, 'index'])->name('index');
    //             Route::delete('/{surat}', [SuratWargaController::class, 'destroy'])->name('destroy');
    //             Route::get('/surat_keterangan', [SuratWargaController::class, 'surat_keterangan'])->name('form.surat_keterangan');
    //             Route::get('/surat_keterangan/{id}/print_surat', [SuratWargaController::class, 'print'])->name('print.surat_keterangan');
    //             Route::get('/detail/{id}', [SuratWargaController::class, 'show'])->name('show');
    //             Route::post('/surat_keterangan/store', [SuratWargaController::class, 'surat_keterangan_store'])->name('store.surat_keterangan');
    //             route::get('/show_pengaju', [SuratWargaController::class, 'show_pengaju'])->name('show_pengaju');
    //             Route::post('validasi/qrcode', [SuratWargaController::class, 'validasiCode'])->name('validasi_qrcode');
    //             // Route::get('/show/{pengaduan}', [PengaduanRTController::class, 'show'])->name('show');
    //         });
    //         Route::get('/persyaratan', function () {
    //             // Route assigned name "admin.users"...
    //             return view('warga.prosedure');
    //         })->name('persyaratan');
    //         Route::prefix('iuran')->name('iuran.')->group(function () {
    //             Route::get('/', [IuranWargaController::class, 'index'])->name('home');
    //             Route::get('/detail/{id}', [IuranWargaController::class, 'show'])->name('show');
    //             // Route::get('/show/{pengaduan}', [PengaduanRTController::class, 'show'])->name('show');
    //         });
    // });

});

Route::get('/chart/pertumbuhan-anak', [ChartController::class, 'pertumbuhanAnak'])->name('chart.pertumbuhan.anak');

//Route::get('petugas/dashboard', [PetugasController::class, 'home_petugas'])->name('dashboard.home');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     });
//     // route::resource('pembayaran', PembayaranRWController::class)->except('store');
// });

Route::get('/status/update', [KelolaRTController::class, 'updateStatus'])->name('rt.update.status');
Route::get('/rw/status/update', [KelolaRWController::class, 'updateStatus'])->name('rw.update.status');
Route::get('/pk/status/update', [KelolaPKController::class, 'updateStatus'])->name('pk.update.status');


// //Prosedur
// Route::get('/prosedure', function () {
//     return view('prosedure', [
//         "title" => "prosedure"
//     ]);
// });

//Kegiatan warga
// Route::get('/kegiatan-warga', function () {
//     return view('kegiatan_warga', [
//         "title" => "kegiatan-warga"
//     ]);
// });

// Route::get('tabledit/action', 'IuranController@action')->name('tabledit.action');

//Admin
// Route::group(['prefix' => 'Admin'], function () {
//     Route::get('/', [AdminController::class, 'home_admin'])->name('admin.dashboard.home');
//     route::resource('kelola_rtrw', KelolaRTRWController::class);
//     route::resource('rw', KelolaRWController::class);
//     route::resource('rt', KelolaRTController::class);
//     route::resource('pk', KelolaPKController::class);

// });

// //route kegiatan
// Route::get('/view-kegiatan', function () {
//     return view('RW.Kegiatan.table_kegiatan', [
//         'title' => 'table-kegiatan'
//     ]);
// });

// //route kelahiran
// Route::get('/view-kelahiran', function () {
//     return view('RT.Kelahiran.kelahiran-rt', [
//         'title' => 'table-kelahiran'
//     ]);
// });
// Route::get('/create-kelahiran', function () {
//     return view('RT.kelahiran.kelahiran-tambah-rt', [
//         'title' => 'table-kelahiran'
//     ]);
// });
// Route::get('/create-kematian', function () {
//     return view('RT.kematian.kematian-tambah-rt', [
//         'title' => 'table-kematian'
//     ]);
// });

