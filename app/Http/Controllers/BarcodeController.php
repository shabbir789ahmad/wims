<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barcode;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStock;
use DNS1D;
use Auth;
class BarcodeController extends Controller
{
    
    public function index()
    {
        $barcodes=Barcode::Branch()->orderBy('created_at', 'DESC')->get();
        $categories=Category::Branch()->get();
        $products=Product::Branch()->get();
        return view('barcode.index',compact('barcodes','products','categories'));
    }
    public function product($id)
    {
        
        $products=Product::Branch()->where('sub_category_id',$id)->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

   
    public function store(Request $request)
    {
        $barcodes = new Barcode;
        $code=uniqid();
       
        $barcode ='<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code, 'C39+',1,40,array(1,1,1), true) . '" alt="barcode"   />';

        $products=Product::Branch()->join('product_brands','products.id','=','product_brands.product_id')->select('products.product_name','product_brands.product_id','product_brands.id','products.sell_by')->where('products.id',$request->barcode_id)->first();
        if($products)
        {
            $price=ProductStock::Branch()->where('pbrand_id',$products->id)->first();
            $price2='';
        if($products->sell_by=='piece' || $products->sell_by=='piece, unit' )
        {
            $price2=$price->product_price_piece;
        }else
        {
           $price2=$price->product_price_unit;
        }

         $barcodes->name = substr($products->product_name,0,28).'..'??null;
         $barcodes->price = $price2??null;
         $barcodes->barcode = $barcode;
         $barcodes->barcode_id = $products->product_id;
         $barcodes->branch_id=Auth::user()->branch_id;
        }else
        {
          
          $barcodes->barcode = $barcode;
           $barcodes->branch_id=Auth::user()->branch_id;
        }
        
        
       
       $barcodes->save(); 
       return redirect()->route('barcode.index');
    }

    
    public function show($id)
    {
        $barcode=Barcode::where('id',$id)->first();
       
        return view('barcode.create',compact('barcode'));
    }

    public function productBarcode($id)
    {
        
         
        $products=Product::Branch()->join('product_brands','products.id','=','product_brands.product_id')->select('products.product_name','products.product_code','product_brands.product_id','product_brands.id','products.sell_by')->where('products.id',$id)->first();
        $price=ProductStock::Branch()->where('pbrand_id',$products->id)->first();
        $price2='';
        if($products->sell_by=='piece' || $products->sell_by=='piece, unit' )
        {
            $price2=$price->product_price_piece;
        }else
        {
           $price2=$price->product_price_unit;
        }
    
       $barcode ='<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($products->product_code, 'C39+',1,40,array(1,1,1), true) . '" alt="barcode"   />';
     $name=substr($products->product_name,0,20).'..';
        
        return view('barcode.newbarcode',compact('price2','name','barcode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barcode::destroy($id);
        return redirect()->back()->with('success','Barcode deleted');
    }
}
