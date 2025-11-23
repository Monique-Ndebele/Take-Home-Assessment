<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductsTest extends TestCase
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

    public function test_list_all_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(5);
    }

    public function test_admin_can_create_product()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->postJson('/api/products', [
                             'name' => 'New Product',
                             'price' => 99.99,
                             'description' => 'Test product'
                         ]);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'New Product']);
    }

    public function test_non_admin_cannot_create_product()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->userToken)
                         ->postJson('/api/products', [
                             'name' => 'Blocked Product',
                             'price' => 10
                         ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_product()
    {
        $product = Product::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->putJson('/api/products/'.$product->id, [
                             'name' => 'Updated Product'
                         ]);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Product']);
    }

    public function test_admin_can_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->deleteJson('/api/products/'.$product->id);

        $response->assertStatus(200);
    }
}

