<?php

// namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\rt;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;

// class RtControllerTest extends TestCase
// {
//     use RefreshDatabase;

//     protected function setUp(): void
//     {
//         parent::setUp();

//         $this->artisan('migrate');
//         $this->artisan('db:seed');

//         $user = User::factory()->create();
//         Auth::login($user);
//     }

//     public function testIndexRt()
//     {
//         $response = $this->get(route('rt.index'));

//         $response->assertStatus(200);
//         $response->assertViewIs('Admin.Kelola_rtrw.rt.tabel_rt');
//         $response->assertViewHas('kelola_rt');
//         $response->assertViewHas('title', 'Kelola RT');
//     }

//     public function testCreateRt()
//     {
//         $response = $this->get(route('rt.create'));

//         $response->assertStatus(200);
//         $response->assertViewIs('Admin.Kelola_rtrw.rt.tambah_rt');
//         $response->assertViewHas('title', 'tambah RT');
//         $response->assertViewHas('rt');
//         $response->assertViewHas('rw');
//     }

//     public function testStoreRt()
//     {
//         $data = [
//             'id_warga' => 1,
//             'no_rt' => 'RT001',
//             'id_rw' => 1,
//             'tgl_awal_jabatan_rt' => '2023-06-09',
//             'tgl_akhir_jabatan_rt' => '2024-06-09',
//         ];

//         $response = $this->post(route('rt.store'), $data);

//         $this->assertDatabaseHas('rts', [
//             'id_warga' => $data['id_warga'],
//             'no_rt' => $data['no_rt'],
//             'id_rw' => $data['id_rw'],
//             'tgl_awal_jabatan_rt' => $data['tgl_awal_jabatan_rt'],
//             'tgl_akhir_jabatan_rt' => $data['tgl_akhir_jabatan_rt'],
//         ]);

//         $response->assertRedirect(route('rt.index'));
//         $response->assertSessionHas('success', 'Data berhasil ditambah!');
//     }

//     public function testEditRt()
//     {
//         $rt = Rt::factory()->create();

//         $response = $this->get(route('rt.edit', $rt));

//         $response->assertStatus(200);
//         $response->assertViewIs('Admin.Kelola_rtrw.rt.edit_rt');
//         $response->assertViewHas('rt', $rt);
//         $response->assertViewHas('rw');
//         $response->assertViewHas('kelola_rt');
//         $response->assertViewHas('title', 'edit-rt');
//     }

//     public function testUpdateRt()
//     {
//         $rt = Rt::factory()->create();

//         $data = [
//             'id_warga' => 1,
//             'no_rt' => 'RT002',
//             'id_rw' => 2,
//             'tgl_awal_jabatan_rt' => '2023-06-09',
//             'tgl_akhir_jabatan_rt' => '2024-06-09',
//         ];

//         $response = $this->put(route('rt.update', $rt), $data);

//         $this->assertDatabaseHas('rts', [
//             'id_rt' => $rt->id_rt,
//             'id_warga' => $data['id_warga'],
//             'no_rt' => $data['no_rt'],
//             'id_rw' => $data['id_rw'],
//             'tgl_awal_jabatan_rt' => $data['tgl_awal_jabatan_rt'],
//             'tgl_akhir_jabatan_rt' => $data['tgl_akhir_jabatan_rt'],
//         ]);

//         $response->assertRedirect(route('rt.index'));
//         $response->assertSessionHas('success', 'Data berhasil diubah!');
//     }

//     public function testDestroyRt()
//     {
//         $rt = Rt::factory()->create();

//         $response = $this->delete(route('rt.destroy', $rt));

//         $this->assertDeleted($rt);

//         $response->assertRedirect(route('rt.index'));
//         $response->assertSessionHas('success', 'data berhasil dihapus!');
//     }

//     public function testShowRt()
//     {
//         $rt = rt::factory()->create();

//         $response = $this->get(route('rt.show', $rt->id_rt));
//         // $response->ddSession();
//         $response->assertStatus(200);
//         $response->assertViewIs('Admin.Kelola_rtrw.rt.detail_rt');
//         $response->assertViewHas('identitas_rw');
//         $response->assertViewHas('identitas_rt');
//         $response->assertViewHas('title', 'detail-rtrw');
//     }

//     // public function testUpdateStatusRt()
//     // {
//     //     $rt = Rt::factory()->create(['status_rt' => 0]);

//     //     $data = [
//     //         'id_rt' => $rt->id_rt,
//     //         'status_rt' => 1,
//     //     ];

//     //     $response = $this->json('POST', route('rt.updateStatus'), $data);

//     //     $this->assertDatabaseHas('rts', [
//     //         'id_rt' => $rt->id_rt,
//     //         'status_rt' => $data['status_rt'],
//     //     ]);

//     //     $response->assertStatus(200);
//     //     $response->assertJson([
//     //         'success' => 'Status change successfully.',
//     //         'status' => 1,
//     //         'product' => $rt->toArray(),
//     //     ]);
//     // }
// }


// <?php

namespace Tests\Unit\Admin;

use App\Http\Controllers\Admin\KelolaRTController as RtController;
use App\Models\rt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class RtControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::factory()->create();
        Auth::login($user);
    }

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndexRt()
    {
        // Membuat data rt palsu
        rt::factory()->create();
        
        // Membuat instance dari RtController
        $controller = new RtController();
        
        // Memanggil metode index pada controller
        $response = $controller->index();
        
        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rt.tabel_rt'
        $this->assertEquals('Admin.Kelola_rtrw.rt.tabel_rt', $response->name());
        
        // Memastikan bahwa data rt dikirim ke view
        $this->assertArrayHasKey('kelola_rt', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreateRt()
    {
        // Membuat instance dari RtController
        $controller = new RtController();

        // Memanggil metode create pada controller
        $response = $controller->create();

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);

        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rt.tambah_rt'
        $this->assertEquals('Admin.Kelola_rtrw.rt.tambah_rt', $response->name());

        // Memastikan bahwa data rt dikirim ke view
        $this->assertArrayHasKey('rt', $response->getData());

        // Memastikan bahwa rw dikirim ke view
        $this->assertArrayHasKey('rw', $response->getData());

        // Add more assertions if needed
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStoreRt()
    {
        // Membuat instance dari RtController
        $controller = new RtController();

        // Menyiapkan data untuk pengujian
        $data = [
            'id_warga' => 1,
            'no_rt' => 'RT001',
            'id_rw' => 1,
            'tgl_awal_jabatan_rt' => '2023-06-09',
            'tgl_akhir_jabatan_rt' => '2024-06-09',
        ];

        // Memanggil metode store pada controller dengan data yang diberikan
        $response = $controller->store(new Request($data));
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'rt.index'
        $this->assertEquals(route('rt.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEditRt()
    {
        // Membuat data rt palsu
        $rt = rt::factory()->create();

        // Membuat instance dari RtController
        $controller = new RtController();

        // Memanggil metode edit pada controller
        $response = $controller->edit($rt);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rt.edit_rt'
        $this->assertEquals('Admin.Kelola_rtrw.rt.edit_rt', $response->name());
        
        // Memastikan bahwa data rt dikirim ke view
        $this->assertArrayHasKey('rw', $response->getData());
        
        // Memastikan bahwa data kategori rt dikirim ke view
        $this->assertArrayHasKey('kelola_rt', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdateRt()
    {
        // Membuat data rt palsu
        $rt = rt::factory()->create();

        // Membuat instance dari RtController
        $controller = new RtController();

        // Membuat request palsu
        $request = Request::create('/rt/' . $rt->id_rt, 'POST', [
            'id_warga' => 1,
            'no_rt' => 'RT002',
            'id_rw' => 2,
            'tgl_awal_jabatan_rt' => '2023-06-09',
            'tgl_akhir_jabatan_rt' => '2024-06-09',
        ]);

        // Memanggil metode update pada controller
        $response = $controller->update($request, $rt);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'rt.index'
        $this->assertEquals(route('rt.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroyRt()
    {
        // Membuat data rt palsu
        $rt = rt::factory()->create();

        // Membuat instance dari RtController
        $controller = new RtController();

        // Memanggil metode destroy pada controller
        $response = $controller->destroy($rt);
        
        // Memastikan bahwa redirect response diberikan
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        
        // Memastikan bahwa redirect route adalah 'rt.index'
        $this->assertEquals(route('rt.index'), $response->getTargetUrl());
        
        // Memastikan bahwa flash session success telah diatur
        $this->assertTrue(session()->has('success'));
        
        // Add more assertions if needed
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowRt()
    {
        // Membuat data rt palsu
        $rt = rt::factory()->create();

        // Membuat instance dari RtController
        $controller = new RtController();

        // Memanggil metode show pada controller
        $response = $controller->show($rt->id_rt);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rt.detail_rt'
        $this->assertEquals('Admin.Kelola_rtrw.rt.detail_rt', $response->name());
        
        // Memastikan bahwa data rt dikirim ke view
        $this->assertArrayHasKey('identitas_rt', $response->getData());
        
        // Add more assertions if needed
    }

    /**
     * Test updateStatus method.
     *
     * @return void
     */
    public function testUpdateStatusRt()
    {
        // Membuat data rt palsu
        $rt = rt::factory()->create();

        // Membuat request palsu
        $request = Request::create('/rt/updateStatus', 'POST', [
            'id_rt' => $rt->id_rt,
            'status_rt' => 0
        ]);

        // Membuat instance dari RtController
        $controller = new RtController();

        // Memanggil metode updateStatus pada controller
        $response = $controller->updateStatus($request);

        // Memastikan bahwa response adalah instance dari JsonResponse
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        
        // Memastikan bahwa response memiliki data JSON dengan kunci 'success'
        $this->assertArrayHasKey('success', $response->getData(true));

        
        // Add more assertions if needed
    }
}

