<?php

namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Customer;

trait InstallmentTrait
 {

   function installment()
   {


          $payment=Customer::join('accounts','customers.id','=','accounts.customer_id')->select('customers.customer_name','customers.customer_phone','customers.customer_email','accounts.account','accounts.customer_id','accounts.id','accounts.deleted_at')->get();
          return $payment;
   }

 }

?>