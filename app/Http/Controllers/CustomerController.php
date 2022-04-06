<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Traits\ImageTrait;
class CustomerController extends Controller
{
   use ImageTrait;
    public function index()
    {
        $customers=Customer::all();
         return view('customer.index',compact('customers'));
    }

    
    public function create(Request $req)
    {
         $this->cutomerValidation();//from image trait

        Customer::create([
          
           'customer_group'=>$req->customer_group,
           'customer_name'=>$req->customer_name,
           'customer_address'=>$req->customer_address,
           'customer_company'=>$req->customer_company,
           'customer_city'=>$req->customer_city,
           'customer_email'=>$req->customer_email,
           'customer_phone'=>$req->customer_phone,
           
        
        ]);

        return redirect()->back()->with('success','Customer Added Successfully');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store()
    {
        //
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit($id)
    {
        $customer=Customer::findorfail($id);
        return view('customer.update',compact('customer'));
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update($id,Request $req)
    { 
       $this->cutomerValidation();//from image trait
    
        $customer=Customer::where('id',$id)->update([
        
          'customer_group'=>$req->customer_group,
           'customer_name'=>$req->customer_name,
           'customer_address'=>$req->customer_address,
           'customer_company'=>$req->customer_company,
           'customer_city'=>$req->customer_city,
           'customer_email'=>$req->customer_email,
           'customer_phone'=>$req->customer_phone,
           'customer_image'=>$this->image(),
        ]);
        return redirect()->route('customer')->with('success','Data Updated');
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    { 

        $customer=Customer::destroy($id);

        return redirect()->back()->with('success','Customer Data Deleted');
    }

    


    function accountData(Request $req)
    {
        $query=Customer::join('accounts','customers.id','=','accounts.customer_id')->select('customers.customer_name','accounts.account','accounts.paying_date','accounts.customer_id','accounts.id')->where('deleted_at', NULL);

        if($req->id==2)
        {
            $data=$query->where('account_type','0')->get();
        }else if($req->id==3)
        {
            $data=$query->where('account_type','1')->get();
        }

        return response()->json($data);
    }
}
