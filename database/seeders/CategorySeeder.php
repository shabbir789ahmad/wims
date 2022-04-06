<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {

        Category::insert([

            ['branch_id' => 1, 'category_name' => 'Electronics'],

        ]);

        SubCategory::insert([

            ['category_id' => 1, 'sub_category_name' => 'Mobile Phones'],
            ['category_id' => 1, 'sub_category_name' => 'Tablets'],
            ['category_id' => 1, 'sub_category_name' => 'Gaming Consoles'],

        ]);

    }
}
