<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Models\ProductStock;
use Illuminate\Support\Str;
use App\Http\Traits\ProductTrait;
use DB;
use Cache;
use Auth;
class MainController extends Controller {
 
  use ProductTrait;
    public function index() {
        
      return view('pos.index2');

    }

 
    function product($id)
    {
       
      
     $products = Cache::remember('products', 12, function ()
    {
      
      $products = \DB::table('products')->select('sub_category_id','product_name','id','product_image','sell_by','unit_id','product_code','unit_barcode');
       
       $products=$products->where('branch_id',Auth::user()->branch_id)->get();
       foreach($products as $product)
         {
            $product->stock=\DB::table('product_brands')->select('product_brands.id','brand_id','product_id','brand_name')->where('product_id',$product->id)->join('brands', 'brands.id', 'product_brands.brand_id')->where('brands.branch_id',Auth::user()->branch_id)->get();
           
            
         }
       return $products;
    });

      $stock = Cache::remember('stock', 12, function ()
        {
      
          $stock=\DB::table('product_stocks')->select('product_price_piece','product_price_unit','product_price_piece_wholesale','product_price_unit_wholesale','pbrand_id')->where('stock','>','0')->where('branch_id',Auth::user()->branch_id)->whereActive(1)->get();
            return $stock;
       });
          
          
    
          $data=[ 'products'=>$products,'stock'=>$stock];
         return response()->json($data);
    }


    public function indexuser() {
        
      return view('posuser.index2');

    }


   
   

}
