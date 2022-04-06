<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;

class Dashboard extends Model {

    use HasFactory;

    public static function initAdmin() {
        
        $brands = Brand::Branch()->count();
        $categories = Category::Branch()->count();
        $products = Product::Branch()->count();
        $suppliers = Supplier::Branch()->count();
          
        return [

            'brands' => $brands,
            'categories' => $categories,
            'products' => $products,
            'suppliers' => $suppliers,

        ];

    }

}
