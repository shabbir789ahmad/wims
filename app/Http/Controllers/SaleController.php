<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Expence;
use App\Models\Account;
use Carbon\Carbon;
class SaleController extends Controller
{
    function SaleData()
    {
        $sale=Payment::whereDate('created_at', Carbon::today())->sum('paying_amount');
        $recieve=Account::whereDate('deleted_at', Carbon::today())->onlyTrashed()->sum('account');
        $exp=Expence::whereDate('created_at', Carbon::today())->sum('expense');
          $sl=$sale+$recieve;
        $netsale= $sl - $exp;
             
         
    
        return response()->json(['sale'=>$sale,'recieve'=>$recieve,'netsale'=>$netsale,'exp'=>$exp]);
    }
}
