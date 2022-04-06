<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {

        Admin::insert([

            [
                
                'name' => 'Haseeb Qamar', 
                'email' => 'haseebqamar92@gmail.com', 
                'admin_image' => 'fdsfhdsfh.jpg', 
                'branch_id' => '1', 
                'password' => \Hash::make('123456')
            ]

        ]);
        
    }
}
