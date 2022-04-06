<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Charge;
use App\Models\ProductStock;
use Auth;
use App\Repository\PaymentRepository;
class ReturnProductController extends Controller
{

     protected $payment = null;
    
    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
    }

    function index()
    {
         
         $orders= $this->payment->getAllPayments();
        
       return view('return.index',compact('orders'));
    }
   
    public function create() {

     $orders=Payment::join('orders','payments.id','=','orders.payment_id')->select('orders.id','orders.payment_id','payments.biller_name','orders.product_name','orders.quentity','orders.tax','orders.sub_total','payments.created_at')->latest('payments.created_at')->where('payments.branch_id',Auth::user()->branch_id)->get();

     return response()->json($orders);

    }
    public function edit($id) {
         
         $orders=Order::Branch()->findOrFail($id);
        
        return view('return.edit', compact('orders'));

    }

    function update($id,Request $request)
    {

        $order=Order::Branch()->where('payment_id',$id)->first();
        $product=Product::Branch()
        ->join('product_brands','products.id','=','product_brands.product_id')
        ->where('products.id',$request->product_id)
        ->first('product_brands.id');

        $stock=ProductStock::Branch()
        ->where('pbrand_id',$product->id)
        ->first();

    
        if($order->quentity===1 || $order->quentity==$request->quentity)
        {
            
            $stock->stock=$stock->stock + $request->quentity;
            $stock->stock_sold=$stock->stock_sold - $request->quentity;
            $stock->save();
            Order::Branch()->where('id',$request->order_id)->delete();
            Charge::create([
             
             'return_charges'=>$request->return_charges??null,
              'return_quentity'=>$request->quentity,
              'order_id'=>$order->id,
              'branch_id'=>Auth::user()->branch_id,
            ]);
            // Payment::destroy($id);
            return redirect()->route('return.index')->with('success','Product returned Successfully');
        }else
        {
            $total=$order->sub_total/$order->quentity;
            $order->quentity=$request->quentity;
            $order->sub_total=$request->sub_total-$total;
            
            
            $stock->stock=$stock->stock + $request->quentity;
            $stock->stock_sold=$stock->stock_sold - $request->quentity;
            
            $stock->save();
            $order->save();
             Charge::create([
             
             'return_charges'=>$request->return_charges??null,
              'return_quentity'=>$request->quentity,
              'order_id'=>$order->id,
              'branch_id'=>Auth::user()->branch_id,
            ]);
            return redirect()->route('return.index')->with('success','Product returned Successfully');
           
        }
      
    }
}
