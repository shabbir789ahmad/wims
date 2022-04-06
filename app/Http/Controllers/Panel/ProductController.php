<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Unit;
use App\Models\ProductBrand;
use App\Http\Traits\ProductTrait;
use DB;
use Auth;
use App\Repository\ProductRepository;
class ProductController extends Controller {

    use ProductTrait;
    
    protected $stock = null;
    
    public function __construct(ProductRepository $stock)
    {
        $this->stock = $stock;
    }

    public function index(Request $req) {
       
  
        $products= Product::getProducts(); //from product trait
 
        $categories= $this->category();
        $sub_categories= $this->scategory();
        $brands= $this->brand();
        
        $stocks=$this->stock->getAllStock();
       
        //dd($stocks);
        return view('panel.products.index', compact('products','categories','brands','sub_categories','stocks'));

    }

    
    public function copyProduct(Request $req) {
       

      $products= Product::getProducts();//from Product Model
      $categories= $this->category();
      $sub_categories= $this->scategory();
      $brands= $this->brand();
      $stocks=$stocks=$this->stock->getAllStock();
      
      return view('panel.products.copy_product', compact('products','categories','brands','sub_categories','stocks'));

    }
    public function UpdateBluk(Request $req)
    {
       

        $categories = $this->category();
        $products=Product::getProducts(); //from product model
        $sub_categories = $this->scategory();
        $brands = $this->brand();
        $stocks=$stocks=$this->stock->getAllStock();
        
        return view('panel.products.update_bulk', compact('products','categories','brands','sub_categories','stocks'));

    }



    public function getProduct(Request $req) {
          
         $products = Product::find($req->id);

        foreach($products as $product)
        {
            $product->brand=ProductBrand::where('product_id',$product['id'])->first();
           
        }
         //from prodyuct trait
        $categories= $this->category();
        $sub_categories= $this->scategory();
        $brands= $this->brand();
         $units = Unit::all();

          //dd($products);
        return view('panel.products.new_product', compact('products','brands','categories','sub_categories','units'));
     }



     public function getProduct2(Request $req) {
 
        $products = Product::Branch()->findOrFail($req->id);
        foreach($products as $product)
        {
            $product->brand=ProductBrand::where('product_id',$product['id'])->first();
        }
            
        $categories= $this->category();//from prodyuct trait
        $sub_categories= $this->scategory();//from prodyuct trait
        $brands= $this->brand();//from prodyuct trait
        $units = Unit::all();
      
        return view('panel.products.update_product', compact('products','brands','categories','sub_categories','units'));
     }

    public function create() {

        $categories= $this->category();//from prodyuct trait
        $brands= $this->brand();//from prodyuct trait
        $units = Unit::all();

        return view('panel.products.create', compact('categories', 'brands', 'units'));
        
    }

  //get data for create bulk
    public function createBulk() {

        $brand_id = request()->query('brand_id');
        $category_id = request()->query('category_id');
        $sub_category_id = request()->query('sub_category_id');
        $sell_by = request()->query('sell_by');

        $meta = [

            'brand_id' => $brand_id,
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'sell_by' => $sell_by,
            'sub_categories' => []

        ];


        if ($category_id != null) {
            
            $sub_categories = \DB::table('sub_categories')->where('category_id', $category_id)->get();
            $meta['sub_categories'] = $sub_categories;

        }

        $units = Unit::all();
        $categories= $this->category();//from prodyuct trait
        $brands= $this->brand();//from prodyuct trait
        return view('panel.products.create_bulk', compact('categories', 'brands', 'units'))->with($meta);
        
    }

  //create single product
  public function store(Request $request)
   {
     $validator = \Validator::make($request->all(),
      [
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'sell_by' => 'required',
            'stock' => 'required',
            'purchasing_price' => 'required',
            
            
            
        ]);
     
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'validation Error');

        }
          
        if ($_FILES && $_FILES['image']['tmp_name']) {
            
            $uploader = new \App\Services\ImageUploadService($_FILES['image']);

            $file = $uploader->upload();

            $request->request->add(['product_image' => $file]);

        }
     
     foreach($request->sell_by as $sel)
     {
        if ($sel == 'unit') {

            $unit = $request->unit_id;
            $price = $request->price_per_unit;

        } elseif($sel == 'piece') {

            $unit = 1;
            $price = $request->price_per_piece;

        }
     }
        

    

        $sell=implode(", ", $request->sell_by);
        $product =
            [
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_weight' => $request->product_weight,
                'pack_quentity' => $request->quentity_per_pack,
                'branch_id' => Auth::user()->branch_id,
                'gst_tax' => $request->vat??null,
                'unit_barcode' => $request->unit_barcode??null,
                'unit_id' => $unit,
                'sell_by' => $sell,
                'product_image' => $request->get('product_image')??null,
            ];


        DB::transaction(function() use($request,$product)
        {
           $data=Product::create($product);
           $brand= ProductBrand::create([

                 'brand_id' =>$request->brand_id,
                 'product_id' =>$data['id'],
                 
              ]);

            ProductStock::create([
            
                'stock' =>$request->stock,
                'pbrand_id'  =>$brand['id'],
                'product_price_piece' => $request->product_price_piece,
                'product_price_unit' => $request->product_price_unit,
                'product_price_piece_wholesale' => $request->product_price_piece_wholesale,
                'product_price_unit_wholesale' => $request->product_price_unit_wholesale,
                'purchasing_price' => $request->purchasing_price,
                'active'=> 1,
                'branch_id'=>Auth::user()->branch_id,
               ]);
            
         });

       return redirect()->route('products.index')->with('flash', 'success');
    }


//update product in bulk
  public function updateBulkProduct(Request $request) 
  {
    $request->validate(
        [

          'purchasing_price' =>'required',
     
        ]);


    try{

        for ($i=0; $i < count($request->name) ; $i++) 
        { 
            $temp =Product::findorfail($request->id[$i]);
            $temp->product_name = $request->name[$i];
            $temp->product_code = $request->product_code[$i];
            $temp->branch_id = Auth::user()->branch_id;
            $temp->save();
          
            //update brand and stock also
            // $brand=ProductBrand::where('product_id', $request->id[$i])->first();
            // $brand->save();

            //dd($stock);
            $stock=ProductStock::Branch()->where('pbrand_id', $request->pbrand_id[$i])->first();
            if(!empty($stock))
            {
              $stock->stock=$request->stock[$i];
              $stock->product_price_piece = $request->product_price_piece[$i] ?? null;
              $stock->product_price_piece_wholesale = $request->product_price_piece_wholesale[$i] ?? null;
              $stock->product_price_unit = $request->product_price_unit[$i] ?? null;
              $stock->product_price_unit_wholesale = $request->product_price_unit_wholesale[$i] ?? null;
              $stock->purchasing_price=$request->purchasing_price[$i];
              $stock->branch_id=Auth::user()->branch_id;
              $stock->save();
            
            }else
            {
              ProductStock::create(
                [
                  'pbrand_id' => $request->pbrand_id[$i],
                  'stock'=> $request->stock[$i] ?? null,
                  'product_price_piece' => $request->product_price_piece[$i] ?? null,
                  'product_price_piece_wholesale' => $request->product_price_piece_wholesale[$i] ?? null,
                  'product_price_unit' => $request->product_price_unit[$i] ?? null,
                  'product_price_unit_wholesale' => $request->product_price_unit_wholesale[$i] ?? null,
                  'purchasing_price'=>$request->purchasing_price[$i],
                  'branch_id'=>Auth::user()->branch_id,
                ]);
            }

        }
          return redirect()->route('products.update.bulk')->with('flash','success');

    }catch(\Exception $e) 
    {

      return redirect()->back()->with('flash', 'error');
            
    }

  }//update bulk end here
   

   //create product in bulk
  public function storeProductInBulk(Request $request)
  {
    $request->validate([

          'name' => 'required',
          'sell_by' => 'required',
          'product_code' => 'required',
          'product_stock' => 'required',
          'image' => 'required',
          'sub_category_id' => 'required',
          
         

        ]);
          
          
         
       try {

        \DB::beginTransaction();
          for ($i=0;  $i < count($request->name); $i++) 
           { 
           
               //create product table
            // $sell_by=$request->sell_by;
            //   if ($sell_by == "unit" || $sell_by == "piece,unit") 
            //   {
            //     $unit = $unit[$i];
            //   } else
            //   {
            //     $unit = 1;
            //   }
           
              $file=$request->file('image')[$i];
              $ext=$file->getClientOriginalExtension();
              $filename=time(). '.' .$ext;
              $file->move('uploads/products/' , $filename);
              $image=$filename;

              $product=Product::create([
              
                'category_id'=>$request->category_id,
                'sub_category_id'=>$request->sub_category_id,
                'product_name'=>$request->name[$i],
                'product_code'=>$request->product_code[$i],
                'product_image'=>$image,
                'product_weight'=>$request->product_weight[$i]??null,
                'sell_by'=>$request->sell_by,
                'unit_id'=>$request->unit_id[$i] ?? 1,
                'admin_id'=>Auth::id(),
              ]);
          
             
                
                $brand = ProductBrand::create([

                    'brand_id'=> $request->brand_id,
                    'product_id'=> $product['id'],
                    
                ]);
              
              //dd($brand);
                 
               $stock=ProductStock::create([
         
                'stock'=> $request->product_stock[$i],
                'pbrand_id' => $brand->id,
                'product_price_piece' =>  $request->product_price_piece[$i] ?? null,
                'product_price_piece_wholesale' =>  $request->product_price_piece_wholesale[$i] ?? null,
                'product_price_unit '=>  $request->product_price_unit[$i] ?? null,
                'product_price_unit_wholesale' =>  $request->product_price_unit_wholesale[$i] ?? null,
                'purchasing_price' => $request->purchasing_price[$i]??null,
                'active' => 1,
                'admin_id' => Auth::id(),
               ]);
         
              
                
           

            }
            //dd($request->all());
          \DB::commit();
           
            return redirect()->route('products.copy')->with('flash','success');
           
       } catch (\Exception $e)
        {
         return redirect()->back()->with('flash','fail');          
        }

      
  }




  //create from existing product in bulk
  public function copyBulk(Request $request) 
  {
  
    $request->validate([

          'stock' => 'required',
          'purchasing_price' => 'required'

        ]);
   
    try {

         \DB::beginTransaction();
          for ($i=0;  $i < count($request->name); $i++) 
           { 

              $brand=ProductBrand::where('brand_id',$request->brand_id)->where('product_id',$request->product_id[$i])->first();
              
              if(!empty($brand))
              { 

                $success='brand already exist' ;
                return redirect()->back()->with('flash',$success);
              }else
              {
                
                $temp[] = ProductBrand::create([

                    'brand_id'=> $request->brand_id,
                    'product_id'=> $request->product_id[$i],
                    
                ]);
             
               foreach($temp as $tmp)
                {
                  $pb=$tmp['id'];
                }
                 
               $stock=ProductStock::create([
         
                'stock'=> $request->stock[$i],
                'pbrand_id' => $pb,
                'product_price_piece' =>  $request->product_price_piece[$i] ?? null,
                'product_price_piece_wholesale' =>  $request->product_price_piece_wholesale[$i] ?? null,
                'product_price_unit '=>  $request->product_price_unit[$i] ?? null,
                'product_price_unit_wholesale' =>  $request->product_price_unit_wholesale[$i] ?? null,
                'purchasing_price' => $request->purchasing_price[$i],
                'active' => 1,
               ]);
         
              }
                
           

            }
          \DB::commit();
           
            return redirect()->route('products.copy')->with('flash','success');
           
        } catch (\Exception $e)
        {
          return redirect()->back()->with('flash','fail');          
        }
  }//create new bulk end

  //get single prodycuct for edit
  public function edit($id) 
   {
        
     $product = Product::leftjoin('product_brands','products.id','=','product_brands.product_id')->select('products.category_id','products.sub_category_id','products.product_weight','products.product_name','products.product_code','products.unit_id','product_brands.brand_id','product_brands.id','product_brands.product_id','products.sell_by','products.gst_tax','products.unit_barcode','products.pack_quentity')->where('product_brands.product_id',$id)->first();
    
        $units = Unit::all();
        $categories= $this->category();//from prodyuct trait
        $sub_categories= $this->scategory();//from prodyuct trait
        $brands= $this->brand();//from prodyuct trait
        $stock=ProductStock::where('pbrand_id',$product['id'])->where('stock','>', 0)->where('active',1)->first();
     return view('panel.products.edit', compact('categories', 'sub_categories', 'product', 'brands', 'units','stock'));

    }

// update single product
    public function update(Request $request, $id) {
       // dd($request->all());
        $validator = \Validator::make($request->all(), [

            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            
        ]);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('flash', 'validation');

        }
         


        try{
             
          Product::where('id',$id)->update([
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'product_name'=>$request->product_name,
            'product_weight'=>$request->product_weight,
            'unit_id'=>$request->unit_id,
            'gst_tax'=>$request->gst_tax,
            'product_code'=>$request->product_code,
            'unit_barcode'=>$request->unit_barcode??null,
            'pack_quentity'=>$request->pack_quentity,
            'branch_id'=>Auth::user()->branch_id,
        ]);
     
       $brand= ProductBrand::where('id',$request->bid)->first();
       
        $brand->brand_id=$request->brand_id;
        $brand->save();

        ProductStock::where('pbrand_id',$request->bid)->update([
       'product_price_piece'=>$request->product_price_piece??null,
       'product_price_piece_wholesale'=>$request->product_price_piece_wholesale??null,
       'product_price_unit'=>$request->product_price_unit??null,
       'product_price_unit_wholesale'=>$request->product_price_unit_wholesale??null,

        ]);
        
        return redirect()->route('products.index')->with('flash','success');
        
        }catch(\exception $e){
        
         return redirect()->back()->with('flash','error');
         
        }

        
    }

    public function destroy($id) {
        
        Product::destroy($id);        

        return redirect()->route('products.index')->with('flash', 'success');

    }

  
    

}