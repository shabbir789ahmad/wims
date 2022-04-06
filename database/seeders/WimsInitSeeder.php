<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WimsInitSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        
        $this->call([

            VendorSeeder::class,
            BranchSeeder::class,
            AdminSeeder::class,
            // BrandSeeder::class,
            // CategorySeeder::class,
            // UnitSeeder::class,
            // ProductSeeder::class,
            
        ]);        

    }
}
