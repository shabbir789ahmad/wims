<?php

namespace App\Http\Traits;
use  App\Models\Product;
Trait SearchProduct
{

   function searchBarcode($codes)
   {
 	
 	return Product::join('product_brands','products.id','=','product_brands.product_id')->select('product_brands.id','products.sell_by','products.unit_id','product_brands.product_id')->where('product_code',$codes)->orWhere('unit_barcode',$codes)->first();

   }


   function searchByBrand($brand_id)
   {

   	 return Product::
       join('product_brands','products.id','=','product_brands.product_id')
       ->select('products.product_name','product_brands.product_id','products.sell_by','product_brands.id','products.unit_id','products.gst_tax','products.pack_quentity','products.product_code','products.unit_barcode')
      ->where('product_brands.id',$brand_id)
      ->Branch()
      ->first();
   }

}

?>