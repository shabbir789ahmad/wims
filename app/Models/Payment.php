<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Order;
class Payment extends Model
{
    use HasFactory;
    protected $fillable=[

     'biller_name',
      'paying_by',
      'paying_amount',
      'payable_amount',
      'discount',
      'tax',
      'customer_id',
      'customer_name',
      'branch_id',
      'invoiceId',
    ];

 
    public static function scopeBranch($query)
    {
       return $query->where('payments.branch_id',Auth::user()->branch_id);
    }
}
