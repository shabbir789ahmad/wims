<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payable extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $fillable=['product_name','product_quentity','product_amount','paying_date','supplier_id'];
}
