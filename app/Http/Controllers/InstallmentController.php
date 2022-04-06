<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Installment;
use DateTime;
use Carbon\Carbon;
use App\Http\Traits\InstallmentTrait;
class InstallmentController extends Controller
{
  use InstallmentTrait;
    function index()
    {
        $accounts=$this->installment();//from instalment tarit
         foreach($accounts as $account)
         {
          $account->installment=Installment::where('account_id',$account['id'])->get();
         }
        return view('payment.index',compact('accounts'));
    }


    // function getPayment()
    // {
       
    //     $payment=$this->installment();//from instalment tarit
    //     return response()->json($payment);
    // }

    function makeInstallment(Request $req)
    {
         $req->validate([
          
           'installment' =>'required',
           'account_id' => 'required',
           'duration'   => 'required',
           'duration_type'   => 'required'

         ]);
        try{ 
         $price=$req->price/$req->installment;
         $date2=[];
         $date3=Carbon::now();
         
         for($i=0; $i < $req->installment; $i++)
          {
            if($req->duration_type == 'day')
            {
               $date= $req->duration /$req->installment;          
            }else if($req->duration_type=='month')
            {
              $day=$req->duration * 30;
              $date=$day/$req->installment;
            }else if($req->duration_type=='year')
            {
              $day=($req->duration*12)*30;
              $date=$day/$req->installment;
            } 
              $date2=$date3->addDay($date);
              Installment::create([

                'installment' =>$i+1,
                'account_id' => $req->account_id,
                'price_per_installment'  => $price,
                'start_date'  => $date2,

              ]);            
          }
          return redirect()->back()->with('success','Installment Created');
        }catch(\Exception $e)
        {
          return redirect()->back()->with('success','Installment Creation Failed');
        }
    }

    function accountInstallment(Request $req)
    {
   
      $accounts=Installment::
        where('account_id',$req->id)->withTrashed()
        ->get();
        
        return response()->json($accounts);
    }
    function recieveInstallment(Request $req)
    {
      try{
           $instalment=Installment::where('account_id',$req->account)->get();
          
           if(count($instalment)<=1)
           {
            Installment::destroy($req->id);
            Account::where('id',$req->account)->delete();

           }else{
            Installment::destroy($req->id);
           }

         return response()->json('Payment Recieved ');

      }catch(\Exception $e)
     {
        return response()->json('Something goes Wrong');
      }
      
    }
}
