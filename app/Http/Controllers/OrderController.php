<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Brand;
use App\Models\Account;
use App\Http\Traits\QuantityConverter;
use DB;
use Auth;
class OrderController extends Controller
{

  use QuantityConverter;
  
  function setPrice($sell_type,$wholesale_one,$stock,$vat)
  {
               $vat=$vat/100;
                $vat=$vat+1;
                $vat_tax=$stock['purchasing_price'] - ($stock['purchasing_price']/$vat);
                $vat_tax=round($vat_tax,2);

    if($sell_type === 'retail' && $wholesale_one==1 || $sell_type === 'whole' && $wholesale_one==1 )
            {
                $price=$stock['product_price_piece'] ;
                $price2=$stock['product_price_piece'] ;
                $sell_type='retail';
                
             
            }else if($sell_type === 'retail' && $wholesale_one==0 || $sell_type === 'whole' && $wholesale_one==0)
            {
                
                $price=$stock['product_price_piece_wholesale'] ;
                $price2=$stock['product_price_piece_wholesale'] ;
                 $sell_type='whole';
                 
            } 

            return ['price'=>$price,'price2'=>$price2,'sell_type'=>$sell_type,'vat_tax'=>$vat_tax];
  }

  function setPrice2($sell_type,$wholesale_one,$stock,$vat,$quentity,$pack_quentity)
  {
              $vat=$vat/100;
                $vat=$vat+1;
                $vat_tax=$stock['purchasing_price'] - ($stock['purchasing_price']/$vat);
                $vat_tax=round($vat_tax,2);
                $vat_tax=$vat_tax/$pack_quentity;
                 $vat_tax=$vat_tax * $quentity;
           
    if($sell_type === 'retail' && $wholesale_one==1 || $sell_type === 'whole' && $wholesale_one==1 )
            {
                $price=$stock['product_price_unit'] ;
                $price2=$stock['product_price_unit']*$quentity ;
                $sell_type='retail';
               
            }else if($sell_type === 'retail' && $wholesale_one==0 || $sell_type === 'whole' && $wholesale_one==0)
            {
                
                $price=$stock['product_price_unit_wholesale'] ;
                $price2=$stock['product_price_unit_wholesale']*$quentity ;
                $sell_type='whole';
               
            } 
            return ['price'=>$price,'price2'=>$price2,'sell_type'=>$sell_type,'vat_tax'=>$vat_tax];
  }

  function order(Request $req)
  {
   
   $id=$req->id;
   $product = Product::
    join('product_brands','products.id','=','product_brands.product_id')
    ->select('products.product_name','product_brands.product_id','products.sell_by','product_brands.id','products.unit_id','products.gst_tax','products.pack_quentity','products.product_code','products.unit_barcode')
    ->where('product_brands.id',$req->brand_id)->Branch()
    ->first();
      
    $stock=ProductStock::where('pbrand_id',$req->brand_id)->where('active','1')->where('stock','>',0)->Branch()->first();
    if($product)
    {
      $sell=$req->sell_by;
      $price='';
      $price2='';
      $sell_type='';
      $count=1;
      $quentity_in_kg='';
      $quentity_in_fit='';
      $new_q_fit='';
      $new_q_kg='';
      $vat='';
      $st=$stock['stock'] ;
      
      if($sell== 'piece')
      {
         if($stock['stock'] < $req->quentity_kg)
         {
               $cart=session()->get('cart');
               return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);
         }else
         {
           $dds= $this->setPrice($req->sell_type,$req->wholesale_one,$stock,$product['gst_tax']);
             $price=$dds['price'];
             $price2=$dds['price2'];
             $sell_type=$dds['sell_type'];
             $vat=$dds['vat_tax'];
         
              //sell type retail if end
          }
       }else if($sell == 'unit')
       {
          
            if($req->quentity_kg >$product['pack_quentity'])
            {
               $quentity_in_kg=$req->quentity_kg/$product['pack_quentity'];
            }
    
            if($stock['stock'] < $quentity_in_kg)
            {
               $cart=session()->get('cart');
               return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);
            }else
            {
              $dds= $this->setPrice2($req->sell_type,$req->wholesale_one,$stock,$product['gst_tax'],$req->quentity_kg,$product['pack_quentity']);
             $price=$dds['price'];
             $price2=$dds['price2'];
             $sell_type=$dds['sell_type'];
             $vat=$dds['vat_tax'];
            }
                
        
         

       }else if($sell == 'piece, unit')
       {
         
       if($req->barcode==$product['product_code'])
       {
         $sell='piece';
         if($stock['stock'] < $req->quentity_kg)
         {
               $cart=session()->get('cart');
               return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);
         }else
         {
            $dds= $this->setPrice($req->sell_type,$req->wholesale_one,$stock,$product['gst_tax']);
             $price=$dds['price'];
             $price2=$dds['price2'];
             $sell_type=$dds['sell_type'];
             $vat=$dds['vat_tax'];
              //sell type retail if end
          }
       }else if($req->barcode==$product['unit_barcode'])
       {
          $sell='unit';
         
            if($req->quentity_kg >$product['pack_quentity'])
            {
               $quentity_in_kg=$req->quentity_kg/$product['pack_quentity'];
            }

            if($stock['stock'] < $quentity_in_kg)
            {
               $cart=session()->get('cart');
               return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);
            }else
            {
             $dds= $this->setPrice2($req->sell_type,$req->wholesale_one,$stock,$product['gst_tax'],$req->quentity_kg,$product['pack_quentity']);
             $price=$dds['price'];
             $price2=$dds['price2'];
             $sell_type=$dds['sell_type'];
             $vat=$dds['vat_tax'];
            }
                
       

       }

         

       }

          

        $cart = session()->get('cart', []);
        $ids=$req->barcode;
        
        if(isset($cart[$ids]) && isset($cart[$ids]['pid'])==$id)
         {
            $quent=$cart[$ids]['quantity']+$req->quentity_kg;
            if($sell=='piece')
            {
              if($quent > $stock['stock'])
             {
             
              $cart=session()->get('cart');
              return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);

              }else
              { 
               $cart[$ids]['quantity']=$quent;
               $cart[$ids]['sub_total']=$quent*$cart[$ids]['price'];
               $tax_amount=$cart[$ids]['gst']+$vat;
               $cart[$ids]['gst']=number_format($tax_amount, 3, '.', '');
                 
               }
              }else if($sell=='unit')
              {
                
                    if($quent >$product['pack_quentity'])
                    {
                    $new_q_kg=$quent/$product['pack_quentity'];
                    }
           
                    if($stock['stock']<$new_q_kg)
                    {
                        $cart=session()->get('cart');
                         return response()->json(['data'=>$cart,'fail'=>'Total'.''.$st.'product left']);
                    }else
                    {
                       $cart[$ids]['quantity']=$quent;
                       $cart[$ids]['sub_total']=$cart[$ids]['price']*$cart[$ids]['quantity'];
                       $tax_amount=$cart[$ids]['gst']+$vat;
                       $cart[$ids]['gst']=number_format($tax_amount, 3, '.', '');
                    }
                
              } 
         }else
         {

               $cart[$ids] =
                [
                     'id' => $ids,
                     'pid' => $product['product_id'],
                     'purchasing_price' => $stock['purchasing_price'],
                     "name" => $product['product_name'],
                     "quantity" => $req->quentity_kg,
                     "sell_by" => $sell,
                     "unit_id" => $product['unit_id'],
                     "gst" => $vat??0,
                     "price" =>$price ,
                     "sub_total" =>$price2 ,
                     "brand_id" =>$req->brand_id ,
                     "brand_table_id" =>$product['id'] ,
                     "sell_type" => $sell_type,
                     "retailer" => $req->wholesale_one,
                     "pack_quentity" => $product['pack_quentity']

                 ];

         }
       
               
         
          
        session()->put('cart', $cart);
        return response()->json(['data'=>$cart,'success'=>'Successfull']);
        
        }else
        {
             return response()->json(['data'=>$cart]);
        }
          
  }

    public function remove(Request $request)
    {
        if($request->id) 
        {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) 
            {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
   
          return response()->json(['success'=>'Product removed successfully' ]);
          
        }
    }

public function updateSessionOrder(Request $request)
{
   $new_q_fit='';
   $new_q_kg='';
   if($request->id && $request->quentity_kg)
   {
     $data = session()->get('cart');
     $quentity= $request->quentity_kg;
     $stock=ProductStock::where('pbrand_id',$request->brand_id)
      ->first();
       $product=Product::where('id',$request->product_id)->select('pack_quentity')
       ->first();
           
     if($request->sell=='P')
     {
        if($quentity >$stock->stock)
        {
         
          return response()->json(['data'=>$data,'fail'=>'No more Stock']);
        }else
        {
          $data[$request->id]["quantity"] = $request->quentity_kg;
          $data[$request->id]["gst"] = $data[$request->id]["gst"]* $request->quentity_kg;
          $data[$request->id]["sub_total"] = $request->sub_total;
          $data[$request->id]["price"] = $request->price;
          session()->put('cart', $data);
          return response()->json(['success'=>'Product updated  successfully','data'=>$data]);
        }
    
     }else if($request->sell=='U')
     {
        
                // if($request->quentity_kg>$product['pack_quentity'])
                // {
                //     $new_q_fit=$request->quentity_kg/$product['pack_quentity'];
                // }else{
                //     $new_q_fit=$request->quentity_kg;
                // }
           
                 
                // if(floor($new_q_fit) >$stock->stock)
                // {
                //   return response()->json(['data'=>$data,'fail'=>'No more Stock']);
                // }else
                // {
                  $data[$request->id]["quantity"] = $request->quentity_kg;
                  $data[$request->id]["gst"] = $data[$request->id]["gst"] * $request->quentity_kg;
                  $data[$request->id]["sub_total"] = $request->sub_total;
                  $data[$request->id]["price"] = $request->price;
                  session()->put('cart', $data);
                  $cart=session()->get('cart');
                  return response()->json(['success'=>'Product updated  successfully','data'=>$cart]);
                // }

           
            }
          
        }
    }



  //get data to print
   // function dataPrint()
   // {
   //    $data=session('cart');
   //    return response()->json($data);
   // }
   function dataCanner(Request $req)
   {

      $data=Product::join('product_brands','products.id','=','product_brands.product_id')->select('product_brands.id','products.sell_by','products.unit_id','product_brands.product_id')->where('product_code',$req->id)->orWhere('unit_barcode',$req->id)->first();
      if($data)
      {
          return response()->json($data);
     
      }else{
      
        return response()->json('No matching Product Found');
     }
   }

    // function getOrders()
    // {
    //    $products = Product::
    //    join('orders','products.id','=','orders.product_id')
    //    ->join('product_stocks','products.id','=','product_stocks.product_id')->paginate(10);
    //    $brands=Brand::all();
    //   //dd($products);
    //      return view('pos.order',compact('products','brands'));
       
    // }

    function getProduct($id)
    {
        $product=Product::where('sub_category_id',$id)->get();
        return response()->json($product);
    }


 function orderPayment(Request $req)
 {

   // dd(session()->get('cart'));
    $validator = \Validator::make($req->all(), [
        
        'paying_amount'=>'required',
           'payable_amount'=>'required',
            
    ]);
    
    if ($validator->fails()) 
    {
      return redirect()->back()->withErrors($validator)->withInput()->with('success', 'validation error');
    }
       $req->request->add(['branch_id' =>Auth::user()->branch_id]);    
    $data=$req->all();
     
    DB::transaction(function() use($req,$data)
    {
      $payment=Payment::create($data,Auth::user()->branch_id);
      if($req->customer_id)   
      {
         $account=$req->payable_amount - $req->paying_amount;
         Account::create([
                 
                  'account' =>$account,
                  'customer_id' => $req->customer_id,
                  'account_type' => $req->account_type,
                  'paying_date' => $req->paying_date,
                  'branch_id'=>Auth::user()->branch_id,
          ]);
       }

      if(session('cart'))
              {
                foreach(session('cart') as $details)
                {
            
                  $order= Order::create([

                    'product_id' => $details['pid'],
                    'pack_quentity' => $details['pack_quentity'],
                    'product_name' => $details['name'],
                    'sell' => $details['sell_by'],
                    'quentity' => $details['quantity'],
                    'sub_total' => $details['sub_total'],
                    'unit' => $details['unit_id'],
                    'payment_id' =>$payment['id'],
                    'sell_type' =>$payment['sell_type'],
                    'tax' =>$details['gst'],
                     'branch_id'=>Auth::user()->branch_id,
                    ]);
                }

                foreach(session('cart') as $details)
                {

                  $p= ProductStock::where('pbrand_id',$details['brand_id'])->first();

                  $sold=$p->stock_sold;
                  $left=$p->stock;
                  if($details['sell_by'] == 'piece')
                  {
                    $p->stock_sold=$sold + $details['quantity'];
                    $p->stock=$left - $details['quantity'];
                    $p->save();

                  }else 
                  {
                      $kg=$p->stock_sold_kg;
                      $gram=$p->stock_sold_gram;

                 // if($details['unit_id'] == 1 || $details['unit_id'] == 3 || $details['unit_id'] == 5)
                 //  {
                 //      $p->stock_sold=$sold + $details['quantity'];
                 //      $p->stock=$left - $details['quantity'];
                 //      $p->save();

                 //  }else if($details['unit_id'] == 4)
                 //  {
                     $quentity=$details['quantity'];
                    $soldfit=$p->stock_sold_kg;
                 
                        if($quentity >= $details['pack_quentity'])
                       {
                      
                        // if(empty($gram))
                        //  {
                           if(empty($kg))
                           {
                               $p->stock_sold_kg= $this->quentityKg($quentity,$details['pack_quentity']);
                               $p->stock_sold_gram=null;
                               $p->stock_sold=$sold + $this->kg($quentity,$details['pack_quentity']);
                               $p->stock=$left - $this->kg($quentity,$details['pack_quentity']);
                               $p->save();
                           }else
                           {
                               //if kg for kg is not empty
                               $soldfit2= $soldfit + $quentity;
                               $p->stock_sold_kg=$this->quentityKg($soldfit2,$details['pack_quentity']);
                               $p->stock_sold_gram=null;
                               $p->stock_sold=$sold + $this->kg($soldfit2,$details['pack_quentity']);
                               $p->stock=$left - $this->kg($soldfit2,$details['pack_quentity']);
                               $p->save();
                             
                            }//gk if ended

                          

                      }else{//if q is less than 50
                             
                             if(empty($kg))
                             {
 
                               $p->stock_sold_kg= $quentity;
                               $p->stock_sold_gram=null;
                               $p->stock_sold=$sold + 1;
                               $p->stock=$left - 1;
                               $p->save();

                              }else
                              {//if kg for fit is not empty
                               
                               $soldfit2= $soldfit + $quentity;
                             
                              if($soldfit2 >  $details['pack_quentity'])
                              {
                               
                                $p->stock_sold_kg=$this->quentityKg($soldfit2,$details['pack_quentity']);
                                $p->stock_sold_gram=null;
                                $p->stock_sold=$sold + $this->kg($soldfit2,$details['pack_quentity']);
                                $p->stock=$left - $this->kg($soldfit2,$details['pack_quentity']);
                                $p->save();
                              }else
                              { 
                                $p->stock_sold_kg=$soldfit2 ;
                                $p->save();
                              }

                          }
                      }
                       
                      //kg if endd

                    // }else if($details['unit_id']==2)//length started
                    // {

                      //   $quentity=$details['quantity'] ;
                      //   $soldfit=$p->stock_sold_kg;

                      //   if($quentity >= $details['pack_quentity'])
                      // {

                      //   // if(empty($gram))
                      //   //  {
                      //      if(empty($kg))
                      //      { 
                      //         $p->stock_sold_kg= $this->quentityFit($quentity,$details['pack_quentity']);
                      //         $p->stock_sold_gram=null;
                      //         $p->stock_sold=$sold + $this->fit($quentity,$details['pack_quentity']);
                      //         $p->stock=$left - $this->fit($quentity,$details['pack_quentity']);
                      //         $p->save();
                          
                      //      }else
                      //      {  
                      //         //if kg for fit is not empty
                      //          $soldfit2= $soldfit + $quentity;
                      //          $p->stock_sold_kg=$this->quentityFit($soldfit2,$details['pack_quentity']);
                      //          $p->stock_sold_gram=null;
                      //          $p->stock_sold=$sold + $this->fit($soldfit2,$details['pack_quentity']);
                      //          $p->stock=$left - $this->fit($soldfit2,$details['pack_quentity']);
                      //          $p->save();
                              


                      //      }//gk if ended

                          

                      // }else{//if q is less than 13
                             
                      //        if(empty($kg))
                      //        {
                               
                      //          $p->stock_sold_kg= $quentity;
                      //          $p->stock_sold_gram=null;
                      //          $p->stock_sold=$sold + 1;
                      //          $p->stock=$left - 1;
                      //          $p->save();

                      //         }else
                      //         {
                      //           //if kg for fit is not empty
                      //           $soldfit2= $soldfit + $quentity;
                              
                      //         if($soldfit2 >  $details['pack_quentity'])
                      //         {
                      //           $p->stock_sold_kg=$this->quentityFit($soldfit2,$details['pack_quentity']);
                      //           $p->stock_sold_gram=null;
                      //           $p->stock_sold=$sold + $this->fit($soldfit2,$details['pack_quentity']);
                      //           $p->stock=$left - $this->fit($soldfit2,$details['pack_quentity']);
                      //           $p->save();
                      //         }else
                      //         {
                      //           $p->stock_sold_kg=$soldfit2 ;
                      //           $p->save();
                      //         }

                      //     }
                      // }
                        
                    // }else{
                    //  echo "sorry ....";
                    //}//unit id 3 if end
                    
                    

                  }//sell by if ended

                }//foreach loop ended

              }//session cart ended
             

             session()->forget('cart');
          
            
            });
        
             $payment=Payment::Branch()->latest()->select('id')->first();
             $cart_data=Order::where('payment_id',$payment['id'])
               ->latest()->get();
               $success='Payment Completed';
               $session_data=['success'=>$success,'cart_data'=>$cart_data];
             return response()->json($session_data);
             

    }
}
