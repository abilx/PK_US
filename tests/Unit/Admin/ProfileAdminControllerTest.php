<?php

namespace Tests\Unit\Admin;

use App\Http\Controllers\Admin\ProfileAdminController as ProfileController;
use App\Models\User;
use App\Models\Warga;
use App\Models\rw;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;


class ProfileAdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = User::where('role_id', 1)->first();
        Auth::login($user);
    }

    /** @test */
    public function testUpdateUsername()
    {
        // Membuat data dummy
        // $warga = Warga::factory()->create();
        $user = User::factory()->create();
        $newUsername = 'newusername';

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Membuat request dengan data yang diperlukan
        $request = new Request([
            'username' => $newUsername,
            'user_id' => $user->id,
            'id' => $user->id
        ]);

        // Memanggil method update() dari controller
        $response = $controller->update($request);

        // Memastikan redirect berhasil dilakukan
        $this->assertEquals(route('profile.show', $user->id), $response->getTargetUrl());

        // Memastikan pesan berhasil ditampilkan
        $this->assertEquals('Username berhasil diubah!', session('success'));

        // Memastikan username telah berubah
        $this->assertEquals($newUsername, User::find($user->id)->username);
    }

    public function testUpdatePassword()
    {
        // Membuat data dummy
        // $warga = Warga::factory()->create();
        $user = User::factory()->create();
        $newPassword = 'newpassword';

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Membuat request dengan data yang diperlukan
        $request = new Request([
            'password' => $newPassword,
            'user_id' => $user->id,
            'id' => $user->id
        ]);

        // Memanggil method update() dari controller
        $response = $controller->update($request);

        // Memastikan redirect berhasil dilakukan
        $this->assertEquals(route('profile.show', $user->id), $response->getTargetUrl());
        
        // Memastikan pesan berhasil ditampilkan
        $this->assertEquals('Password berhasil diubah!', session('success'));

        // Memastikan password telah berubah
        $this->assertTrue(Hash::check($newPassword, User::find($user->id)->password));
    }


    /**
     * Test show method.
     *
     * @return void
     */
    public function testShowAdmin()
    {
        // Membuat data rw palsu
        $user = User::factory()->create();

        // Membuat instance dari ProfileController
        $controller = new ProfileController();

        // Memanggil metode show pada controller
        $response = $controller->show($user->id);

        // Memastikan bahwa response adalah instance dari view
        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
        
        // Memastikan bahwa view yang digunakan adalah 'Admin.Kelola_rtrw.rw.detail_rw'
        $this->assertEquals('Admin.ProfileAdmin.profile-admin-tes', $response->name());
        
        // Memastikan bahwa data rw dikirim ke view
        $this->assertArrayHasKey('user', $response->getData());
        
        // Add more assertions if needed
    }

}



