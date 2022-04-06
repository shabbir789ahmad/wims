<?php

namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductBrand;
use App\Models\Brand;
use Auth;

trait ProductTrait
 {
   
    

    public function category()
    {
        $categories = Category::Branch()->select('category_name','branch_id','id')->get();
        return $categories;
    }
    public function scategory()
    {
        $sub_categories = SubCategory::Branch()->select('sub_category_name','id','branch_id')->get();
        return $sub_categories;
    }
    public function brand()
    {
        $brand = Brand::Branch()->select('brand_name','id','branch_id')->get();
        return $brand;
    }


  

 }

?>