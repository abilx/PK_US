<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Warga;
use App\Models\User;
use App\Models\rw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;


class ProfileAdminTest extends TestCase
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

    public function testShowAdmin()
    {
        $user = User::where('role_id', 1)->first();

        $response = $this->get(route('profile.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('Admin.ProfileAdmin.profile-admin-tes');
        $response->assertViewHas('user');
        $response->assertViewHas('title', 'profile-admin');
    }

    public function testUpdateUsername()
    {
        $user = User::where('role_id', 1)->first();

        $data = [
            'username' => 'usernamebaru',
            'user_id' => $user->id,
            'id' => $user->id

        ];

        $response = $this->put(route('profile.update', $user), $data);

        $this->assertDatabaseHas('users', [
            'username' => 'usernamebaru',
        ]);

        $response->assertRedirect(route('profile.show', $user->id));
        $response->assertSessionHas('success', 'Username berhasil diubah!');
    }

    public function testUpdatePassword()
    {
        $user = User::where('role_id', 1)->first();

        $data = [
            'password' => 'passwordbaru',
            'user_id' => $user->user_id,
            'id' => $user->id

        ];

        $response = $this->put(route('profile.update', $user), $data);

        $password = Hash::check('passwordbarus', User::find($user->id)->password);

        $this->assertDatabaseHas('users', [
            'password' => $password,
        ]);

        $response->assertRedirect(route('profile.show', $user->id));
        $response->assertSessionHas('success', 'Password berhasil diubah!');
    }


}

