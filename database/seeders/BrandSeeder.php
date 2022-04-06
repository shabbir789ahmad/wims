<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Brand;

class BrandSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        
        Brand::insert([

            ['vendor_id' => 1, 'brand_name' => 'Microsoft'],
            ['vendor_id' => 1, 'brand_name' => 'Samsung'],
            ['vendor_id' => 1, 'brand_name' => 'Sony'],
            ['vendor_id' => 1, 'brand_name' => 'OnePlus'],
            ['vendor_id' => 1, 'brand_name' => 'Huawei'],
            ['vendor_id' => 1, 'brand_name' => 'Oppo'],

        ]);

    }
}
