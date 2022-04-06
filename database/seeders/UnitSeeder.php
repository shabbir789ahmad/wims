<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Unit;

class UnitSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Unit::insert([

            ['unit_name' => 'Piece', 'unit_code' => 'pc'],
            ['unit_name' => 'Gram', 'unit_code' => 'g'],
            ['unit_name' => 'Centimetre', 'unit_code' => 'cm'],

        ]);

    }
}
