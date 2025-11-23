<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrdersTest extends TestCase
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

    public function test_user_can_create_order()
    {
        $product = Product::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer '.$this->userToken)
                         ->postJson('/api/orders', [
                             'product_id' => $product->id,
                             'quantity' => 2
                         ]);

        $response->assertStatus(201)
                 ->assertJson(['product_id' => $product->id, 'quantity' => 2]);
    }

    public function test_user_can_list_their_orders()
    {
        $order = Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeader('Authorization', 'Bearer '.$this->userToken)
                         ->getJson('/api/orders');

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $order->id]);
    }

    public function test_admin_can_update_order_status()
    {
        $order = Order::factory()->create(['user_id' => $this->user->id, 'status' => 'pending']);

        $response = $this->withHeader('Authorization', 'Bearer '.$this->adminToken)
                         ->putJson('/api/orders/'.$order->id, [
                             'status' => 'completed'
                         ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'completed']);
    }
}

