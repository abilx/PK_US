<?php

namespace Tests\Unit\Model;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Test creating a new User.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $userData = [
            'username' => 'john_doe',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['username' => 'john_doe']);
    }

    /**
     * Test updating an existing User.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $updatedData = [
            'username' => 'jane_smith',
            'password' => Hash::make('new_password'),
            'role_id' => 2,
        ];

        $user->update($updatedData);

        $this->assertEquals('jane_smith', $user->username);
        $this->assertTrue(Hash::check('new_password', $user->password));
        $this->assertEquals(2, $user->role_id);
        $this->assertDatabaseHas('users', ['username' => 'jane_smith']);
    }

    /**
     * Test deleting a User.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $userData = [
            'username' => 'john_doe',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ];

        $user = User::create($userData);

        $user->delete();

        $this->assertDeleted($user);
    }

    /**
     * Test User model has correct attributes.
     *
     * @return void
     */
    public function testUserModelHasCorrectAttributes()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertNotNull($user->username);
        $this->assertNotNull($user->password);
        $this->assertNotNull($user->role_id);
        $this->assertNotNull($user->created_at);
        $this->assertNotNull($user->updated_at);
        $this->assertNull($user->deleted_at);
    }
}
