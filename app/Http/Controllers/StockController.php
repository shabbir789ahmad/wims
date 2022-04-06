<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Models\ProductStock;
use App\Models\SubCategory;
use Auth;
class StockController extends Controller
{
    function getProduct(Request $req)
    {

   
        $products=Product::Branch()->findOrFail($req->id);
        $categories=Category::Branch()->where('id',$products['category_id'])->first('category_name');
        $sub_categories=SubCategory::Branch()->where('id',$products['sub_category_id'])->first('sub_category_name');
        
        
        $brands=ProductBrand::where('id',$req->brandss)->first();
        $pbrand=Brand::Branch()->where('id',$brands->brand_id)->first('brand_name');
           $stock=ProductStock::Branch()->where('pbrand_id',$brands['id'])->sum('stock');

           $brand_stock=ProductStock::where('pbrand_id',$brands->id)->get();
     
      
        return view('panel.stock.stock',compact('products','categories','sub_categories','pbrand','brands','stock','brand_stock'));
    }

    function stockAdd(Request $req)
    {
        
        $req->validate([
         
           'stock_id' => 'required',
           'stock' => 'required',

        ]);

        $data=[
         
          'pbrand_id' => $req->stock_id,
          'stock' => $req->stock,
          'purchasing_price' => $req->purchasing_price,
          'product_price_piece' => $req->product_price_piece,
          'product_price_piece_wholesale' => $req->product_price_piece_wholesale,
          'product_price_unit' => $req->product_price_unit,
          'product_price_unit_wholesale' => $req->product_price_unit_wholesale,
          'branch_id' =>Auth::user()->branch_id,
          'active'=>'0'
        ];
   
        try {

            ProductStock::create($data);

            \App\Helpers\Logger::logActivity(\Route::currentRouteName());

            return redirect()->back()->with('flash','success');
            
        } catch (\Exception $e) {

           return redirect()->back()->with('fail','success');
            
        }
    
        
    }


    function UpdateStock(Request $req)
    {
        $data=[
           'stock' =>$req->stock,
           'product_price_piece'=>$req->product_price_piece,
           'product_price_unit'=>$req->product_price_unit,
           'product_price_piece_wholesale'=>$req->product_price_piece_wholesale,
           'product_price_unit_wholesale'=>$req->product_price_unit_wholesale,
           'branch_id'=>Auth::user()->branch_id,
        ];
        $stock=ProductStock::where('id',$req->id)->update($data);
        
        return back()->with('flash','success');
    }
    function DeleteStock($id)
    {
        $stock=ProductStock::destroy($id);
        
        return back()->with('flash','success');
    }

    function activeStock(Request $req)
    {
       $pro=ProductStock::where('id',$req->id)->update(['active'=>$req->active]);
       return response()->json('updated');
    }
}