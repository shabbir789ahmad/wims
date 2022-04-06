<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        
        Product::insert([

            [
                'brand_id' => 1, 
                'category_id' => 1,
                'sub_category_id' => 3, 
                'product_name' => 'Xbox One', 
                'product_code' => null, 
                'product_weight' => null, 
                'unit_id' => 1, 
                'sell_by' => 'piece', 
                'product_price' => '15000'
            ],

        ]);

    }
}
