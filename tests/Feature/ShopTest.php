<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Product;
use App\Models\Order;

use Database\Seeders\ProductSeeder;
use Database\Seeders\OrderSeeder;

class ShopTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected static $order;
    protected static $product;

    /** @test */
    public function can_load_view_product_show()
    { 
      $this->seed(ProductSeeder::class);
      $this->assertDatabaseCount('products', Product::count());

      $product = Product::first();  
      Self::$product = $product;    

      $response = $this->get(route('product.show', $product));
      $response->assertStatus(200);

    }

    /** @test */
    public function can_load_order_preview(){
      $this->seed(ProductSeeder::class);
      $response = $this->get(route('order.preview', Self::$product), ['quantity' => 2]);
      $response->assertOk(200);
    }

    /** @test */
    public function can_load_all_orders_in_view(){
      $response = $this->get(route('order.index'));
      $response->assertOk();
      $response->assertViewIs('orders.index');

      $orders = Order::paginate();
      $response->assertViewHas('orders', $orders);
    }


    /** @test */
    public function can_store_orders_in_db(){     
      $this->seed(ProductSeeder::class);
      $response = $this->post(route('order.store', Self::$product), 
        [
          'quantity'        => 2,
          'product_id'      => 1,
          'customer_email'  => "wilcor03@gmail.com",
          'customer_name'   => 'wilmer c',
          'customer_mobile' => '3124910627'
        ]
      );

      $response->assertSessionHasNoErrors(
        ['quantity','product_id', 'customer_email', 'customer_name', 'customer_mobile']
      );

      Self::$order = Order::first();

      $response->assertOk(200);            
      //$response->assertRedirectContains(Order::first()->payment_response['placetopay']['respondeUrl']);
      $this->assertDatabaseCount('orders', 1);
    }    

    /** @test */
    public function can_load_response_payment_url(){

      $this->seed(ProductSeeder::class);
      $this->seed(OrderSeeder::class);

      $response = $this->get(route('payment.response', ['reference' => Order::first()->reference]));

      $response->assertOk();
    }
}
