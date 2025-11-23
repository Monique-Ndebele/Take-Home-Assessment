<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;
    protected $adminToken;
    protected $userToken;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->user = User::factory()->create(['role' => 'user']);

        $this->adminToken = $this->admin->createToken('auth_token')->plainTextToken;
        $this->userToken = $this->user->createToken('auth_token')->plainTextToken;
    }

    public function test_admin_can_list_users()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id','name','email','role']]);
    }

    public function test_non_admin_cannot_list_users()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->userToken)
                         ->getJson('/api/users');

        $response->assertStatus(403);
    }

    public function test_admin_can_update_user()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->putJson('/api/users/'.$this->user->id, [
                             'name' => 'Updated Name'
                         ]);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Name']);
    }

    public function test_admin_can_delete_user()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->deleteJson('/api/users/'.$this->user->id);

        $response->assertStatus(200);
    }
}

