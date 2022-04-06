<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Vendor;

class VendorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        
        Vendor::insert([

            ['vendor_name' => 'WIMS']
            
        ]);

    }
}
