<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Installment;
class PaymentController extends Controller
{
     


     function paymentRecieve(Request $req)
     {
      
       //dd($req->id);

        $payable=Account::Branch()->findOrFail($req->id);

        $payable->delete();

        return redirect()->back()->with('success','Payment Recieved Thanks');
        return response()->json('success','Payment Recieved Thanks ');
     }

     
}
