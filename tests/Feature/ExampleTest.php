<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Database\Seeders\ProductSeeder;
use App\Models\Product;

class ExampleTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_example()
    {        
        $this->seed(ProductSeeder::class);

        $response = $this->get('/');
        $response->assertRedirectContains('products');        
    }

    /** @test */
    public function show_view_welcome_if_has_no_products(){
        $response = $this->get('/');        
        $response->assertViewIs('welcome');        
    }
}
