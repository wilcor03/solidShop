<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;

#### model ###
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(10)->create();   
    }
}
