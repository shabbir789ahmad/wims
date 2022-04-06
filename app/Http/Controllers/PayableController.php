<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payable;
use App\Models\Supplier;
use Carbon\Carbon;
class PayableController extends Controller
{
    function index()
    {
        $payables=Payable::where('deleted_at',null)->get();
        $suppliers=Supplier::all();
        return view('Payable.index',compact('payables','suppliers'));
    }
    function allSupplier()
    {
        $payables=Supplier::join('payables','suppliers.id','=','payables.supplier_id')->where('deleted_at',null)->select('product_name','suppliers.contact_person_name','product_quentity','product_amount','paying_date','payables.id')->get();

        return response()->json(['data'=>$payables]);
    }

    function supplier()
    {
        $suppliers=Supplier::all();
        return view('Payable.create',compact('suppliers'));
    }
    function create(Request $req)
    {
        $req->validate([
         'product_name'=>'required',
         'product_quentity'=>'required',
         'product_amount' =>'required',
         'paying_date' =>'required',
         'supplier_id' =>'required',

        ]);

        return \FormHelper::createEloquent(new Payable, $req->all());
    }

    function payNow($id)
    {
        Payable::where('id',$id)->update(['deleted_at'=>carbon::now()]);
        return redirect()->back()->with('flash','success');
        
    }
}
