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
use Cache;
trait ProductTrait
 {
   
    

    public function category()
    {

       return $categories= Cache::remember('categories', 15, function() 
        {

           return Category::Branch()->select('category_name','branch_id','id')->get();

        });
        
   
    }

    public function scategory()
    {
        $sub_categories = SubCategory::Branch()->select('sub_category_name','id','branch_id')->get();
        return $sub_categories;
    }


    public function brand()
    {
       return $brand= Cache::remember('brand', 15, function() 
        {
              
           return  Brand::Branch()->select('brand_name','id','branch_id')->get();

        });
   
      
    }


  

 }

?>