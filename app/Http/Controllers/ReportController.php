<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Charge;
use App\Models\Product;
USE Carbon\Carbon;
use Auth;
use App\Repository\PaymentRepository;
use App\Http\Traits\ProductTrait;
use DB;
class ReportController extends Controller
{
       use ProductTrait;

        protected $payment = null;
    
    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
    }
     
    function index(Request $request)
    {
        $query=Payment::Branch()->join('orders','payments.id','=','orders.payment_id')
        ->where('orders.deleted_at','=',NULL);

        if($request->option_report==1)
        {
          $query=$query->whereDate('payments.created_at','>=', Carbon::today());
        }
        if($request->option_report==2)
        {
          $query=$query->where('payments.created_at','>=', Carbon::now()->subdays(15));
        }
        if($request->option_report==3)
        {
          $query=$query->whereMonth('payments.created_at','>=', Carbon::today()->month);
        }

        $total_sale_today=$query->count('payments.id');
        $total_amount_today=$query->sum('sub_total');
        $total_discount_today=$query->sum('discount');
        $total_tax_today=Order::Branch()->whereDate('created_at',Carbon::today())->sum('tax');

       $orders=$query->select('product_id')->groupBy('product_id')->get();

      
     
      

       foreach($orders as $order)
       {
         $order->price=Product::
           join('product_brands','products.id','=','product_brands.product_id')
          ->join('product_stocks','product_stocks.pbrand_id','=','product_brands.id')
          ->select('product_stocks.purchasing_price')
          ->where('products.id',$order['product_id'])
          ->get();
          
       }
   
 
       //for return product
        $query=Order::Branch()
        ->onlyTrashed()
        ->whereDate('created_at',Carbon::today());

        if($request->option_report==1)
        {
          $query=$query->whereDate('orders.created_at','>=', Carbon::today());
        }
        if($request->option_report==2)
        {
          $query=$query->where('orders.created_at','>=', Carbon::now()->subdays(15));
        }
        if($request->option_report==3)
        {
          $query=$query->whereMonth('orders.created_at','>=', Carbon::today()->month);
        }

        $total_sale_return_today=$query->count('orders.id');
        $total_retunr_tax_today=$query->sum('tax');
        $total_amount_return_today=$query->sum('sub_total');
        

       

        $charges=Charge::Branch()->whereDate('created_at',Carbon::today())->sum('return_charges');
        
        return view('report.index',compact('total_sale_today','total_amount_today','total_discount_today','total_tax_today','total_sale_return_today','total_retunr_tax_today','charges','total_amount_return_today','orders'));
    }
 

    function create(Request $request)
    {
        $orders= $this->payment->getAllPayments();
        $categories= $this->category();
        $sub_categories= $this->scategory();
        $brands= $this->brand();
      
  
        $query=Payment::select( 'orders.sell','orders.product_id','orders.product_name','payments.biller_name','products.pack_quentity', DB::raw(' SUM(orders.sub_total) AS sub_total, SUM(orders.tax) as tax, SUM(orders.quentity) as quentity') )
            ->join('orders', 'payments.id', '=', 'orders.payment_id')
            ->join('products', 'products.id', 'orders.product_id')
           ->groupBy('orders.sell','orders.product_id','orders.product_name','payments.biller_name','products.pack_quentity')
           ->whereMonth('payments.created_at', Carbon::today()->month);

        if($request->databetween && $request->databetween2)
        {
           
            $query=$query->whereBetween('payments.updated_at',[$request->databetween,$request->databetween2]);
        }
          
        if($request->option_report==1)
        {
          $query=$query->whereDate('payments.created_at','=', Carbon::today());
        }
        if($request->option_report==2)
        {
          $query=$query->where('payments.created_at','>=', Carbon::now()->subdays(15));
        }
        if($request->option_report==3)
        {
          $query=$query->whereMonth('payments.created_at','>=', Carbon::today()->month);
        }

           $orders=$query->paginate(10);


       return view('report.byproduct',compact('orders','categories','sub_categories','brands'));
    }





    function edit($id,Request $request)
    {
        $query=Payment::Branch()->
            join('orders', 'payments.id', '=', 'orders.payment_id')
            ->select('payments.biller_name','payments.discount','orders.product_name','orders.quentity','orders.tax','orders.sub_total','orders.sell')
           ->where('product_id',$id);
    
          if($request->databetween && $request->databetween2)
           {
           
            $query=$query->whereBetween('payments.updated_at',[$request->databetween,$request->databetween2]);
          }

           $orders=$query->get();

           $price=Order::Branch()->where('product_id',$id)->get();

           if($request->databetween && $request->databetween2)
           {
           
            $price=$price->whereBetween('payments.updated_at',[$request->databetween,$request->databetween2]);
          }

          $unit_price=$price->where('sell','==','unit')->sum('sub_total');
          $piece_price=$price->where('sell','==','piece')->sum('sub_total');

          $products=Product::
           join('product_brands','products.id','=','product_brands.product_id')
          ->join('product_stocks','product_stocks.pbrand_id','=','product_brands.id')
          ->select('product_stocks.purchasing_price')
          ->where('products.id',$id)
          ->first();
   
         return view('report.singlereport',compact('orders','products','unit_price','piece_price'));
    }
}
