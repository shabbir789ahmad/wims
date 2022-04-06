<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[

   'product_name',
   'product_id',
   'quentity',
   'pack_quentity',
   'sell',
   'tax',
   'sub_total',
   'unit',
   'payment_id',
   'branch_id'

    ];

    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
